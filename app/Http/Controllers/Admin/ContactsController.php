<?php

namespace App\Http\Controllers\Admin;

use App\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactsController extends Controller
{
	public function index()
	{
		$alertTitle = 'Contacts';
		$contacts = Contact::orderBy('name', 'asc')->get();
		
		return view('admin.contacts.index', compact('contacts', 'alertTitle'));
	}

	public function create()
	{
		return view('admin.contacts.create');
	}

	public function store(Request $request)
	{
		// TODO: Validate request
		$contact = Contact::create($request->all());

		if ($request->has('properties')) {
			$contact->interestedIn($request->properties);
		}
	}

    public function update(Request $request, Contact $contact)
    {
    	// TODO: Validate request
    	$contact->update($request->all());
    }
}