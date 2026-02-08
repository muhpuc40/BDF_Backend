<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('directories', function (Blueprint $table) {
            $table->id();
            $table->string('club_name');
            $table->string('university');
            $table->string('president');
            $table->string('general_secretary');
            $table->string('contact');
            $table->string('email');
            $table->string('location');
            $table->string('established');
            $table->string('members');
            $table->enum('status', ['Active', 'Inactive', 'Suspended'])->default('Active');
            $table->string('facebook_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('directories');
    }
};