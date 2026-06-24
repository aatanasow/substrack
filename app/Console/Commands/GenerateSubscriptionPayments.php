<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use App\Notifications\SubscriptionPaymentDue;
use App\Notifications\SubscriptionPaymentReminder;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

#[Signature('subscriptions:payment-notifications')]
#[Description('Generate subscription payment notifications')]
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
                    // info($subscription->getNextPaymentDate());

                    /*
                    * Payment today
                    */

                    if ($subscription->getNextPaymentDate()->isSameDay($today)) {

                        if (! $subscription->user
                            ->notifications()
                            ->where('data->subscription_id', $subscription->id)
                            ->where('type', SubscriptionPaymentDue::class)
                            ->whereToday('created_at')
                            ->exists()
                        ) {
                            $subscription->user->notify(
                                new SubscriptionPaymentDue($subscription)
                            );
                        }

                        $subscription->payments()->firstOrCreate(
                            ['payment_date' => $today],
                            ['price' => $subscription->price, 'confirmed' => false]
                        );

                    }

                    /*
                     * Reminder before payment
                     */
                    if ($subscription->notify == 0) {
                        continue;
                    }

                    $reminderDate = $subscription->getNextPaymentDate()
                        ->copy()
                        ->subDays($subscription->notify);

                    // info($subscription->title . " - " . $reminderDate);
                    if ($reminderDate->isSameDay($today)) {

                        if (! $subscription->user
                            ->notifications()
                            ->where('data->subscription_id', $subscription->id)
                            ->where('type', SubscriptionPaymentReminder::class)
                            ->whereToday('created_at')
                            ->exists()
                        ) {
                            $subscription->user->notify(
                                new SubscriptionPaymentReminder($subscription)
                            );
                        }

                    }
                }

            });

        info('Subscription payments generated.');
    }
}
