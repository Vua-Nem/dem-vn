<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreatePromotionRequest;
use App\Http\Requests\UpdatePromotionRequest;
use App\Models\Promotion;
use App\Models\PromotionObject;
use App\Repositories\PromotionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\DB;
use Response;

class PromotionController extends AppBaseController
{
    /** @var  PromotionRepository */
    private $promotionRepository;

    public function __construct(PromotionRepository $promotionRepo)
    {
        $this->promotionRepository = $promotionRepo;
    }

    /**
     * Display a listing of the Promotion.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $promotions = $this->promotionRepository->all();

        return view('admin.promotions.index')
            ->with('promotions', $promotions);
    }

    /**
     * Show the form for creating a new Promotion.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.promotions.create');
    }

    /**
     * Store a newly created Promotion in storage.
     *
     * @param CreatePromotionRequest $request
     *
     * @return Response
     */
    public function store(CreatePromotionRequest $request)
    {
        $input = $request->all();
        try {
            DB::beginTransaction();
            $promotion = new Promotion();
            $promotion->title = $input["title"];
            $promotion->promotion_type = $input["promotion_type"];
            $promotion->discount_type = $input["discount_type"];
            $promotion->discount_value = $input["discount_value"];
            $promotion->min_order_amount = $input["min_order_amount"];
            $promotion->min_quantity_item = $input["min_quantity_item"];
            $promotion->start_date = strtotime($input["start_date"]);
            $promotion->end_date = strtotime($input["end_date"]);
            $promotion->status = $input["status"];
            $promotion->save();

            if (!empty($input["promotion_objects"])) {
                $ary = explode(",", $input["promotion_objects"]);
                $insertAry = [];
                foreach ($ary as $value) {
                    $insertAry[] = [
                        "promotion_id" => $promotion->id,
                        "object_id" => trim($value),
                        "created_at" => date("Y-m-d H:i:s"),
                        "updated_at" => date("Y-m-d H:i:s")
                    ];
                }

                PromotionObject::insert($insertAry);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            Flash::error('Promotion Errors');

            return redirect(route('promotions.index'));
        }

        Flash::success('Promotion saved successfully.');

        return redirect(route('promotions.index'));
    }

    /**
     * Display the specified Promotion.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $promotion = $this->promotionRepository->find($id);


        if (empty($promotion)) {
            Flash::error('Promotion not found');

            return redirect(route('promotions.index'));
        }

        return view('admin.promotions.show')
            ->with('promotion', $promotion);
    }

    /**
     * Show the form for editing the specified Promotion.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $promotion = $this->promotionRepository->find($id);
        $promotionObjects = PromotionObject::where("promotion_id", $id)->get();
        $strObjects = '';

        foreach ($promotionObjects as $object) {
            if (!empty($strObjects)) {
                $strObjects .= ',' . $object->object_id;
                continue;
            }

            $strObjects .= $object->object_id;
        }

        if (empty($promotion)) {
            Flash::error('Promotion not found');

            return redirect(route('promotions.index'));
        }

        return view('admin.promotions.edit')
            ->with('strObjects', $strObjects)
            ->with('promotion', $promotion);
    }

    /**
     * Update the specified Promotion in storage.
     *
     * @param int $id
     * @param UpdatePromotionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePromotionRequest $request)
    {
        $promotion = $this->promotionRepository->find($id);

        if (empty($promotion)) {
            Flash::error('Promotion not found');

            return redirect(route('promotions.index'));
        }

        $aryUpdate = $request->all();
        $aryUpdate["start_date"] = strtotime($aryUpdate["start_date"]);
        $aryUpdate["end_date"] = strtotime($aryUpdate["end_date"]);

        if (!empty($aryUpdate["promotion_objects"])) {
            $ary = explode(",", $aryUpdate["promotion_objects"]);
            $insertAry = [];
            foreach ($ary as $value) {
                $insertAry[] = [
                    "promotion_id" => $id,
                    "object_id" => trim($value),
                    "created_at" => date("Y-m-d H:i:s"),
                    "updated_at" => date("Y-m-d H:i:s")
                ];
            }
            PromotionObject::where("promotion_id", $id)->delete();
            PromotionObject::insert($insertAry);
        }

        $this->promotionRepository->update($aryUpdate, $id);

        Flash::success('Promotion updated successfully.');

        return redirect(route('promotions.index'));
    }

    /**
     * Remove the specified Promotion from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $promotion = $this->promotionRepository->find($id);

        if (empty($promotion)) {
            Flash::error('Promotion not found');

            return redirect(route('promotions.index'));
        }

        $this->promotionRepository->delete($id);

        Flash::success('Promotion deleted successfully.');

        return redirect(route('promotions.index'));
    }
}
