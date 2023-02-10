<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Services\FileUploadService;
use Flash;
use Response;
use App\Repositories\ReviewRepository;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\ReviewImage;
use App\Repositories\ReviewImageRepository;


class ReviewController extends AppBaseController
{
    private $reviewImageRepository;
    private $reviewRepository;

    public function __construct(ReviewRepository $reviewRepo, ReviewImageRepository $reviewImageRepo)
    {
        $this->reviewRepository = $reviewRepo;
        $this->reviewImageRepository = $reviewImageRepo;
    }

    public function index()
    {
        $reviews = Review::with('getUser', 'reviewImage', 'getProduct')->paginate(10);
        return view('admin.reviews.index')
            ->with('reviews', $reviews);
    }

    public function show($id)
    {
        $review = $this->reviewRepository->find($id);

        if (empty($review)) {
            Flash::error('Review not found');

            return redirect(route('reviews.index'));
        }

        return view('admin.reviews.show')->with('review', $review);
    }

    public function create()
    {
        $products = Product::all();
        return view('admin.reviews.create', compact("products"));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $arrayReview = $request->only("status", "default_img", "entity_id", "content", "user_id", "entity_type");
        $user = User::firstOrNew(['email' => Str::slug($input['name'], '') . "@gmail.com"],
            [
                'name' => $input['name'],
                'password' => Hash::make(123456),
                'admin_level' => 0
            ]
        );
        $user->save();

        $arrayReview["user_id"] = $user->id;
        $review = $this->reviewRepository->create($arrayReview);

        if (isset($arrayReview["default_img"])) {
            $fileUpload = new FileUploadService();

            $fileUploadResult = $fileUpload->upLoadImages($arrayReview['default_img'], "public/reviews/" . $review->id);
            $img_name = last(explode("/", $fileUploadResult["path"]));
            $review['path'] = $fileUploadResult["path"];
            $reviewImage = [
                'review_id' => $review->id,
                'path' => $review['path'],
                'file_name' => $img_name
            ];
            $this->reviewImageRepository->create($reviewImage);
        }
        return view('admin.reviews.show', compact('review'));
    }

    public function edit($id)
    {
        $review = $this->reviewRepository->find($id);
        $products = Product::all();
        if (empty($review)) {
            Flash::error('Review not found');

            return redirect(route('reviews.index'));
        }

        return view('admin.reviews.edit')->with('review', $review)->with('products', $products);
    }

    public function update($id, Request $request)
    {
        $review = $this->reviewRepository->find($id);
        $input = $request->all();
        $arrayReview = $request->only("status", "entity_id", "content", "user_id", "entity_type");
        $user = User::firstOrNew(['email' => Str::slug($input['name'], '') . "@gmail.com"],
            [
                'name' => $input['name'],
                'password' => Hash::make(123456),
                'admin_level' => 0
            ]
        );
        $user->save();

        $arrayReview["user_id"] = $user->id;
        $review = $this->reviewRepository->update($arrayReview, $id);

        if (isset($input["default_img"])) {
            $fileUpload = new FileUploadService();
            $fileUploadResult = $fileUpload->upLoadImages($input['default_img'], "public/reviews/" . $review->id);
            $img_name = last(explode("/", $fileUploadResult["path"]));
            $arrayReview['path'] = $fileUploadResult["path"];
            $reviewImage = [
                'path' => $arrayReview['path'],
                'file_name' => $img_name
            ];
            ReviewImage::where('review_id', $id)->update($reviewImage);
        }

        return view('admin.reviews.show', compact('review'));
    }


    public function destroy($id)
    {
        $review = $this->reviewRepository->find($id);
        if (empty($review)) {
            Flash::error('Review not found');
            return redirect(route('reviews.index'));
        }

        try {
            $this->reviewRepository->delete($id);
            ReviewImage::where('review_id', $id)->delete();
        } catch (\Exception $exception) {
            Flash::error('Review errors');
            return redirect(route('reviews.index'));
        }

        Flash::success('Review deleted successfully.');
        return redirect(route('reviews.index'));
    }

}
