<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLatestSearchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('latest_searches')) {
            Schema::create('latest_searches', function (Blueprint $table) {
                $table->id();
                $table->json('category_ids');
                $table->foreignId('user_id')
                 ->nullable()
                 ->constrained('users')
                 ->cascadeOnUpdate()
                 ->nullOnDelete();
                $table->json('skills');
                $table->string('level')->index();
                $table->string('availability')->index();
                $table->string('workplace')->index();
                $table->string('duration')->index();
                $table->string('available_in')->index();
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
        Schema::dropIfExists('latest_searches');
    }
}
