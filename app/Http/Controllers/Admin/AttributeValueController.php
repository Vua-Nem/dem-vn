<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateAttributeValueRequest;
use App\Http\Requests\UpdateAttributeValueRequest;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Repositories\AttributeRepository;
use App\Repositories\AttributeValueRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Str;
use Response;

class AttributeValueController extends AppBaseController
{
    /** @var  AttributeValueRepository */
    private $attributeValueRepository;

    public function __construct(AttributeValueRepository $attributeValueRepo)
    {
        $this->attributeValueRepository = $attributeValueRepo;
    }

    /**
     * Display a listing of the AttributeValue.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $attributeValues = AttributeValue::with("attribute")->paginate(15);

        return view('admin.attribute_values.index')
            ->with('attributeValues', $attributeValues);
    }

    /**
     * Show the form for creating a new AttributeValue.
     *
     * @return Response
     */
    public function create()
    {
        $attributes = Attribute::all();

        return view('admin.attribute_values.create', ["attributes" => $attributes]);
    }

    /**
     * Store a newly created AttributeValue in storage.
     *
     * @param CreateAttributeValueRequest $request
     *
     * @return Response
     */
    public function store(CreateAttributeValueRequest $request)
    {

        $input = array_merge(["code" => Str::slug($request->value, '_')], $request->all());

        $this->attributeValueRepository->create($input);

        Flash::success('Attribute Value saved successfully.');

        return redirect(route('attributeValues.index'));
    }

    /**
     * Display the specified AttributeValue.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $attributeValue = $this->attributeValueRepository->find($id);

        if (empty($attributeValue)) {
            Flash::error('Attribute Value not found');

            return redirect(route('attributeValues.index'));
        }

        return view('admin.attribute_values.show')->with('attributeValue', $attributeValue);
    }

    /**
     * Show the form for editing the specified AttributeValue.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $attributeValue = $this->attributeValueRepository->find($id);

        if (empty($attributeValue)) {
            Flash::error('Attribute Value not found');

            return redirect(route('attributeValues.index'));
        }

        return view('admin.attribute_values.edit')->with('attributeValue', $attributeValue);
    }

    /**
     * Update the specified AttributeValue in storage.
     *
     * @param int $id
     * @param UpdateAttributeValueRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAttributeValueRequest $request)
    {
        $attributeValue = $this->attributeValueRepository->find($id);

        if (empty($attributeValue)) {
            Flash::error('Attribute Value not found');

            return redirect(route('attributeValues.index'));
        }

        $attributeValue = $this->attributeValueRepository->update($request->all(), $id);

        Flash::success('Attribute Value updated successfully.');

        return redirect(route('attributeValues.index'));
    }

    /**
     * Remove the specified AttributeValue from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $attributeValue = $this->attributeValueRepository->find($id);

        if (empty($attributeValue)) {
            Flash::error('Attribute Value not found');

            return redirect(route('attributeValues.index'));
        }

        $this->attributeValueRepository->delete($id);

        Flash::success('Attribute Value deleted successfully.');

        return redirect(route('attributeValues.index'));
    }
}
