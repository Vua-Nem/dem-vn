<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateLandingContactFormRequest;
use App\Http\Requests\UpdateLandingContactFormRequest;
use App\Repositories\LandingContactFormRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class LandingContactFormController extends AppBaseController
{
    /** @var  LandingContactFormRepository */
    private $landingContactFormRepository;

    public function __construct(LandingContactFormRepository $landingContactFormRepo)
    {
        $this->landingContactFormRepository = $landingContactFormRepo;
    }

    /**
     * Display a listing of the LandingContactForm.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $landingContactForms = $this->landingContactFormRepository->all();

        return view('admin.landing_contact_forms.index')
            ->with('landingContactForms', $landingContactForms);
    }

    /**
     * Show the form for creating a new LandingContactForm.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.landing_contact_forms.create');
    }

    /**
     * Store a newly created LandingContactForm in storage.
     *
     * @param CreateLandingContactFormRequest $request
     *
     * @return Response
     */
    public function store(CreateLandingContactFormRequest $request)
    {
        $input = $request->all();

        $landingContactForm = $this->landingContactFormRepository->create($input);

        Flash::success('Landing Contact Form saved successfully.');

        return redirect(route('landingContactForms.index'));
    }

    /**
     * Display the specified LandingContactForm.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $landingContactForm = $this->landingContactFormRepository->find($id);

        if (empty($landingContactForm)) {
            Flash::error('Landing Contact Form not found');

            return redirect(route('landingContactForms.index'));
        }

        return view('admin.landing_contact_forms.show')->with('landingContactForm', $landingContactForm);
    }

    /**
     * Show the form for editing the specified LandingContactForm.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $landingContactForm = $this->landingContactFormRepository->find($id);

        if (empty($landingContactForm)) {
            Flash::error('Landing Contact Form not found');

            return redirect(route('landingContactForms.index'));
        }

        return view('admin.landing_contact_forms.edit')->with('landingContactForm', $landingContactForm);
    }

    /**
     * Update the specified LandingContactForm in storage.
     *
     * @param int $id
     * @param UpdateLandingContactFormRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLandingContactFormRequest $request)
    {
        $landingContactForm = $this->landingContactFormRepository->find($id);

        if (empty($landingContactForm)) {
            Flash::error('Landing Contact Form not found');

            return redirect(route('landingContactForms.index'));
        }

        $landingContactForm = $this->landingContactFormRepository->update($request->all(), $id);

        Flash::success('Landing Contact Form updated successfully.');

        return redirect(route('landingContactForms.index'));
    }

    /**
     * Remove the specified LandingContactForm from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $landingContactForm = $this->landingContactFormRepository->find($id);

        if (empty($landingContactForm)) {
            Flash::error('Landing Contact Form not found');

            return redirect(route('landingContactForms.index'));
        }

        $this->landingContactFormRepository->delete($id);

        Flash::success('Landing Contact Form deleted successfully.');

        return redirect(route('landingContactForms.index'));
    }
}
