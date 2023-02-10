<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateRetailerAddressRequest;
use App\Http\Requests\UpdateRetailerAddressRequest;
use App\Models\RetailerAddress;
use App\Models\SeoContent;
use App\Models\StoreDistricts;
use App\Models\StoreProvinces;
use App\Repositories\RetailerAddressRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Province;
use Flash;
use Response;
use Illuminate\Support\Str;


class RetailerAddressController extends AppBaseController
{
	/** @var  RetailerAddressRepository */
	private $retailerAddressRepository;

	public function __construct(RetailerAddressRepository $retailerAddressRepo)
	{
		$this->retailerAddressRepository = $retailerAddressRepo;
	}

	/**
	 * Display a listing of the RetailerAddress.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$request = $request->all();
		$province = Province::select('id', 'name')->get();
		$district = District::select('id', 'name')->get();
		$provinces = $this->getNewArray($province);
		$districts = $this->getNewArray($district);

		$query = RetailerAddress::query();
		if (isset($request["name"]))
			$query = $query->where("name", "like", "%" . $request["name"] . "%");

		$retailerAddresses = $query->orderBy('id', 'desc')->paginate(15);

		return view('admin.retailer_addresses.index')
			->with('retailerAddresses', $retailerAddresses)
			->with('provinces', $provinces)
			->with('districts', $districts);
	}

	/**
	 * Show the form for creating a new RetailerAddress.
	 *
	 * @return Response
	 */
	public function create()
	{
		$provinces = Province::all();
		$districts = District::all();

		return view('admin.retailer_addresses.create')
			->with('provinces', $provinces)
			->with('districts', $districts);
	}

	/**
	 * Store a newly created RetailerAddress in storage.
	 *
	 * @param CreateRetailerAddressRequest $request
	 *
	 * @return Responsehome
	 */
	public function store(CreateRetailerAddressRequest $request)
	{
		$input = $request->all();
		if(empty($input["slug"]))
			$input["slug"] = Str::slug($request->name, "-");
		$retailerAddress = $this->retailerAddressRepository->create($input);
		StoreDistricts::insert(
			[

				'store_id' => $retailerAddress->id,
				'district_id' => $retailerAddress->district_id,
				'province_id' => $retailerAddress->province_id,
			]
		);
		StoreProvinces::insert(
			[
				'store_id' => $retailerAddress->id,
				'province_id' => $retailerAddress->province_id,
			]
		);

		Flash::success('Retailer Address saved successfully.');

		return redirect(route('retailerAddresses.index'));
	}

	/**
	 * Display the specified RetailerAddress.
	 *
	 * @param int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$retailerAddress = $this->retailerAddressRepository->find($id);

		if (empty($retailerAddress)) {
			Flash::error('Retailer Address not found');

			return redirect(route('retailerAddresses.index'));
		}

		return view('admin.retailer_addresses.show')->with('retailerAddress', $retailerAddress);
	}

	/**
	 * Show the form for editing the specified RetailerAddress.
	 *
	 * @param int $id
	 *
	 * @return Response
	 */
	public function edit($id)
	{

		$provinces = Province::all();
		$districts = District::all();
		$retailerAddress = $this->retailerAddressRepository->find($id);
		$seoContent = SeoContent::where("entity_type", SeoContent::SEO_STORE)
		->where("entity_id", $retailerAddress->id)
		->first();

		if (empty($retailerAddress)) {
			Flash::error('Retailer Address not found');
			return redirect(route('retailerAddresses.index'));
		}

		return view('admin.retailer_addresses.edit')->with('retailerAddress', $retailerAddress)
			->with('seoContent', $seoContent)
			->with('provinces', $provinces)
			->with('districts', $districts);
	}

	/**
	 * Update the specified RetailerAddress in storage.
	 *
	 * @param int $id
	 * @param UpdateRetailerAddressRequest $request
	 *
	 * @return Response
	 */
	public function update($id, UpdateRetailerAddressRequest $request)
	{
		$input = $request->all();
		$retailerAddress = $this->retailerAddressRepository->find($id);

		if (empty($retailerAddress)) {
			Flash::error('Retailer Address not found');

			return redirect(route('retailerAddresses.index'));
		}
		if(empty($input["slug"]))
			$input["slug"] = Str::slug($request->name, "-");
		$retailerAddress = $this->retailerAddressRepository->update($input, $id);

		Flash::success('Retailer Address updated successfully.');

		return redirect(route('retailerAddresses.index'));
	}

	/**
	 * Remove the specified RetailerAddress from storage.
	 *
	 * @param int $id
	 *
	 * @throws \Exception
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		$retailerAddress = $this->retailerAddressRepository->find($id);

		if (empty($retailerAddress)) {
			Flash::error('Retailer Address not found');

			return redirect(route('retailerAddresses.index'));
		}

		$this->retailerAddressRepository->delete($id);

		Flash::success('Retailer Address deleted successfully.');

		return redirect(route('retailerAddresses.index'));
	}

	public function getNewArray($array)
	{
		$arrayNew = [];
		foreach ($array as $value) {
			$arrayNew[$value->id] = $value->name;
		}

		return $arrayNew;
	}
}
