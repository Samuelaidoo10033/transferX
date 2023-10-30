<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('recipient_id')->unsigned();
            $table->bigInteger('wallet_id')->unsigned()->nullable();
            $table->string('reference')->unique();
            $table->string('provider_reference')->nullable()->unique();
            $table->string('recipient_name')->index();
            $table->string('recipient_number')->index();
            $table->string('recipient_provider')->nullable();
            $table->string('bank_code')->nullable();
            $table->string('payment_method');// bank_transfer, mobile_money, card, wallet
            $table->decimal('amount',10, 4);
            $table->decimal('rate');
            $table->decimal('fee');
            $table->string('from'); // from currency (NGN, GHC)
            $table->string('to'); // to currency (NGN, GHC)
            $table->string('status')->index(); // pending, processing, cancelled, refunded, completed
            $table->string('destination'); // bank, mobile_money, wallet
            $table->json('metadata')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
