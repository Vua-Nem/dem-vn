<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreatePayooIpnErrorLogRequest;
use App\Http\Requests\UpdatePayooIpnErrorLogRequest;
use App\Repositories\PayooIpnErrorLogRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class PayooIpnErrorLogController extends AppBaseController
{
    /** @var  PayooIpnErrorLogRepository */
    private $payooIpnErrorLogRepository;

    public function __construct(PayooIpnErrorLogRepository $payooIpnErrorLogRepo)
    {
        $this->payooIpnErrorLogRepository = $payooIpnErrorLogRepo;
    }

    /**
     * Display a listing of the PayooIpnErrorLog.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $payooIpnErrorLogs = $this->payooIpnErrorLogRepository->all();

        return view('admin.payoo_ipn_error_logs.index')
            ->with('payooIpnErrorLogs', $payooIpnErrorLogs);
    }

    /**
     * Show the form for creating a new PayooIpnErrorLog.
     *
     * @return Response
     */
    public function create()
    {
        return view('payoo_ipn_error_logs.create');
    }

    /**
     * Store a newly created PayooIpnErrorLog in storage.
     *
     * @param CreatePayooIpnErrorLogRequest $request
     *
     * @return Response
     */
    public function store(CreatePayooIpnErrorLogRequest $request)
    {
        $input = $request->all();

        $payooIpnErrorLog = $this->payooIpnErrorLogRepository->create($input);

        Flash::success('Payoo Ipn Error Log saved successfully.');

        return redirect(route('payooIpnErrorLogs.index'));
    }

    /**
     * Display the specified PayooIpnErrorLog.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $payooIpnErrorLog = $this->payooIpnErrorLogRepository->find($id);

        if (empty($payooIpnErrorLog)) {
            Flash::error('Payoo Ipn Error Log not found');

            return redirect(route('payooIpnErrorLogs.index'));
        }

        return view('payoo_ipn_error_logs.show')->with('payooIpnErrorLog', $payooIpnErrorLog);
    }

    /**
     * Show the form for editing the specified PayooIpnErrorLog.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $payooIpnErrorLog = $this->payooIpnErrorLogRepository->find($id);

        if (empty($payooIpnErrorLog)) {
            Flash::error('Payoo Ipn Error Log not found');

            return redirect(route('payooIpnErrorLogs.index'));
        }

        return view('payoo_ipn_error_logs.edit')->with('payooIpnErrorLog', $payooIpnErrorLog);
    }

    /**
     * Update the specified PayooIpnErrorLog in storage.
     *
     * @param int $id
     * @param UpdatePayooIpnErrorLogRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePayooIpnErrorLogRequest $request)
    {
        $payooIpnErrorLog = $this->payooIpnErrorLogRepository->find($id);

        if (empty($payooIpnErrorLog)) {
            Flash::error('Payoo Ipn Error Log not found');

            return redirect(route('payooIpnErrorLogs.index'));
        }

        $payooIpnErrorLog = $this->payooIpnErrorLogRepository->update($request->all(), $id);

        Flash::success('Payoo Ipn Error Log updated successfully.');

        return redirect(route('payooIpnErrorLogs.index'));
    }

    /**
     * Remove the specified PayooIpnErrorLog from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $payooIpnErrorLog = $this->payooIpnErrorLogRepository->find($id);

        if (empty($payooIpnErrorLog)) {
            Flash::error('Payoo Ipn Error Log not found');

            return redirect(route('payooIpnErrorLogs.index'));
        }

        $this->payooIpnErrorLogRepository->delete($id);

        Flash::success('Payoo Ipn Error Log deleted successfully.');

        return redirect(route('payooIpnErrorLogs.index'));
    }
}
