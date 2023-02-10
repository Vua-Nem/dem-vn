<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;
use App\Models\Contact;
use App\Models\SeoContent;
use App\Repositories\ContactRepository;
use App\Rules\CheckPhone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laracasts\Flash\Flash;

class ContactController extends AppBaseController
{
    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function index()
    {
        $contacts = Contact::paginate(15);
        return view('admin.contacts.index')->with('contacts', $contacts);
    }


    /**
     * Show the form for creating a new Contact.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.contacts.create');
    }

    /**
     * Store a newly created Contact in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'phone' => ['required', new CheckPhone()],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $this->contactRepository->create($input);
        Flash::success('Contact saved successfully.');

        return redirect(route('contacts.index'));
    }

    /**
     * Display the specified Contact.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $contact = $this->contactRepository->find($id);

        if (empty($contact)) {
            Flash::error('Contact not found');

            return redirect(route('contacts.index'));
        }

        return view('admin.contacts.show')->with('contact', $contact);
    }

    /**
     * Show the form for editing the specified Contact.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $contact = $this->contactRepository->find($id);
        if (empty($contact)) {
            Flash::error('Contact not found');

            return redirect(route('contacts.index'));
        }

        return view('admin.contacts.edit')
            ->with('contact', $contact);
    }

    /**
     * Update the specified Contact in storage.
     *
     * @param int $id
     * @param CreateContactRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $contact = $this->contactRepository->find($id);

        if (empty($contact)) {
            Flash::error('Contact not found');

            return redirect(route('contacts.index'));
        }

        $validator = Validator::make($request->all(), [
            'phone' => ['required', new CheckPhone()],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $this->contactRepository->update($request->all(), $id);

        Flash::success('Contact updated successfully.');

        return redirect(route('contacts.index'));
    }

    /**
     * Remove the specified Contact from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $contact = $this->contactRepository->find($id);

        if (empty($contact)) {
            Flash::error('Contact not found');

            return redirect(route('contacts.index'));
        }

        $this->contactRepository->delete($id);

        Flash::success('Contact deleted successfully.');

        return redirect(route('contacts.index'));
    }
}
