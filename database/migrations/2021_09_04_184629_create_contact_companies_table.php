<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_companies', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("contact_id");
            $table->foreign("contact_id")
                ->references("ID")
                ->on("contacts")
                ->onDelete("cascade");
            $table->bigInteger("company_id");
            $table->foreign("company_id")
                ->references("ID")
                ->on("companies")
                ->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact__companies');
    }
}
