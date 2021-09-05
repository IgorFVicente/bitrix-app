<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['ID', 'TITLE', 'REVENUE', 'PHONE', 'EMAIL'];

    public static function saveCompany($title, $revenue, $phone, $email)
    {
        $queryData = array(
            'fields' => array(
                "TITLE" => $title,
                "REVENUE" => $revenue,
                "PHONE" => array(),
                "EMAIL" => array()
            ),
            'params' => array("REGISTER_SONET_EVENT" => "Y")
        );

        if ($phone) {
            for ($i = 0; $i < count($phone); $i++) {
                array_push($queryData['fields']["PHONE"], array("VALUE" => $phone[$i]));
            }
        }

        if ($email) {
            for ($i = 0; $i < count($email); $i++) {
                array_push($queryData['fields']["EMAIL"], array("VALUE" => $email[$i]));
            }
        }

        $result = webhook('crm.company.add', $queryData);

        return $result;
    }

    public static function addContact($company_id, $contact_id)
    {
        $queryData = array(
            'id' => $company_id,
            'fields' => array(
                "CONTACT_ID" => $contact_id
            )
        );

        $result = webhook('crm.company.contact.add', $queryData);

        return $result;
    }

    public static function list()
    {
        $companies = DB::table('companies')
            ->join('contacts', 'contacts.COMPANY_ID', '=', 'companies.ID')
            ->get();
        return $companies;
    }

    public static function edit($id)
    {
        $company = DB::table('companies')->where('ID', $id)->first();
        return $company;
    }

    public static function updateCompany($id, $title, $revenue, $phone, $email)
    {
        $queryData = array(
            'id' => $id,
            'fields' => array(
                "TITLE" => $title,
                "REVENUE" => $revenue,
                "PHONE" => array(),
                "EMAIL" => array()
            )
        );

        if ($phone) {
            for ($i = 0; $i < count($phone); $i++) {
                array_push($queryData['fields']["PHONE"], array("VALUE" => $phone[$i]));
            }
        }

        if ($email) {
            for ($i = 0; $i < count($email); $i++) {
                array_push($queryData['fields']["EMAIL"], array("VALUE" => $email[$i]));
            }
        }


        $result = webhook('crm.company.update', $queryData);

        Company::where('ID', $id)
            ->update([
                'TITLE' => $title,
                'REVENUE' => $revenue,
                'PHONE' => $phone ? serialize($phone) : null,
                'EMAIL' => $email ? serialize($email) : null
            ]);

        return $result;
    }

    public static function remove($id)
    {
        DB::table('companies')->where('ID', $id)->delete();

        $queryData = array(
            "id" => $id
        );

        $result = webhook('crm.company.delete', $queryData);

        return $result;
    }

    public function contacts()
    {
        return $this->hasMany(
            Contact::class
        );
    }
}
