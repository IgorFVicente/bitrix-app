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
                $phoneReplaceChar = preg_replace("/[^0-9]/", "", $phone[$i]);
                array_push($queryData['fields']["PHONE"], array("VALUE" => $phoneReplaceChar));
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
            ->select(
                'companies.id as COMPANY_ID',
                'companies.TITLE as TITLE',
                'companies.REVENUE as REVENUE',
                'companies.PHONE as PHONE',
                'companies.EMAIL as EMAIL',
                'contacts.ID as ID',
                'contacts.NAME as NAME',
                'contacts.LAST_NAME as LAST_NAME'
            )
            ->leftJoin('contacts', 'companies.ID', '=', 'contacts.COMPANY_ID')
            ->orderByRaw('COMPANY_ID, NAME')
            ->get();
        return $companies;
    }

    public static function edit($id)
    {
        $company = DB::table('companies')
            ->select(
                'companies.id as COMPANY_ID',
                'companies.TITLE as TITLE',
                'companies.REVENUE as REVENUE',
                'companies.PHONE as PHONE',
                'companies.EMAIL as EMAIL',
                'contacts.ID as ID',
                'contacts.NAME as NAME',
                'contacts.LAST_NAME as LAST_NAME'
            )
            ->leftJoin('contacts', 'contacts.COMPANY_ID', '=', 'companies.ID')
            ->where('companies.ID', $id)
            ->orderBy('NAME')
            ->get();
        return $company;
    }

    public static function updateCompany($id, $title, $revenue, $phone, $email, $contacts)
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
            $phoneIds = array();
            $result = webhook('crm.company.get', array('id' => $id));
            if ($result['result']['HAS_PHONE'] != "N") {
                for ($i = 0; $i < count($result['result']['PHONE']); $i++) {
                    array_push($phoneIds, $result['result']['PHONE'][$i]["ID"]);
                }
            }
            for ($i = 0; $i < count($phone); $i++) {
                $phoneReplaceChar = preg_replace("/[^0-9]/", "", $phone[$i]);
                if ($i < count($phoneIds)) {
                    array_push($queryData['fields']["PHONE"], array("ID" => $phoneIds[$i], "VALUE" => $phoneReplaceChar));
                } else {
                    array_push($queryData['fields']["PHONE"], array("ID" => "", "VALUE" => $phoneReplaceChar));
                }
            }
        } else {
            $phoneIds = array();
            $result = webhook('crm.company.get', array('id' => $id));
            if ($result['result']['HAS_PHONE'] != "N") {
                for ($i = 0; $i < count($result['result']['PHONE']); $i++) {
                    array_push($phoneIds, $result['result']['PHONE'][$i]["ID"]);
                }
            }

            for ($i = 0; $i < count($phoneIds); $i++) {
                array_push($queryData['fields']["PHONE"], array("ID" => $phoneIds[$i], "VALUE" => ""));
            }
        }

        if ($email) {
            $emailIds = array();
            $result = webhook('crm.company.get', array('id' => $id));
            if ($result['result']['HAS_EMAIL'] != "N") {
                for ($i = 0; $i < count($result['result']['EMAIL']); $i++) {
                    array_push($emailIds, $result['result']['EMAIL'][$i]["ID"]);
                }
            }
            for ($i = 0; $i < count($email); $i++) {
                if ($i < count($emailIds)) {
                    array_push($queryData['fields']["EMAIL"], array("ID" => $emailIds[$i], "VALUE" => $email[$i]));
                } else {
                    array_push($queryData['fields']["EMAIL"], array("VALUE" => $email[$i]));
                }
            }
        } else {
            $emailIds = array();
            $result = webhook('crm.company.get', array('id' => $id));
            if ($result['result']['HAS_EMAIL'] != "N") {
                for ($i = 0; $i < count($result['result']['EMAIL']); $i++) {
                    array_push($emailIds, $result['result']['EMAIL'][$i]["ID"]);
                }
            }

            for ($i = 0; $i < count($emailIds); $i++) {
                array_push($queryData['fields']["EMAIL"], array("ID" => $emailIds[$i], "VALUE" => ""));
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
