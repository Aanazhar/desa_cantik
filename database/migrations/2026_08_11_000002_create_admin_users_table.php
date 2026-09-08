<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin_users', function (Blueprint $table) {

            $table->id();

            $table->string('name');

            $table->string('email')
                ->unique();

            $table->string('password');

            $table->timestamps();

        });


        DB::table('admin_users')->insert([

            'name' => 'Admin Desa',

            'email' => 'admin@desacantik.id',

            'password' => Hash::make('admin123'),

            'created_at' => now(),

            'updated_at' => now(),

        ]);
    }


    public function down(): void
    {
        Schema::dropIfExists(
            'admin_users'
        );
    }
};