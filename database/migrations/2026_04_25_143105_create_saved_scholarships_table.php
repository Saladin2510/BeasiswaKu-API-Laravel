<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('saved_scholarships', function (Blueprint $table) {
            $table->id();
            $table->string('user_uid'); // UID dari Firebase
            $table->unsignedBigInteger('scholarship_id'); // ID Beasiswa dari MySQL
            $table->timestamps();

            // Hubungkan scholarship_id dengan tabel beasiswas
            $table->foreign('scholarship_id')->references('id')->on('beasiswas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saved_scholarships');
    }
};
