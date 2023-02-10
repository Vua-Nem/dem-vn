<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateCountDownRequest;
use App\Http\Requests\UpdateCountDownRequest;
use App\Models\CountDown;
use App\Repositories\CountDownRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class CountDownController extends AppBaseController
{
    /** @var  CountDownRepository */
    private $countDownRepository;

    public function __construct(CountDownRepository $countDownRepo)
    {
        $this->countDownRepository = $countDownRepo;
    }

    /**
     * Display a listing of the CountDown.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $countDowns = $this->countDownRepository->all();
        return view('admin.count_downs.index')
            ->with('countDowns', $countDowns);
    }

    /**
     * Show the form for creating a new CountDown.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.count_downs.create');
    }

    /**
     * Store a newly created CountDown in storage.
     *
     * @param CreateCountDownRequest $request
     *
     * @return Response
     */
    public function store(CreateCountDownRequest $request)
    {
        $input = $request->all();
		$input["entity_id"] = $request["entity_id"];
		$input["entity_type"] = $request["entity_type"];
		$input["status"] = $request["status"];
		$input["start_hour"] = $request["start_hour"];

        $countDown = $this->countDownRepository->create($input);
        Flash::success('Count Down saved successfully.');

        return redirect(route('countDowns.index'));
    }

    /**
     * Display the specified CountDown.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $countDown = $this->countDownRepository->find($id);

        if (empty($countDown)) {
            Flash::error('Count Down not found');

            return redirect(route('countDowns.index'));
        }

        return view('admin.count_downs.show')->with('countDown', $countDown);
    }

    /**
     * Show the form for editing the specified CountDown.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $countDown = $this->countDownRepository->find($id);
        if (empty($countDown)) {
            Flash::error('Count Down not found');

            return redirect(route('countDowns.index'));
        }

        return view('admin.count_downs.edit')->with('countDown', $countDown);
    }

    /**
     * Update the specified CountDown in storage.
     *
     * @param int $id
     * @param UpdateCountDownRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCountDownRequest $request)
    {
        $countDown = $this->countDownRepository->find($id);


        if (empty($countDown)) {
            Flash::error('Count Down not found');

            return redirect(route('countDowns.index'));
        }
		$request = $request->all();

		$this->countDownRepository->update($request, $id);

        Flash::success('Count Down updated successfully.');

        return redirect(route('countDowns.index'));
    }

    /**
     * Remove the specified CountDown from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $countDown = $this->countDownRepository->find($id);

        if (empty($countDown)) {
            Flash::error('Count Down not found');

            return redirect(route('countDowns.index'));
        }

        $this->countDownRepository->delete($id);

        Flash::success('Count Down deleted successfully.');

        return redirect(route('countDowns.index'));
    }

	public function countDownProduct(Request $request){
		$countDown = CountDown::where('entity_id',$request->entity_id)->first();
		if(isset($countDown))
			return view('admin.count_downs.edit')
				->with('entity_id',$countDown->entity_id)
				->with('entity_type',$countDown->entity_type)
				->with('countDown',$countDown);
		return view('admin.count_downs.create')
			->with('entity_id',$request->entity_id);
	}
}
