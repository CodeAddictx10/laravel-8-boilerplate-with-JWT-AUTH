<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTalentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('talents')) {
            Schema::create('talents', function (Blueprint $table) {
                $table->id();
                $table->string('first_name');
                $table->string('middle_name');
                $table->string('last_name');
                $table->string('email')->unique();
                $table->string('title');
                $table->foreignId('location_id')
                    ->constrained('countries')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
                $table->foreignId('category_id')
                    ->constrained('categories')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
                $table->text('summary');
                $table->json('experience');
                $table->json('education');
                $table->string('level')->index();
                $table->string('availability')->index();
                $table->boolean('status')->default(0)->index();
                $table->string('avatar')->default("https://ui-avatars.com/api/?name=S%20H&size=200");
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
        Schema::dropIfExists('talent');
    }
}
