<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreatePromotionObjectRequest;
use App\Http\Requests\UpdatePromotionObjectRequest;
use App\Repositories\PromotionObjectRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class PromotionObjectController extends AppBaseController
{
    /** @var  PromotionObjectRepository */
    private $promotionObjectRepository;

    public function __construct(PromotionObjectRepository $promotionObjectRepo)
    {
        $this->promotionObjectRepository = $promotionObjectRepo;
    }

    /**
     * Display a listing of the PromotionObject.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $promotionObjects = $this->promotionObjectRepository->all();

        return view('admin.promotion_objects.index')
            ->with('promotionObjects', $promotionObjects);
    }

    /**
     * Show the form for creating a new PromotionObject.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.promotion_objects.create');
    }

    /**
     * Store a newly created PromotionObject in storage.
     *
     * @param CreatePromotionObjectRequest $request
     *
     * @return Response
     */
    public function store(CreatePromotionObjectRequest $request)
    {
        $input = $request->all();

        $promotionObject = $this->promotionObjectRepository->create($input);

        Flash::success('Promotion Object saved successfully.');

        return redirect(route('promotionObjects.index'));
    }

    /**
     * Display the specified PromotionObject.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $promotionObject = $this->promotionObjectRepository->find($id);

        if (empty($promotionObject)) {
            Flash::error('Promotion Object not found');

            return redirect(route('promotionObjects.index'));
        }

        return view('admin.promotion_objects.show')->with('promotionObject', $promotionObject);
    }

    /**
     * Show the form for editing the specified PromotionObject.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $promotionObject = $this->promotionObjectRepository->find($id);

        if (empty($promotionObject)) {
            Flash::error('Promotion Object not found');

            return redirect(route('promotionObjects.index'));
        }

        return view('promotion_objects.edit')->with('promotionObject', $promotionObject);
    }

    /**
     * Update the specified PromotionObject in storage.
     *
     * @param int $id
     * @param UpdatePromotionObjectRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePromotionObjectRequest $request)
    {
        $promotionObject = $this->promotionObjectRepository->find($id);

        if (empty($promotionObject)) {
            Flash::error('Promotion Object not found');

            return redirect(route('promotionObjects.index'));
        }

        $promotionObject = $this->promotionObjectRepository->update($request->all(), $id);

        Flash::success('Promotion Object updated successfully.');

        return redirect(route('promotionObjects.index'));
    }

    /**
     * Remove the specified PromotionObject from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $promotionObject = $this->promotionObjectRepository->find($id);

        if (empty($promotionObject)) {
            Flash::error('Promotion Object not found');

            return redirect(route('promotionObjects.index'));
        }

        $this->promotionObjectRepository->delete($id);

        Flash::success('Promotion Object deleted successfully.');

        return redirect(route('promotionObjects.index'));
    }
}
