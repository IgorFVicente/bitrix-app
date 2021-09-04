<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\DB;

class CompaniesController extends Controller
{
    public function create()
    {
        return view('companies.new');
    }

    public function store(Request $request)
    {
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
            'TITLE' => $request->title
        ]);

        return redirect()->route('index');
    }

    public function list()
    {
        $companies = DB::table('companies')->get();

        return view('companies.list', ['companies' => $companies]);
    }
}
