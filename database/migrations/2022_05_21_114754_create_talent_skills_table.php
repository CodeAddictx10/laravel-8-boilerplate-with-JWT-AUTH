<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTalentSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('talent_skills')) {
            Schema::create('talent_skills', function (Blueprint $table) {
                $table->id();
                $table->foreignId('talent_id')
                          ->constrained('talents')
                          ->onUpdate('cascade')
                          ->onDelete('cascade');
                $table->foreignId('skill_id')
                          ->constrained('skills')
                          ->onUpdate('cascade')
                          ->onDelete('cascade');
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
        Schema::dropIfExists('talent_skills');
    }
}
