<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateWishListRequest;
use App\Http\Requests\UpdateWishListRequest;
use App\Repositories\WishListRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class WishListController extends AppBaseController
{
    /** @var  WishListRepository */
    private $wishListRepository;

    public function __construct(WishListRepository $wishListRepo)
    {
        $this->wishListRepository = $wishListRepo;
    }

    /**
     * Display a listing of the WishList.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $wishLists = $this->wishListRepository->all();

        return view('Admin.wish_lists.index')
            ->with('wishLists', $wishLists);
    }

    /**
     * Show the form for creating a new WishList.
     *
     * @return Response
     */
    public function create()
    {
        return view('Admin.wish_lists.create');
    }

    /**
     * Store a newly created WishList in storage.
     *
     * @param CreateWishListRequest $request
     *
     * @return Response
     */
    public function store(CreateWishListRequest $request)
    {
        $input = $request->all();

        $wishList = $this->wishListRepository->create($input);

        Flash::success('Wish List saved successfully.');

        return redirect(route('wishLists.index'));
    }

    /**
     * Display the specified WishList.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $wishList = $this->wishListRepository->find($id);

        if (empty($wishList)) {
            Flash::error('Wish List not found');

            return redirect(route('wishLists.index'));
        }

        return view('Admin.wish_lists.show')->with('wishList', $wishList);
    }

    /**
     * Show the form for editing the specified WishList.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $wishList = $this->wishListRepository->find($id);

        if (empty($wishList)) {
            Flash::error('Wish List not found');

            return redirect(route('wishLists.index'));
        }

        return view('Admin.wish_lists.edit')->with('wishList', $wishList);
    }

    /**
     * Update the specified WishList in storage.
     *
     * @param int $id
     * @param UpdateWishListRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateWishListRequest $request)
    {
        $wishList = $this->wishListRepository->find($id);

        if (empty($wishList)) {
            Flash::error('Wish List not found');

            return redirect(route('wishLists.index'));
        }

        $wishList = $this->wishListRepository->update($request->all(), $id);

        Flash::success('Wish List updated successfully.');

        return redirect(route('wishLists.index'));
    }

    /**
     * Remove the specified WishList from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $wishList = $this->wishListRepository->find($id);

        if (empty($wishList)) {
            Flash::error('Wish List not found');

            return redirect(route('wishLists.index'));
        }

        $this->wishListRepository->delete($id);

        Flash::success('Wish List deleted successfully.');

        return redirect(route('wishLists.index'));
    }
}
