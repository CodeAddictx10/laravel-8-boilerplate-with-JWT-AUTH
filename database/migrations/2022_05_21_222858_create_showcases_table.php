<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShowcasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('showcases')) {
            Schema::create('showcases', function (Blueprint $table) {
                $table->id();
                $table->foreignId('hire_id')
                 ->constrained('hires')
                 ->cascadeOnUpdate()
                 ->cascadeOnDelete();
                $table->foreignId('talent_id')
                 ->constrained('talent_skills')
                 ->cascadeOnUpdate()
                 ->cascadeOnDelete();
                $table->date('date')->nullable();
                $table->time('time')->nullable();
                $table->boolean('status')->default(0)->index();
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
        Schema::dropIfExists('showcases');
    }
}
