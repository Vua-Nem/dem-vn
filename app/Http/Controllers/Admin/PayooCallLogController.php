<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreatePayooCallLogRequest;
use App\Http\Requests\UpdatePayooCallLogRequest;
use App\Repositories\PayooCallLogRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class PayooCallLogController extends AppBaseController
{
    /** @var  PayooCallLogRepository */
    private $payooCallLogRepository;

    public function __construct(PayooCallLogRepository $payooCallLogRepo)
    {
        $this->payooCallLogRepository = $payooCallLogRepo;
    }

    /**
     * Display a listing of the PayooCallLog.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $payooCallLogs = $this->payooCallLogRepository->all();

        return view('admin.payoo_call_logs.index')
            ->with('payooCallLogs', $payooCallLogs);
    }

    /**
     * Show the form for creating a new PayooCallLog.
     *
     * @return Response
     */
    public function create()
    {
        return redirect(route('payooCallLogs.index'));
        // return view('admin.payoo_call_logs.create');
    }

    /**
     * Store a newly created PayooCallLog in storage.
     *
     * @param CreatePayooCallLogRequest $request
     *
     * @return Response
     */
    public function store(CreatePayooCallLogRequest $request)
    {
        return redirect(route('payooCallLogs.index'));
        // $input = $request->all();

        // $payooCallLog = $this->payooCallLogRepository->create($input);

        // Flash::success('Payoo Call Log saved successfully.');

        // return redirect(route('payooCallLogs.index'));
    }

    /**
     * Display the specified PayooCallLog.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $payooCallLog = $this->payooCallLogRepository->find($id);

        if (empty($payooCallLog)) {
            Flash::error('Payoo Call Log not found');

            return redirect(route('payooCallLogs.index'));
        }

        return view('admin.payoo_call_logs.show')->with('payooCallLog', $payooCallLog);
    }

    /**
     * Show the form for editing the specified PayooCallLog.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        return redirect(route('payooCallLogs.index'));
        // $payooCallLog = $this->payooCallLogRepository->find($id);

        // if (empty($payooCallLog)) {
        //     Flash::error('Payoo Call Log not found');

        //     return redirect(route('payooCallLogs.index'));
        // }

        // return view('admin.payoo_call_logs.edit')->with('payooCallLog', $payooCallLog);
    }

    /**
     * Update the specified PayooCallLog in storage.
     *
     * @param int $id
     * @param UpdatePayooCallLogRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePayooCallLogRequest $request)
    {
        return redirect(route('payooCallLogs.index'));
        // $payooCallLog = $this->payooCallLogRepository->find($id);

        // if (empty($payooCallLog)) {
        //     Flash::error('Payoo Call Log not found');

        //     return redirect(route('payooCallLogs.index'));
        // }

        // $payooCallLog = $this->payooCallLogRepository->update($request->all(), $id);

        // Flash::success('Payoo Call Log updated successfully.');

        // return redirect(route('payooCallLogs.index'));
    }

    /**
     * Remove the specified PayooCallLog from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        return redirect(route('payooCallLogs.index'));
        // $payooCallLog = $this->payooCallLogRepository->find($id);

        // if (empty($payooCallLog)) {
        //     Flash::error('Payoo Call Log not found');

        //     return redirect(route('payooCallLogs.index'));
        // }

        // $this->payooCallLogRepository->delete($id);

        // Flash::success('Payoo Call Log deleted successfully.');

        // return redirect(route('payooCallLogs.index'));
    }
}
