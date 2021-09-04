<?php

namespace App\Models;

use Faker\Provider\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['ID', 'NAME', 'LAST_NAME'];

    public static function saveContact($name, $last_name, $phone, $email)
    {
        $queryData = array(
            'fields' => array(
                "NAME" => $name,
                "LAST_NAME" => $last_name,
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

        $result = webhook('crm.contact.add', $queryData);

        return $result;
    }

    public function companies()
    {
        return $this->belongsToMany(
            Company::class,
            'contact_companies',
            'contact_id',
            'company_id'
        );
    }
}
