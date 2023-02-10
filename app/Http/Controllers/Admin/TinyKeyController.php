<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreatetinyKeyRequest;
use App\Http\Requests\UpdatetinyKeyRequest;
use App\Repositories\TinyKeyRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class tinyKeyController extends AppBaseController
{
    /** @var  TinyKeyRepository */
    private $tinyKeyRepository;

    public function __construct(TinyKeyRepository $tinyKeyRepo)
    {
        $this->tinyKeyRepository = $tinyKeyRepo;
    }

    /**
     * Display a listing of the tinyKey.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $tinyKeys = $this->tinyKeyRepository->all();

        return view('admin.tiny_keys.index')
            ->with('tinyKeys', $tinyKeys);
    }

    /**
     * Show the form for creating a new tinyKey.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.tiny_keys.create');
    }

    /**
     * Store a newly created tinyKey in storage.
     *
     * @param CreatetinyKeyRequest $request
     *
     * @return Response
     */
    public function store(CreatetinyKeyRequest $request)
    {
        $input = $request->all();

        $tinyKey = $this->tinyKeyRepository->create($input);

        Flash::success('Tiny Key saved successfully.');

        return redirect(route('tinyKeys.index'));
    }

    /**
     * Display the specified tinyKey.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tinyKey = $this->tinyKeyRepository->find($id);

        if (empty($tinyKey)) {
            Flash::error('Tiny Key not found');

            return redirect(route('tinyKeys.index'));
        }

        return view('admin.tiny_keys.show')->with('tinyKey', $tinyKey);
    }

    /**
     * Show the form for editing the specified tinyKey.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tinyKey = $this->tinyKeyRepository->find($id);

        if (empty($tinyKey)) {
            Flash::error('Tiny Key not found');

            return redirect(route('tinyKeys.index'));
        }

        return view('admin.tiny_keys.edit')->with('tinyKey', $tinyKey);
    }

    /**
     * Update the specified tinyKey in storage.
     *
     * @param int $id
     * @param UpdatetinyKeyRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatetinyKeyRequest $request)
    {
        $tinyKey = $this->tinyKeyRepository->find($id);

        if (empty($tinyKey)) {
            Flash::error('Tiny Key not found');

            return redirect(route('tinyKeys.index'));
        }

        $tinyKey = $this->tinyKeyRepository->update($request->all(), $id);

        Flash::success('Tiny Key updated successfully.');

        return redirect(route('tinyKeys.index'));
    }

    /**
     * Remove the specified tinyKey from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tinyKey = $this->tinyKeyRepository->find($id);

        if (empty($tinyKey)) {
            Flash::error('Tiny Key not found');

            return redirect(route('tinyKeys.index'));
        }

        $this->tinyKeyRepository->delete($id);

        Flash::success('Tiny Key deleted successfully.');

        return redirect(route('tinyKeys.index'));
    }
}
