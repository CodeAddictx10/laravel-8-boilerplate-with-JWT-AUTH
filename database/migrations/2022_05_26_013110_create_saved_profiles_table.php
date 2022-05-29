<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSavedProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('saved_profiles')) {
            Schema::create('saved_profiles', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')
                 ->nullable()
                 ->constrained('users')
                 ->cascadeOnUpdate()
                 ->nullOnDelete();
                $table->foreignId('talent_id')
                 ->nullable()
                 ->constrained('talents')
                 ->cascadeOnUpdate()
                 ->nullOnDelete();
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
        Schema::dropIfExists('saved_profiles');
    }
}
