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
        Schema::create('real_estates', function (Blueprint $table) {
            $table->id();
            $table->string("broker");
            $table->string("type");
            $table->string("price");
            $table->string("beds");
            $table->string("paths");
            $table->text("address");
            $table->text("state");
            $table->text("locality");
            $table->text("sub_locality");
            $table->text("street_name");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('real_estates');
    }
};
