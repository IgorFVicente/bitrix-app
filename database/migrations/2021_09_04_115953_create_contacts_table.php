<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->unsignedBigInteger("ID")->unique();
            $table->primary("ID");
            $table->string("NAME");
            $table->string("LAST_NAME")->nullable();
            $table->timestamps();
            $table->unsignedBigInteger("COMPANY_ID");
            $table->foreign("COMPANY_ID")
                ->references("ID")
                ->on("companies")
                ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
