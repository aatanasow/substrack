<?php

use App\Models\Subscription;
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
        Schema::create('subscriptions_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Subscription::class)->constrained()->cascadeOnDelete();
            $table->decimal('price', 19, 4);
            $table->timestamp('payment_date');
            $table->boolean('confirmed')->default(false);
            $table->timestamps();

            $table->unique(['subscription_id', 'payment_date']);
            // $table->index(['subscription_id', 'payment_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions_payments');
    }
};
