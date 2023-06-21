<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borow_book', function (Blueprint $table) {
                $table->id();
                $table->integer('user_id');
                $table->integer('book_id');
                $table->date('date_borow');
                $table->date('date_return');
                $table->integer('status')->default(null)->nullable(); // null = borrowed, 1 = request borrow, 2 = lost 3 = lost and paid the fine
                $table->timestamps();
            });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('borow_book');
    }
};
