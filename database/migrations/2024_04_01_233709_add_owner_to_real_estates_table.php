<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('real_estates', function (Blueprint $table) {
            $table->string("owner")->default("Mohamad Yadg")->after("id");
            $table->enum("reserved", ["yes", "no"])->default("no")->after("street_name");
            $table->enum("rented", ["yes", "no"])->default("no")->after("reserved");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('real_estates', function (Blueprint $table) {
            //
        });
    }
};
