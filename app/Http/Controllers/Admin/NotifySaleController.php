<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateNotifySaleRequest;
use App\Http\Requests\UpdateNotifySaleRequest;
use App\Models\NotifySale;
use App\Repositories\NotifySaleRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class NotifySaleController extends AppBaseController
{
    /** @var  NotifySaleRepository */
    private $notifySaleRepository;

    public function __construct(NotifySaleRepository $notifySaleRepo)
    {
        $this->notifySaleRepository = $notifySaleRepo;
    }

    /**
     * Display a listing of the NotifySale.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $notifySales = $this->notifySaleRepository->all();

        return view('admin.notify_sales.index')
            ->with('notifySales', $notifySales);
    }

    /**
     * Show the form for creating a new NotifySale.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.notify_sales.create');
    }

    /**
     * Store a newly created NotifySale in storage.
     *
     * @param CreateNotifySaleRequest $request
     *
     * @return Response
     */
    public function store(CreateNotifySaleRequest $request)
    {
        $input = $request->all();

        $notifySale = $this->notifySaleRepository->create($input);

        Flash::success('Notify Sale saved successfully.');

        return redirect(route('notifySales.index'));
    }

    /**
     * Display the specified NotifySale.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $notifySale = $this->notifySaleRepository->find($id);

        if (empty($notifySale)) {
            Flash::error('Notify Sale not found');

            return redirect(route('notifySales.index'));
        }

        return view('admin.notify_sales.show')->with('notifySale', $notifySale);
    }

    /**
     * Show the form for editing the specified NotifySale.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $notifySale = $this->notifySaleRepository->find($id);

        if (empty($notifySale)) {
            Flash::error('Notify Sale not found');

            return redirect(route('notifySales.index'));
        }

        return view('admin.notify_sales.edit')->with('notifySale', $notifySale);
    }

    /**
     * Update the specified NotifySale in storage.
     *
     * @param int $id
     * @param UpdateNotifySaleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNotifySaleRequest $request)
    {
        $notifySale = $this->notifySaleRepository->find($id);

        if (empty($notifySale)) {
            Flash::error('Notify Sale not found');

            return redirect(route('notifySales.index'));
        }

        $notifySale = $this->notifySaleRepository->update($request->all(), $id);

        Flash::success('Notify Sale updated successfully.');

        return redirect(route('notifySales.index'));
    }

    /**
     * Remove the specified NotifySale from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $notifySale = $this->notifySaleRepository->find($id);

        if (empty($notifySale)) {
            Flash::error('Notify Sale not found');

            return redirect(route('notifySales.index'));
        }

        $this->notifySaleRepository->delete($id);

        Flash::success('Notify Sale deleted successfully.');

        return redirect(route('notifySales.index'));
    }

    public function addNotifySaleProduct(Request $request){
		$notifySale = NotifySale::where('product_id',$request->id)->first();
		if(isset($notifySale->product_id))
			return view('admin.notify_sales.edit')
				->with('notifySale', $notifySale)
				->with('product_id',$notifySale->id);
		$id = $request->id;
		return view('admin.notify_sales.create')
			->with('product_id',$request->id);
	}
}
