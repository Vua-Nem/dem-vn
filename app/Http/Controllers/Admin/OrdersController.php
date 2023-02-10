<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateOrdersRequest;
use App\Http\Requests\UpdateOrdersRequest;
use App\Models\District;
use App\Models\OrderItem;
use App\Models\Orders;
use App\Models\ProductVariant;
use App\Models\Province;
use App\Repositories\OrdersRepository;
use App\Http\Controllers\AppBaseController;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Response;

class OrdersController extends AppBaseController
{
    /** @var  OrdersRepository */
    private $ordersRepository;

    public function __construct(OrdersRepository $ordersRepo)
    {
        $this->ordersRepository = $ordersRepo;
    }

    /**
     * Display a listing of the Orders.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {


		$query = Orders::with(["items", "OrderVoucher", "items.productVariant"]);

		if(isset($request['time_start']) && !empty($request['time_start'])){
			$time_start = date("Y-m-d h:i:s", strtotime($request['time_start']));
			$query = $query->where('created_at', ">" ,$time_start);
		}

		if(isset($request['time_end']) &&  !empty($request['time_end']) ){

			$time_end = date("Y-m-d h:i:s", strtotime($request['time_end']));
			$query = $query->where('created_at', "<=", $time_end);
		}

		$orders = $query->orderBy('created_at', 'DESC')->paginate(15);
        return view('admin.orders.index')
            ->with('orders', $orders);
    }

    /**
     * Show the form for creating a new Orders.
     *
     * @return Response
     */
    public function create()
    {
        $provinces = Province::all();
        return view('admin.orders.create')->with("provinces", $provinces);
    }

    /**
     * Store a newly created Orders in storage.
     *
     * @param CreateOrdersRequest $request
     *
     * @return Response
     */
    public function store(CreateOrdersRequest $request)
    {
        $input = $request->all();

        $orders = $this->ordersRepository->create($input);

        Flash::success('Orders saved successfully.');

        return redirect(route('orders.index'));
    }

    /**
     * Display the specified Orders.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $orders = $this->ordersRepository->find($id);

        if (empty($orders)) {
            Flash::error('Orders not found');

            return redirect(route('orders.index'));
        }

        $provinces = Province::all();
        $districts = District::where("province_id", $orders->province_id)->get();

        return view('admin.orders.show')
            ->with('districts', $districts)
            ->with('provinces', $provinces)
            ->with('order', $orders);
    }

    /**
     * Show the form for editing the specified Orders.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $order = Orders::find($id);
        if (empty($order)) {
            Flash::error('Orders not found');
            return redirect(route('orders.index'));
        }

        $provinces = Province::all();
        $districts = District::where("province_id", $order->province_id)->get();
        return view('admin.orders.edit')
            ->with("provinces", $provinces)
            ->with("districts", $districts)
            ->with('order', $order);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function loadCart(Request $request)
    {
        $order = Orders::with(['items', 'items.productVariant'])->where("id", $request->orderId ?? 0)->first();

        if (empty($order)) {
            Flash::error('Orders not found');
            return redirect(route('orders.index'));
        }

        Cart::destroy();
        foreach ($order->items as $item) {
            Cart::add([
                'id' => $item->product_id . "_" . $item->product_variant_id,
                'name' => $item->productVariant->name,
                'qty' => $item->quantity,
                'price' => $item->price,
                'weight' => 50,
                'options' => [
                    'inStock' => $item->productVariant->qty,
                    'promotion_id' => $item->promotion_id,
                    'promotion_discount' => $item->promotion_discount,
                    'compare_price' => $item->compare_price,
                ]
            ]);
        }

        return redirect()->route("orders.edit", ["order" => $order->id]);
    }

    /**
     * Update the specified Orders in storage.
     *
     * @param int $id
     * @param UpdateOrdersRequest $request
     *
     * @return Response
     */
    public function postUpdate($id, UpdateOrdersRequest $request)
    {
        $request = $request->all();
        $totalItems = (int)Cart::total();

        if ($totalItems == 0) {
            Flash::error('Orders not empty');
            return redirect()->back();
        }

        $order = $this->ordersRepository->find($id);
        $request["order_id"] = $order->id;
        $this->cartFinish($request);
        Cart::destroy();
        return redirect()->route('orders.show', ['order' => $order->id]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addCart(Request $request)
    {
        if (isset($request->sku))
            $productVariant = ProductVariant::where("sku", $request->sku)->first();

        if (empty($productVariant)) return redirect()->back();

        Cart::add([
            'id' => $productVariant->product_id . "_" . $productVariant->id,
            'name' => $productVariant->name,
            'qty' => 1,
            'price' => $productVariant->price,
            'weight' => 0,
            'options' => [
				'compare_price' => $productVariant->compare_price,
                'inStock' => $productVariant->qty,
                'promotion_id' => 9999,
                'promotion_discount' => 30000,
            ]
        ]);

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removerCartItem(Request $request)
    {
        if (isset($request->id))
            Cart::remove($request->id);

        return redirect()->back();
    }

    /**
     * @param CreateOrdersRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function saveCart(CreateOrdersRequest $request)
    {
        $request = $request->all();
        $this->cartFinish($request);
        Flash::success('Orders created successfully.');
        return redirect(route('orders.index'));
    }

    public function cartFinish($request)
    {
        $aryItems = [];
        $orderAmounts = $this->getOrderAmount();
        try {
            DB::beginTransaction();
            $order = new Orders();
            if (isset($request["order_id"])) {
                $order = Orders::find($request["order_id"]);
                OrderItem::where("order_id", $order->id)->delete();
            }

            $order->user_id = 0;
            $order->user_name = $request["user_name"];
            $order->phone_number = $request["phone_number"];
            $order->province_id = $request["province_id"];
            $order->district_id = $request["district_id"];
            $order->address = $request["address"];
            $order->description = $request["note"];
            $order->created_by = Auth::user()->id;
            $order->payment_method = $request["payment_method"];
            $order->payment_status = $request["payment_status"];
            $order->status = Orders::ORDER_STATUS_IS_PENDING;
            $order->amount = $orderAmounts["total_amount"];
            $order->real_amount = $orderAmounts["total_amount"] - $orderAmounts["total_discount"];
            $order->save();

            foreach (Cart::content() as $cart) {
                list($product_id, $product_variant_id) = explode("_", $cart->id);
                $aryItems[] = [
                    "order_id" => $order->id,
                    "product_id" => $product_id,
                    "product_variant_id" => $product_variant_id,
                    "quantity" => $cart->qty,
                    "price" => $cart->price,
                    "promotion_id" => $cart->options->promotion_id,
                    "promotion_discount" => $cart->options->promotion_discount
                ];
            }
            if (!empty($aryItems))
                OrderItem::insert($aryItems);

            Cart::destroy();
            DB::commit();
        } catch (\Exception $exception) {
            Db::rollBack();
            pd($exception->getMessage());
            return false;
        }

        return true;
    }

    /**
     * @return array
     */
    public function getOrderAmount()
    {
        $ary = ["total_amount" => 0, "total_discount" => 0];

        foreach (Cart::content() as $cart) {
            $ary["total_amount"] += ($cart->qty * $cart->price);
            $ary["total_discount"] += ($cart->qty * $cart->options->promotion_discount);
        }

        return $ary;
    }
}
