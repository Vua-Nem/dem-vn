<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateBannerRequest;
use App\Http\Requests\UpdateBannerRequest;
use App\Models\Banner;
use App\Repositories\BannerRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Services\FileUploadService;
use Flash;
use Illuminate\Support\Facades\Validator;
use Response;

class BannerController extends AppBaseController
{
    /** @var  BannerRepository */
    private $bannerRepository;

    public function __construct(BannerRepository $bannerRepo)
    {
        $this->bannerRepository = $bannerRepo;
    }

    /**
     * Display a listing of the Banner.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
    	$query = Banner::query();
		if (isset($request->date_start))
			$query = $query->where('time_start',">=",strtotime($request->date_start));

		if (isset($request->date_end))
			$query = $query->where('time_start','<=',strtotime($request->date_end));
		if (isset($request->status))
			$query = $query->where('status',$request->status);
		if (isset($request->type))
			$query = $query->where('type',$request->type);
		if (isset($request->is_mobile))
			$query = $query->where('is_mobile',$request->is_mobile);
		$banners = $query->orderBy('status','desc')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.banners.index')
            ->with('banners', $banners);
    }

    /**
     * Show the form for creating a new Banner.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
     * Store a newly created Banner in storage.
     *
     * @param CreateBannerRequest $request
     *
     * @return Response
     */
    public function store(CreateBannerRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'slost' => 'required|integer|max:10',
            'default_img' => 'required',
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $input = $request->all();
        $input['slost'] = $input['slost'] ?? 0;
        $image = $input['default_img'];
        $path = "public/banners";
        $fileUpload = new FileUploadService();
        $fileUploadResult = $fileUpload->upLoadImages($image, $path);
        $name = last(explode("/", $fileUploadResult["path"]));

        $input['name'] = $name;
        $input['path'] = $fileUploadResult["path"];

        $startDate = strtotime($input['time_start']);
        $endDate = strtotime($input['time_end']);

        if (!isset($input['time_start'])) {
            $input['time_start'] = time();
        } elseif (!isset($input['time_end'])) {
            $input['time_end'] = strtotime("+3 Years");
        } else {
            $input['time_start'] = $startDate;
            $input['time_end'] = $endDate;
        }

        $this->bannerRepository->create($input);

        Flash::success('Banner saved successfully.');

        return redirect(route('banners.index'));
    }

    /**
     * Display the specified Banner.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $banner = $this->bannerRepository->find($id);

        if (empty($banner)) {
            Flash::error('Banner not found');

            return redirect(route('banners.index'));
        }

        return view('admin.banners.show')->with('banner', $banner);
    }

    /**
     * Show the form for editing the specified Banner.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $banner = $this->bannerRepository->find($id);

        if (empty($banner)) {
            Flash::error('Banner not found');

            return redirect(route('banners.index'));
        }

        return view('admin.banners.edit')->with('banner', $banner);
    }

    /**
     * Update the specified Banner in storage.
     *
     * @param int $id
     * @param UpdateBannerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBannerRequest $request)
    {
        $banner = $this->bannerRepository->find($id);
		$fileUpload = new FileUploadService();
        if (empty($banner)) {
            Flash::error('Banner not found');

            return redirect(route('banners.index'));
        }

        $data = $request->all();

		if (isset($data["default_img"]) && !empty($data["default_img"])) {

			$path = "public/banners";

			$image = $data['default_img'];
			$path = $fileUpload->upLoadImages($image, $path, ["size" => ["410" => ["width" => 410]]]);
			$name = last(explode("/", $path['path']));
			$data['name']   = $name;
			$data['path']   = $path['path'];

		}

        $data['time_start'] = isset($data['time_start']) ? strtotime($data['time_start']) : time();
        $data['time_end'] = isset($data['time_end']) ? strtotime($data['time_end']) : time() + 84600;
        $this->bannerRepository->update($data, $id);

        Flash::success('Banner updated successfully.');
        return redirect(route('banners.index'));
    }

    /**
     * Remove the specified Banner from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $banner = $this->bannerRepository->find($id);

        $path = "public/banners";
        if (empty($banner)) {
            Flash::error('Banner not found');

            return redirect(route('banners.index'));
        }

        if ($this->bannerRepository->delete($id))
            unlink(storage_path('app/' . $path . '/' . $banner->name));

        Flash::success('Banner deleted successfully.');

        return redirect(route('banners.index'));
    }


	public function postUpdateStatus(Request $request)
	{
		$row = Banner::find($request->id);

		$row->status = $request->stat;
		if($row->save()){
			return json_encode(array('result'=>'1','stat'=>$request->stat));
		}
		return json_encode(array('result'=>'2','stat'=>$request->stat));
	}
}
