<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['ID', 'TITLE'];

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

    public function contacts()
    {
        return $this->belongsToMany(
            Contact::class,
            'contact_companies',
            'company_id',
            'contact_id'
        );
    }
}
