<?php

namespace App\Nova\Actions;

use App\Events\TransactionStatusChanged;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\UserAcceptedTransactionNotification;
use App\Notifications\UserDeclinedTransactinoNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Notification;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class ChangeStatus extends Action
{
    use InteractsWithQueue, Queueable;

    public function handle(ActionFields $fields, Collection $models)
    {
        /** @var Transaction $transaction */
        $transaction = $models->first();
        $transaction->status = $fields->status;
        $transaction->setMeta('reason', $fields->reason);
        $transaction->save();
        event(new TransactionStatusChanged($transaction));


        if ($transaction->status === 'completed') {
            $user = User::where('id', $transaction->user_id)->first();
            Notification::send($user, new UserAcceptedTransactionNotification($transaction));

        }

        if ( $transaction->status === 'cancelled') {
            $user = User::where('id', $transaction->user_id)->first();
            Notification::send($user, new UserDeclinedTransactinoNotification($transaction));
        }

    }

    /**
     * Get the fields available on the action.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Select::make('Status')->options([
                'completed' => 'Completed',
                'cancelled' => 'Cancelled',
            ])->displayUsingLabels(),
            Textarea::make('Reason','reason')->hideFromIndex(),

        ];
    }
}
