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
        Schema::create('share_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('share_id');
            $table->unsignedBigInteger('user_id');
            $table->text('content');
            $table->integer('created_by')->default(0);
            $table->integer('modified_by')->nullable()->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('share_id')->references('id')->on('shares')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('share_comments');
    }
};
