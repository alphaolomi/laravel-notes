<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable()->index();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->nullableMorphs('notable');
            $table->string('title');
            $table->longText('content')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Add foreign key constraints
            $table->foreign('parent_id')->references('id')->on('notes')->onDelete('set null');
        });
    }
};
