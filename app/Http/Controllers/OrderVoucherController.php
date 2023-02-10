<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderVoucherRequest;
use App\Http\Requests\UpdateOrderVoucherRequest;
use App\Repositories\OrderVoucherRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class OrderVoucherController extends AppBaseController
{
    /** @var  OrderVoucherRepository */
    private $orderVoucherRepository;

    public function __construct(OrderVoucherRepository $orderVoucherRepo)
    {
        $this->orderVoucherRepository = $orderVoucherRepo;
    }

    /**
     * Display a listing of the OrderVoucher.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $orderVouchers = $this->orderVoucherRepository->all();

        return view('order_vouchers.index')
            ->with('orderVouchers', $orderVouchers);
    }

    /**
     * Show the form for creating a new OrderVoucher.
     *
     * @return Response
     */
    public function create()
    {
        return view('order_vouchers.create');
    }

    /**
     * Store a newly created OrderVoucher in storage.
     *
     * @param CreateOrderVoucherRequest $request
     *
     * @return Response
     */
    public function store(CreateOrderVoucherRequest $request)
    {
        $input = $request->all();

        $orderVoucher = $this->orderVoucherRepository->create($input);

        Flash::success('Order Voucher saved successfully.');

        return redirect(route('orderVouchers.index'));
    }

    /**
     * Display the specified OrderVoucher.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $orderVoucher = $this->orderVoucherRepository->find($id);

        if (empty($orderVoucher)) {
            Flash::error('Order Voucher not found');

            return redirect(route('orderVouchers.index'));
        }

        return view('order_vouchers.show')->with('orderVoucher', $orderVoucher);
    }

    /**
     * Show the form for editing the specified OrderVoucher.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $orderVoucher = $this->orderVoucherRepository->find($id);

        if (empty($orderVoucher)) {
            Flash::error('Order Voucher not found');

            return redirect(route('orderVouchers.index'));
        }

        return view('order_vouchers.edit')->with('orderVoucher', $orderVoucher);
    }

    /**
     * Update the specified OrderVoucher in storage.
     *
     * @param int $id
     * @param UpdateOrderVoucherRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrderVoucherRequest $request)
    {
        $orderVoucher = $this->orderVoucherRepository->find($id);

        if (empty($orderVoucher)) {
            Flash::error('Order Voucher not found');

            return redirect(route('orderVouchers.index'));
        }

        $orderVoucher = $this->orderVoucherRepository->update($request->all(), $id);

        Flash::success('Order Voucher updated successfully.');

        return redirect(route('orderVouchers.index'));
    }

    /**
     * Remove the specified OrderVoucher from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $orderVoucher = $this->orderVoucherRepository->find($id);

        if (empty($orderVoucher)) {
            Flash::error('Order Voucher not found');

            return redirect(route('orderVouchers.index'));
        }

        $this->orderVoucherRepository->delete($id);

        Flash::success('Order Voucher deleted successfully.');

        return redirect(route('orderVouchers.index'));
    }
}
