<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateTmpProductRequest;
use App\Http\Requests\UpdateTmpProductRequest;
use App\Repositories\TmpProductRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class TmpProductController extends AppBaseController
{
    /** @var  TmpProductRepository */
    private $tmpProductRepository;

    public function __construct(TmpProductRepository $tmpProductRepo)
    {
        $this->tmpProductRepository = $tmpProductRepo;
    }

    /**
     * Display a listing of the TmpProduct.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $tmpProducts = $this->tmpProductRepository->paginate(15);

        return view('admin.tmp_products.index')
            ->with('tmpProducts', $tmpProducts);
    }

    /**
     * Show the form for creating a new TmpProduct.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.tmp_products.create');
    }

    /**
     * Store a newly created TmpProduct in storage.
     *
     * @param CreateTmpProductRequest $request
     *
     * @return Response
     */
    public function store(CreateTmpProductRequest $request)
    {
        $input = $request->all();

        $tmpProduct = $this->tmpProductRepository->create($input);

        Flash::success('Tmp Product saved successfully.');

        return redirect(route('tmpProducts.index'));
    }

    /**
     * Display the specified TmpProduct.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tmpProduct = $this->tmpProductRepository->find($id);

        if (empty($tmpProduct)) {
            Flash::error('Tmp Product not found');

            return redirect(route('tmpProducts.index'));
        }

        return view('admin.tmp_products.show')->with('tmpProduct', $tmpProduct);
    }

    /**
     * Show the form for editing the specified TmpProduct.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tmpProduct = $this->tmpProductRepository->find($id);

        if (empty($tmpProduct)) {
            Flash::error('Tmp Product not found');

            return redirect(route('tmpProducts.index'));
        }

        return view('admin.tmp_products.edit')->with('tmpProduct', $tmpProduct);
    }

    /**
     * Update the specified TmpProduct in storage.
     *
     * @param int $id
     * @param UpdateTmpProductRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTmpProductRequest $request)
    {
        $tmpProduct = $this->tmpProductRepository->find($id);

        if (empty($tmpProduct)) {
            Flash::error('Tmp Product not found');

            return redirect(route('tmpProducts.index'));
        }

        $tmpProduct = $this->tmpProductRepository->update($request->all(), $id);

        Flash::success('Tmp Product updated successfully.');

        return redirect(route('tmpProducts.index'));
    }

    /**
     * Remove the specified TmpProduct from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tmpProduct = $this->tmpProductRepository->find($id);

        if (empty($tmpProduct)) {
            Flash::error('Tmp Product not found');

            return redirect(route('tmpProducts.index'));
        }

        $this->tmpProductRepository->delete($id);

        Flash::success('Tmp Product deleted successfully.');

        return redirect(route('tmpProducts.index'));
    }
}
