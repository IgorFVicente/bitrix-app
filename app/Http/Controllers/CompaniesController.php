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
        //Transformar o phone e o email em arrays dinâmicas
        $phone = array($request->phone1, $request->phone2, $request->phone3);
        $email = array($request->email1, $request->email2, $request->email3);
        $company_result = Company::saveCompany(
            $request->title,
            $request->revenue,
            $phone,
            $email
        );

        Company::create([
            'ID' => $company_result['result'],
            'TITLE' => $request->title,
            'REVENUE' => $request->revenue,
            'PHONE' => $phone ? serialize($phone) : null,
            'EMAIL' => $email ? serialize($email) : null
        ]);

        if ($request->contact_name1) {
            $contact_result = Contact::saveContact(
                $request->contact_name1,
                $request->contact_lastname1
            );

            Contact::create([
                'ID' => $contact_result['result'],
                'NAME' => $request->contact_name1,
                'LAST_NAME' => $request->contact_lastname1,
                'COMPANY_ID' => $company_result['result']
            ]);

            Company::addContact(
                $company_result['result'],
                $contact_result['result']
            );
        }

        if ($request->contact_name2) {
            $contact_result = Contact::saveContact(
                $request->contact_name2,
                $request->contact_lastname2
            );

            Contact::create([
                'ID' => $contact_result['result'],
                'NAME' => $request->contact_name2,
                'LAST_NAME' => $request->contact_lastname2,
                'COMPANY_ID' => $company_result['result']
            ]);

            Company::addContact(
                $company_result['result'],
                $contact_result['result']
            );
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
        $phone = array($request->phone1, $request->phone2, $request->phone3);
        $email = array($request->email1, $request->email2, $request->email3);
        Company::updateCompany(
            $request->ID,
            $request->title,
            $request->revenue,
            $phone,
            $email
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
