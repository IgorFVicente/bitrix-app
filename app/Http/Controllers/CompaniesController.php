<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
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
        $result = Company::saveCompany(
            $request->title,
            $request->revenue,
            $phone,
            $email
        );

        Company::create([
            'ID' => $result['result'],
            'TITLE' => $request->title,
            'REVENUE' => $request->revenue,
            'PHONE' => $phone ? serialize($phone) : null,
            'EMAIL' => $email ? serialize($email) : null
        ]);

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

        Company::where('ID', $request->ID)
            ->update([
                'TITLE' => $request->title,
                'REVENUE' => $request->revenue,
                'PHONE' => $phone ? serialize($phone) : null,
                'EMAIL' => $email ? serialize($email) : null
            ]);

        return redirect()->route('index');
    }

    public function remove($id)
    {
        Company::remove($id);
        return redirect()->route('index');
    }
}
