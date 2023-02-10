<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateVoucherRequest;
use App\Http\Requests\UpdateVoucherRequest;
use App\Repositories\VoucherRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Response;

class VoucherController extends AppBaseController
{
    /** @var  VoucherRepository */
    private $voucherRepository;

    public function __construct(VoucherRepository $voucherRepo)
    {
        $this->voucherRepository = $voucherRepo;
    }

    /**
     * Display a listing of the Voucher.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $vouchers = $this->voucherRepository->all();

        
        return view('admin.vouchers.index')
            ->with('vouchers', $vouchers);
    }

    /**
     * Show the form for creating a new Voucher.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.vouchers.create');
    }

    /**
     * Store a newly created Voucher in storage.
     *
     * @param CreateVoucherRequest $request
     *
     * @return Response
     */
    public function store(CreateVoucherRequest $request)
    {
        $input = $request->all();

        $input["code"] = Str::slug($input["code"]);
        $input["start_date"] = strtotime($input["start_date"]);
        $input["end_date"] = strtotime($input["end_date"]);
        $input["created_by"] = Auth::user()->id;
        $input["min_order_amount"] = $request["min_order_amount"] ?? 0;
        $input["min_quantity_item"] = empty($input["min_quantity_item"]) ? 0 : $request["min_quantity_item"];
		$input["status"] = $request["status"];
        $this->voucherRepository->create($input);

        Flash::success('Voucher saved successfully.');

        return redirect(route('vouchers.index'));
    }

    /**
     * Display the specified Voucher.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $voucher = $this->voucherRepository->find($id);

        if (empty($voucher)) {
            Flash::error('Voucher not found');

            return redirect(route('vouchers.index'));
        }

        return view('admin.vouchers.show')->with('voucher', $voucher);
    }

    /**
     * Show the form for editing the specified Voucher.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $voucher = $this->voucherRepository->find($id);
//		pd($voucher);
        if (empty($voucher)) {
            Flash::error('Voucher not found');

            return redirect(route('vouchers.index'));
        }

        return view('admin.vouchers.edit')->with('voucher', $voucher);
    }

    /**
     * Update the specified Voucher in storage.
     *
     * @param int $id
     * @param UpdateVoucherRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVoucherRequest $request)
    {
        $voucher = $this->voucherRepository->find($id);

        if (empty($voucher)) {
            Flash::error('Voucher not found');

            return redirect(route('vouchers.index'));
        }

        $request = $request->all();
        $request["start_date"] = strtotime($request["start_date"]);
        $request["end_date"] = strtotime($request["end_date"]);
        $request["created_by"] = Auth::user()->id;
        $request["min_order_amount"] = $request["min_order_amount"] ?? 0;
        $request["min_quantity_item"] = $request["min_quantity_item"] ?? 0;
        $this->voucherRepository->update($request, $id);

        Flash::success('Voucher updated successfully.');

        return redirect(route('vouchers.index'));
    }

    /**
     * Remove the specified Voucher from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $voucher = $this->voucherRepository->find($id);

        if (empty($voucher)) {
            Flash::error('Voucher not found');

            return redirect(route('vouchers.index'));
        }

        $this->voucherRepository->delete($id);

        Flash::success('Voucher deleted successfully.');

        return redirect(route('vouchers.index'));
    }
}
