<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->enum('userRole', ['admin', 'user']);
            $table->string('password');
            $table->timestamps();
        });

        // Insert default data after the table has been created
        DB::table('users')->insert([
        [
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'userRole' => 'admin',
            'password' => '$2y$12$8qGbpTMe/NFXUMNZbMB5Gu0SFlp/hOcbGb6yyhSdn6MxedBmK7Eta', // hashed password admin'
            'created_at' => now(),
            'updated_at' => now(),
        ],
    ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
