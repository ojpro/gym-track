<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->tinyInteger('code');
            $table->string('card_id')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birthday')->nullable();
            $table->enum('gender', ['male', 'female', 'indeterminate', 'unknown'])
                ->default('unknown');
            $table->float('weight')->nullable();
            $table->float('height')->nullable();
            $table->text('address')->nullable();
            $table->text('photo')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('username', 100)->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('members');
    }
};
