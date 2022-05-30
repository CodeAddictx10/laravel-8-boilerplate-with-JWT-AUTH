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
                $table->foreignId('user_id')
                 ->constrained('users')
                 ->cascadeOnUpdate()
                 ->cascadeOnDelete();
                $table->foreignId('talent_id')
                 ->nullable()
                 ->constrained('talents')
                 ->cascadeOnUpdate()
                 ->nullOnDelete();
                $table->date('date')->nullable()->index();
                $table->time('time')->nullable();
                $table->string('timezone')->nullable();
                $table->string('meeting_link')->nullable();
                $table->string('test_link')->nullable();
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
