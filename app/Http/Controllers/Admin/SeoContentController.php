<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateSeoContenRequest;
use App\Http\Requests\UpdateSeoContenRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\SeoContent;
use App\Repositories\SeoContentRepository;
use Illuminate\Http\Request;
use Flash;
use Response;

class SeoContentController extends AppBaseController
{
    /** @var  SeoContenRepository */
    private $seoContentRepository;

    public function __construct(SeoContentRepository $seoContentRepo)
    {
        $this->seoContentRepository = $seoContentRepo;
    }

    /**
     * Display a listing of the SeoConten.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $seoContents = $this->seoContentRepository->paginate(20);
        return view('admin.seo_contents.index')
            ->with('seoContens', $seoContents);
    }

    /**
     * Show the form for creating a new SeoConten.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.seo_contents.create');
    }

    /**
     * Store a newly created SeoConten in storage.
     *
     * @param CreateSeoContenRequest $request
     *
     * @return Response
     */
    public function store(CreateSeoContenRequest $request)
    {
        $input = $request->all();

        $this->seoContentRepository->create($input);

        Flash::success('Seo Content saved successfully.');

//        return redirect(route('seoContents.index'));

        return redirect()->back();
    }

    /**
     * Display the specified SeoConten.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $seoConten = $this->seoContentRepository->find($id);

        if (empty($seoConten)) {
            Flash::error('Seo Content not found');

            return redirect(route('seoContents.index'));
        }

        return view('admin.seo_contents.show')->with('seoConten', $seoConten);
    }

    /**
     * Show the form for editing the specified SeoConten.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $seoConten = $this->seoContentRepository->find($id);

        if (empty($seoConten)) {
            Flash::error('Seo Content not found');

            return redirect(route('seoContents.index'));
        }
        return view('admin.seo_contents.edit')->with('seoConten', $seoConten);
    }

    /**
     * Update the specified SeoConten in storage.
     *
     * @param int $id
     * @param UpdateSeoContenRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSeoContenRequest $request)
    {
        $seoConten = $this->seoContentRepository->find($id);

        if (empty($seoConten)) {
            Flash::error('Seo Content not found');

            return redirect(route('seoContents.index'));
        }

        $seoConten = $this->seoContentRepository->update($request->all(), $id);

        Flash::success('Seo Content updated successfully.');

        return redirect()->back();

//        return redirect(route('seoContents.index'));
    }

    /**
     * Remove the specified SeoConten from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $seoConten = $this->seoContentRepository->find($id);

        if (empty($seoConten)) {
            Flash::error('Seo Content not found');

            return redirect(route('seoContents.index'));
        }

        $this->seoContentRepository->delete($id);

        Flash::success('Seo Content deleted successfully.');

        return redirect(route('seoContents.index'));
    }

    public function seoContentDetail(Request $request)
	{
		$entity_id = SeoContent::where('entity_id',$request->entity_id)->first();
    	if(isset($entity_id))
			return redirect(route('seoContents.edit', [$entity_id]));
		return view('admin.seo_contents.create')->with('entity_id',$request->entity_id);
	}

	public function seoContentProduct(Request $request)
	{
		$seoConten = SeoContent::where('entity_id',$request->entity_id)
			->where('entity_type',$request->entity_type)->first();
		if(isset($seoConten->entity_id))
			return view('admin.seo_contents.edit')
				->with('seoConten', $seoConten)
				->with('entity_type',$seoConten->entity_type)
				->with('entity_id',$seoConten->entity_id);

		return view('admin.seo_contents.create')
			->with('entity_id',$request->entity_id)
			->with('entity_type',$request->entity_type);
	}

	public function seoContentBrand(Request $request)
	{
		$seoConten = SeoContent::where('entity_id',$request->entity_id)
			->where('entity_type',$request->entity_type)->first();
		if(isset($seoConten->entity_id))
			return view('admin.seo_contents.edit')
				->with('seoConten', $seoConten)
				->with('entity_type',$seoConten->entity_type)
				->with('entity_id',$seoConten->entity_id);

		return view('admin.seo_contents.create')
			->with('entity_id',$request->entity_id)
			->with('entity_type',$request->entity_type);
	}
}
