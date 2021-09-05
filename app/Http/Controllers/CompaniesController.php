<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;

class CompaniesController extends Controller
{
    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $company_result = Company::saveCompany(
            $request->title,
            $request->revenue,
            $request->phone,
            $request->email
        );


        $phoneArray = array();
        $emailArray = array();

        foreach ($request->phone as $phone) {
            if ($phone != '') {
                array_push($phoneArray, $phone);
            }
        }

        foreach ($request->email as $email) {
            if ($email != '') {
                array_push($emailArray, $email);
            }
        }

        Company::create([
            'ID' => $company_result['result'],
            'TITLE' => $request->title,
            'REVENUE' => $request->revenue,
            'PHONE' => $phoneArray ? serialize($phoneArray) : null,
            'EMAIL' => $emailArray ? serialize($emailArray) : null
        ]);

        if ($request->contact_name[0] != null) {
            for ($i = 0; $i < count($request->contact_name); $i++) {
                $contact_result = Contact::saveContact(
                    $request->contact_name[$i],
                    $request->contact_lastname[$i]
                );

                Contact::create([
                    'ID' => $contact_result['result'],
                    'NAME' => $request->contact_name[$i],
                    'LAST_NAME' => $request->contact_lastname[$i],
                    'COMPANY_ID' => $company_result['result']
                ]);

                Company::addContact(
                    $company_result['result'],
                    $contact_result['result']
                );
            }
        }

        return redirect()->route('index');
    }

    public function list()
    {
        $companies = Company::list();

        return view('companies.list', ['companies' => $companies]);
    }

    public function edit($id)
    {
        $company = Company::edit($id);

        return view('companies.edit', ['company' => $company]);
    }

    public function update(Request $request)
    {
        $phoneArray = array();
        $emailArray = array();
        $contactArray = array();

        foreach ($request->phone as $phone) {
            if ($phone != '') {
                array_push($phoneArray, $phone);
            }
        }

        foreach ($request->email as $email) {
            if ($email != '') {
                array_push($emailArray, $email);
            }
        }

        for ($i = 0; $i < count($request->contact_name); $i++) {
            if ($request->contact_id[$i] == 0 and $request->contact_name != '') {
                $contact_result = Contact::saveContact(
                    $request->contact_name[$i],
                    $request->contact_lastname[$i]
                );

                Contact::create([
                    'ID' => $contact_result['result'],
                    'NAME' => $request->contact_name[$i],
                    'LAST_NAME' => $request->contact_lastname[$i],
                    'COMPANY_ID' => $request->ID
                ]);

                Company::addContact(
                    $request->ID,
                    $contact_result['result']
                );
            } else if ($request->contact_name != '') {
                Contact::updateContact(
                    $request->contact_id[$i],
                    $request->contact_name[$i],
                    $request->contact_lastname[$i]
                );
            }
        }

        Company::updateCompany(
            $request->ID,
            $request->title,
            $request->revenue,
            $phoneArray,
            $emailArray,
            $contactArray
        );


        return redirect()->route('index');
    }

    public function remove($id)
    {
        Company::remove($id);
        return redirect()->route('index');
    }

    public function vue()
    {
        return view('vue-teste');
    }
}
