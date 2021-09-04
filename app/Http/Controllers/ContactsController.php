<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function create(Request $request)
    {
        return view('contacts.new');
    }

    public function store(Request $request)
    {
        $phone = array($request->phone1, $request->phone2, $request->phone3);
        $email = array($request->email1, $request->email2, $request->email3);
        $result = Contact::saveContact(
            $request->name,
            $request->last_name,
            $phone,
            $email
        );

        Contact::create([
            'ID' => $result['result'],
            'NAME' => $request->name,
            'LAST_NAME' => $request->last_name
        ]);

        return $result['result'];
    }
}
