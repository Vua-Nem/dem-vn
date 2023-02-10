<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateTopProductRequest;
use App\Http\Requests\UpdateTopProductRequest;
use App\Repositories\TopProductRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class TopProductController extends AppBaseController
{
    /** @var  TopProductRepository */
    private $topProductRepository;

    public function __construct(TopProductRepository $topProductRepo)
    {
        $this->topProductRepository = $topProductRepo;
    }

    /**
     * Display a listing of the TopProduct.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $topProducts = $this->topProductRepository->all();

        return view('admin.top_products.index')
            ->with('topProducts', $topProducts);
    }

    /**
     * Show the form for creating a new TopProduct.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.top_products.create');
    }

    /**
     * Store a newly created TopProduct in storage.
     *
     * @param CreateTopProductRequest $request
     *
     * @return Response
     */
    public function store(CreateTopProductRequest $request)
    {
        $input = $request->all();

        $topProduct = $this->topProductRepository->create($input);

        Flash::success('Top Product saved successfully.');

        return redirect(route('topProducts.index'));
    }

    /**
     * Display the specified TopProduct.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $topProduct = $this->topProductRepository->find($id);

        if (empty($topProduct)) {
            Flash::error('Top Product not found');

            return redirect(route('topProducts.index'));
        }

        return view('admin.top_products.show')->with('topProduct', $topProduct);
    }

    /**
     * Show the form for editing the specified TopProduct.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $topProduct = $this->topProductRepository->find($id);

        if (empty($topProduct)) {
            Flash::error('Top Product not found');

            return redirect(route('topProducts.index'));
        }

        return view('admin.top_products.edit')->with('topProduct', $topProduct);
    }

    /**
     * Update the specified TopProduct in storage.
     *
     * @param int $id
     * @param UpdateTopProductRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTopProductRequest $request)
    {
        $topProduct = $this->topProductRepository->find($id);

        if (empty($topProduct)) {
            Flash::error('Top Product not found');

            return redirect(route('topProducts.index'));
        }

        $topProduct = $this->topProductRepository->update($request->all(), $id);

        Flash::success('Top Product updated successfully.');

        return redirect(route('topProducts.index'));
    }

    /**
     * Remove the specified TopProduct from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $topProduct = $this->topProductRepository->find($id);

        if (empty($topProduct)) {
            Flash::error('Top Product not found');

            return redirect(route('topProducts.index'));
        }

        $this->topProductRepository->delete($id);

        Flash::success('Top Product deleted successfully.');

        return redirect(route('topProducts.index'));
    }
}
