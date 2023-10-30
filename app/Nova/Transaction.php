<?php

namespace App\Nova;

use App\Nova\Actions\ChangeStatus;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Http\Requests\NovaRequest;

class Transaction extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Transaction::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'reference';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'reference','recipient_number','recipient_name','provider_reference'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
//            ID::make(__('ID'), 'id')->sortable(),

            BelongsTo::make('User'),

            BelongsTo::make('Recipient')->hideFromIndex(),

            BelongsTo::make('Wallet')->hideFromIndex(),

            Badge::make('Status')->map([
                'pending' => 'warning',
                'processing' => 'info',
                'cancelled' => 'danger',
                'refunded' => 'info',
                'completed' => 'success',
            ]),

            Text::make('Reference')
                ->rules('required', 'unique:transactions,reference'),

            Text::make('Provider Reference', 'provider_reference')
                ->sortable()
                ->nullable()->hideFromIndex(),

            Text::make('Recipient Name', 'recipient_name')
                ->sortable(),

            Text::make('Recipient Number', 'recipient_number')
                ->sortable(),

            Text::make('Recipient Provider', 'recipient_provider')
                ->sortable()->hideFromIndex(),

            Text::make('Bank Code', 'bank_code')
                ->sortable()->hideFromIndex(),

            Select::make('Payment Method', 'payment_method')
                ->options([
                    'bank_transfer' => 'Bank Transfer',
                    'mobile_money' => 'Mobile Money',
                    'card' => 'Card',
                    'wallet' => 'Wallet',
                ])
                ->sortable()->hideFromIndex(),

            Currency::make('Amount Paid', 'amount')
                ->displayUsing(function ($value, $resource) {
                    $amountPaid = $resource->amount ?? 0;
                    $currencySign = $resource->from;
                    return $currencySign . number_format($amountPaid, 2);
                }),

            Currency::make('Amount To Send')
                ->displayUsing(function ($value, $resource) {
                    $rate = $resource->rate ?? 0;
                    $amountToSend = $resource->amount ?? 0;
                    $convertedAmount = $rate * $amountToSend;
                    $currencySign = $resource->to;
                    return $currencySign . number_format($convertedAmount, 2);
                })->hideFromIndex(),

            Number::make('Rate', 'rate')
                ->sortable()->hideFromIndex(),

            Currency::make('Fee', 'fee')
                ->hideFromIndex(),

            Text::make('From', 'from')
                ->sortable(),

            Text::make('To', 'to')
                ->sortable(),


            Select::make('Destination', 'destination')
                ->options([
                    'bank' => 'Bank',
                    'mobile_money' => 'Mobile Money',
                    'wallet' => 'Wallet',
                ])
                ->sortable()->hideFromIndex(),
            Text::make('Reason')->nullable(),
            Code::make('Metadata', 'metadata')->json()->hideFromIndex(),

            DateTime::make('Created At', 'created_at'),

            DateTime::make('Updated At', 'updated_at'),
        ];
    }

    public function actions(NovaRequest $request)
    {
        return [
            new ChangeStatus(),
        ];
    }
}
