<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateCategoryRequest;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Flash;
use App\Models\SeoContent;
use Illuminate\Support\Str;

class CategoryController extends AppBaseController
{
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = Category::paginate(15);
        return view('admin.categories.index')->with('categories', $categories);
    }


    /**
     * Show the form for creating a new Category.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created Category in storage.
     *
     * @param CreateCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $input = $request->all();
        $input = array_merge(["slug" => Str::slug($request->name, "_")], $input);
        $this->categoryRepository->create($input);
        Flash::success('Category saved successfully.');

        return redirect(route('categories.index'));
    }

    /**
     * Display the specified Category.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $category = $this->categoryRepository->find($id);

        if (empty($category)) {
            Flash::error('Category not found');

            return redirect(route('categories.index'));
        }

        return view('admin.categories.show')->with('category', $category);
    }

    /**
     * Show the form for editing the specified Category.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $category = $this->categoryRepository->find($id);
        $seoContent = SeoContent::where("entity_type", SeoContent::SEO_CATEGORY)
        ->where("entity_id", $category->id)
        ->first();
        if (empty($category)) {
            Flash::error('Category not found');

            return redirect(route('categories.index'));
        }

        return view('admin.categories.edit')
			->with('seoContent', $seoContent)
            ->with('category', $category);
    }

    /**
     * Update the specified Category in storage.
     *
     * @param int $id
     * @param CreateCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, CreateCategoryRequest $request)
    {
        $category = $this->categoryRepository->find($id);

        if (empty($category)) {
            Flash::error('Category not found');

            return redirect(route('categories.index'));
        }

        $data["slug"] = Str::slug($request->name, "_");
        $this->categoryRepository->update($request->all(), $id);

        Flash::success('Category updated successfully.');

        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified Category from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $category = $this->categoryRepository->find($id);

        if (empty($category)) {
            Flash::error('Category not found');

            return redirect(route('categories.index'));
        }

        $this->categoryRepository->delete($id);

        Flash::success('Category deleted successfully.');

        return redirect(route('categories.index'));
    }
}
