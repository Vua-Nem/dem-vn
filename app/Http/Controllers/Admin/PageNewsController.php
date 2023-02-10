<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreatePage_NewsRequest;
use App\Http\Requests\UpdatePage_NewsRequest;
use App\Repositories\Page_NewsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Services\FileUploadService;
use Flash;
use Response;

class PageNewsController extends AppBaseController
{
    /** @var  Page_NewsRepository */
    private $pageNewsRepository;

    public function __construct(Page_NewsRepository $pageNewsRepo)
    {
        $this->pageNewsRepository = $pageNewsRepo;
    }

    /**
     * Display a listing of the Page_News.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $pageNews = $this->pageNewsRepository->all();

        return view('admin.page_news.index')
            ->with('pageNews', $pageNews);
    }

    /**
     * Show the form for creating a new Page_News.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.page_news.create');
    }

    /**
     * Store a newly created Page_News in storage.
     *
     * @param CreatePage_NewsRequest $request
     *
     * @return Response
     */
    public function store(CreatePage_NewsRequest $request)
    {
        $input = $request->all();
        $blog = $this->pageNewsRepository->create($input);

        $fileUpload = new FileUploadService();
        $fileUploadResult = $fileUpload->upLoadImages($input['default_img'], "public/page_news/" . $blog->id . "/", [
            "size" => [
                "255" => [
                    "width" => 255,
                    "height" => 156,
                ],
                "540" => [
                    "width" => 540,
                    "height" => 512,
                ]
            ]
        ]);

        if ($fileUploadResult["status"]) {
            $name = last(explode("/", $fileUploadResult["path"]));
            $blog->name = $name;
            $blog->path = $fileUploadResult["path"];
            $blog->save();

            Flash::success('Page  News saved successfully.');
        } else {
            Flash::error($fileUploadResult["message"]);
        }

        return redirect(route('pageNews.index'));
    }

    /**
     * Display the specified Page_News.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pageNews = $this->pageNewsRepository->find($id);

        if (empty($pageNews)) {
            Flash::error('Page  News not found');

            return redirect(route('pageNews.index'));
        }

        return view('admin.page_news.show')->with('pageNews', $pageNews);
    }

    /**
     * Show the form for editing the specified Page_News.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pageNews = $this->pageNewsRepository->find($id);

        if (empty($pageNews)) {
            Flash::error('Page  News not found');

            return redirect(route('pageNews.index'));
        }

        return view('admin.page_news.edit')->with('pageNews', $pageNews);
    }

    /**
     * Update the specified Page_News in storage.
     *
     * @param int $id
     * @param UpdatePage_NewsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePage_NewsRequest $request)
    {
        $pageNews = $this->pageNewsRepository->find($id);
        if (empty($pageNews)) {
            Flash::error('Page  News not found');
            return redirect(route('pageNews.index'));
        }

        $data = $request->all();
        $pageNews = $this->pageNewsRepository->update($data, $id);

        $fileUpload = new FileUploadService();
        if (isset($data["default_img"]) && !empty($data["default_img"])) {
            $image = $data['default_img'];
            $path = $fileUpload->upLoadImages($image, "public/page_news/" . $pageNews->id . "/", [
                "size" => [
                    "255" => [
                        "width" => 255,
                        "height" => 156,
                    ],
                    "540" => [
                        "width" => 540,
                        "height" => 512,
                    ]
                ]
            ]);

            $name = last(explode("/", $path));
            $pageNews->name = $name;
            $pageNews->path = $path;
            $pageNews->save();
        }

        Flash::success('Page  News updated successfully.');

        return redirect(route('pageNews.index'));
    }

    /**
     * Remove the specified Page_News from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pageNews = $this->pageNewsRepository->find($id);
        if (empty($pageNews)) {
            Flash::error('Page  News not found');

            return redirect(route('pageNews.index'));
        }
        $pageNews->delete();
        Flash::success('Page  News deleted successfully.');

        return redirect(route('pageNews.index'));
    }
}
