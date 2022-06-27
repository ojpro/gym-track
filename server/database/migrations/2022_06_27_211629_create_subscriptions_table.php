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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['current', 'pending', 'canceled', 'expired'])
                ->default('current');
            $table->foreignId('member_id')->constrained();
            $table->foreignId('membership_id')->constrained();
            $table->tinyInteger('number')->default(1);
            $table->dateTime('started_at');
            $table->dateTime('expire_at');
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
        Schema::dropIfExists('subscriptions');
    }
};
