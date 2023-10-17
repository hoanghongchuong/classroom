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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->integer('schedule_id');
            $table->integer('student_id');
            $table->tinyInteger('status')->comment('1-Có mặt, 2-nghỉ có phép, 3- nghỉ không phép');
            $table->date('attendance_date')->nullable()->change();
            $table->text('note')->nullable();
            $table->unique(['student_id', 'schedule_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
