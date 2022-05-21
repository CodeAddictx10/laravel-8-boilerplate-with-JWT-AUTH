<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('skills')) {
            Schema::create('skills', function (Blueprint $table) {
                $table->id();
                $table->foreignId('category_id')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
                $table->string('title')->index();
                $table->text('description')->index();
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
        Schema::dropIfExists('skills');
    }
}
