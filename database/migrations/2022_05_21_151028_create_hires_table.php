<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHiresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('hires')) {
            Schema::create('hires', function (Blueprint $table) {
                $table->id();
                $table->foreignId('category_id')
                 ->constrained('categories')
                 ->cascadeOnUpdate()
                 ->cascadeOnDelete();
                $table->foreignId('user_id')
                 ->nullable()
                 ->constrained('users')
                 ->cascadeOnUpdate()
                 ->nullOnDelete();
                $table->json('skills');
                $table->string('level')->index();
                $table->string('availability')->index();
                $table->string('workplace')->index();
                $table->string('available_in')->index();
                $table->boolean('status')->default(0)->index();
                $table->string('meeting_link')->nullable();
                $table->string('test_link')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hires');
    }
}
