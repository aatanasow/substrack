<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

#[Signature('subscriptions:generate-payments')]
#[Description('Generate subscription payment records')]
class GenerateSubscriptionPayments extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        info('Cron is running ....');

        $today = Carbon::today();

        Subscription::where('status', 'active')
            ->chunkById(100, function ($subscriptions) use ($today) {

                foreach ($subscriptions as $subscription) {
                    // info($subscription->getNextPaymentDate()->next_payment);
                    if (! $subscription->getNextPaymentDate()->next_payment->equalTo($today)) {
                        continue;
                    }

                    $subscription->payments()
                        ->firstOrCreate(
                            ['payment_date' => $today],
                            ['price' => $subscription->price, 'confirmed' => false]
                        );
                }

            });

        $this->info('Subscription payments generated.');
    }
}
