<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateVNPayCallLogsRequest;
use App\Http\Requests\UpdateVNPayCallLogsRequest;
use App\Repositories\VNPayCallLogsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class VNPayCallLogsController extends AppBaseController
{
    /** @var  VNPayCallLogsRepository */
    private $vNPayCallLogsRepository;

    public function __construct(VNPayCallLogsRepository $vNPayCallLogsRepo)
    {
        $this->vNPayCallLogsRepository = $vNPayCallLogsRepo;
    }

    /**
     * Display a listing of the VNPayCallLogs.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $vNPayCallLogs = $this->vNPayCallLogsRepository->paginate(15);

        return view('admin.v_n_pay_call_logs.index')
            ->with('vNPayCallLogs', $vNPayCallLogs);
    }

    /**
     * Show the form for creating a new VNPayCallLogs.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.v_n_pay_call_logs.create');
    }

    /**
     * Store a newly created VNPayCallLogs in storage.
     *
     * @param CreateVNPayCallLogsRequest $request
     *
     * @return Response
     */
    public function store(CreateVNPayCallLogsRequest $request)
    {
        $input = $request->all();

        $vNPayCallLogs = $this->vNPayCallLogsRepository->create($input);

        Flash::success('V N Pay Call Logs saved successfully.');

        return redirect(route('vNPayCallLogs.index'));
    }

    /**
     * Display the specified VNPayCallLogs.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $vNPayCallLogs = $this->vNPayCallLogsRepository->find($id);

        if (empty($vNPayCallLogs)) {
            Flash::error('V N Pay Call Logs not found');

            return redirect(route('vNPayCallLogs.index'));
        }

        return view('admin.v_n_pay_call_logs.show')->with('vNPayCallLogs', $vNPayCallLogs);
    }

    /**
     * Show the form for editing the specified VNPayCallLogs.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $vNPayCallLogs = $this->vNPayCallLogsRepository->find($id);

        if (empty($vNPayCallLogs)) {
            Flash::error('V N Pay Call Logs not found');

            return redirect(route('vNPayCallLogs.index'));
        }

        return view('admin.v_n_pay_call_logs.edit')->with('vNPayCallLogs', $vNPayCallLogs);
    }

    /**
     * Update the specified VNPayCallLogs in storage.
     *
     * @param int $id
     * @param UpdateVNPayCallLogsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVNPayCallLogsRequest $request)
    {
        $vNPayCallLogs = $this->vNPayCallLogsRepository->find($id);

        if (empty($vNPayCallLogs)) {
            Flash::error('V N Pay Call Logs not found');

            return redirect(route('vNPayCallLogs.index'));
        }

        $vNPayCallLogs = $this->vNPayCallLogsRepository->update($request->all(), $id);

        Flash::success('V N Pay Call Logs updated successfully.');

        return redirect(route('vNPayCallLogs.index'));
    }

    /**
     * Remove the specified VNPayCallLogs from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $vNPayCallLogs = $this->vNPayCallLogsRepository->find($id);

        if (empty($vNPayCallLogs)) {
            Flash::error('V N Pay Call Logs not found');

            return redirect(route('vNPayCallLogs.index'));
        }

        $this->vNPayCallLogsRepository->delete($id);

        Flash::success('V N Pay Call Logs deleted successfully.');

        return redirect(route('vNPayCallLogs.index'));
    }
}
