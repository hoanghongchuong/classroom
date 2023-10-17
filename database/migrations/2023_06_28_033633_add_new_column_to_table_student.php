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
        Schema::table('students', function (Blueprint $table) {
            $table->integer('class_id')->nullable()->change();
            $table->string('phone')->nullable()->after('parent_name');
            $table->string('address')->nullable()->after('parent_name');
            $table->tinyInteger('gender')->nullable()->after('parent_name')->comment('1-male, 2-female');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            //
        });
    }
};
