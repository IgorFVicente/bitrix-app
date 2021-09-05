<?php

namespace App\Models;

use Faker\Provider\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['ID', 'NAME', 'LAST_NAME', 'COMPANY_ID'];

    public static function saveContact($name, $last_name)
    {
        $queryData = array(
            'fields' => array(
                "NAME" => $name,
                "LAST_NAME" => $last_name
            ),
            'params' => array("REGISTER_SONET_EVENT" => "Y")
        );

        $result = webhook('crm.contact.add', $queryData);

        return $result;
    }

    public static function updateContact($id, $name, $last_name)
    {
        $queryData = array(
            'id' => $id,
            'fields' => array(
                "NAME" => $name,
                "LAST_NAME" => $last_name
            )
        );

        $result = webhook('crm.contact.update', $queryData);

        Contact::where('ID', $id)
            ->update([
                'NAME' => $name,
                'LAST_NAME' => $last_name
            ]);

        return $result;
    }

    public static function remove($id)
    {

        $contacts_id = DB::table('contacts')
            ->select('ID')
            ->where('COMPANY_ID', $id)
            ->get();

        foreach ($contacts_id as $contact_id) {
            $queryData = array(
                "id" => $contact_id->ID
            );

            webhook('crm.contact.delete', $queryData);
        }

        DB::table('contacts')->where('COMPANY_ID', $id)->delete();
    }

    public function companies()
    {
        return $this->belongsTo(
            Company::class
        );
    }
}
