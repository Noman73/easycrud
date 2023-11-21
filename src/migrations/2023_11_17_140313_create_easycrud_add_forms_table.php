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
        Schema::create('easycrud_forms', function (Blueprint $table) {
            $table->id();
            $table->string('name',200);
            $table->string('label',200)->nullable();
            $table->string('model',200);
            $table->string('datatable',200)->nullable();
            $table->text('styles',1000)->nullable();
            $table->string('url',200)->nullable();
            $table->text('classes',1000)->nullable();
            $table->longText('before_code',100000)->nullable();
            $table->longText('after_code',100000)->nullable();
            $table->longText('validation',100000)->default("[]");
            $table->string('message',200);
            $table->string('column',200)->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('easycrud_forms');
    }
};
