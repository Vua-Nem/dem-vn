<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateOrderlogRequest;
use App\Http\Requests\UpdateOrderlogRequest;
use App\Repositories\OrderlogRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class OrderLogController extends AppBaseController
{
    /** @var  OrderlogRepository */
    private $orderlogRepository;

    public function __construct(OrderlogRepository $orderlogRepo)
    {
        $this->orderlogRepository = $orderlogRepo;
    }

    /**
     * Display a listing of the Orderlog.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $orderlogs = $this->orderlogRepository->all();

        return view('admin.orderlogs.index')
            ->with('orderlogs', $orderlogs);
    }

    /**
     * Show the form for creating a new Orderlog.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.orderlogs.create');
    }

    /**
     * Store a newly created Orderlog in storage.
     *
     * @param CreateOrderlogRequest $request
     *
     * @return Response
     */
    public function store(CreateOrderlogRequest $request)
    {
        $input = $request->all();

        $orderlog = $this->orderlogRepository->create($input);

        Flash::success('Orderlog saved successfully.');

        return redirect(route('orderlogs.index'));
    }

    /**
     * Display the specified Orderlog.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $orderlog = $this->orderlogRepository->find($id);

        if (empty($orderlog)) {
            Flash::error('Orderlog not found');

            return redirect(route('orderlogs.index'));
        }

        return view('admin.orderlogs.show')->with('orderlog', $orderlog);
    }

    /**
     * Show the form for editing the specified Orderlog.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $orderlog = $this->orderlogRepository->find($id);

        if (empty($orderlog)) {
            Flash::error('Orderlog not found');

            return redirect(route('orderlogs.index'));
        }

        return view('admin.orderlogs.edit')->with('orderlog', $orderlog);
    }

    /**
     * Update the specified Orderlog in storage.
     *
     * @param int $id
     * @param UpdateOrderlogRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrderlogRequest $request)
    {
        $orderlog = $this->orderlogRepository->find($id);

        if (empty($orderlog)) {
            Flash::error('Orderlog not found');

            return redirect(route('orderlogs.index'));
        }

        $orderlog = $this->orderlogRepository->update($request->all(), $id);

        Flash::success('Orderlog updated successfully.');

        return redirect(route('orderlogs.index'));
    }

    /**
     * Remove the specified Orderlog from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $orderlog = $this->orderlogRepository->find($id);

        if (empty($orderlog)) {
            Flash::error('Orderlog not found');

            return redirect(route('orderlogs.index'));
        }

        $this->orderlogRepository->delete($id);

        Flash::success('Orderlog deleted successfully.');

        return redirect(route('orderlogs.index'));
    }
}
