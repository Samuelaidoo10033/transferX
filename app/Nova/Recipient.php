<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\DateTime;

class Recipient extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Recipient::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name',
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
            ID::make(__('ID'), 'id')->sortable(),

            BelongsTo::make('User'),

            Select::make('Type', 'type')
                ->options([
                    'bank' => 'Bank',
                    'mobile_money' => 'Mobile Money',
                ])
                ->sortable(),

            Text::make('Currency', 'currency')
                ->sortable(),

            Text::make('Country', 'country')
                ->sortable(),

            Text::make('Name', 'name')
                ->sortable(),

            Text::make('Number', 'number')
                ->sortable(),

            Text::make('Provider', 'provider')
                ->sortable(),

            Text::make('Bank Code', 'bank_code')
                ->sortable(),

            Text::make('Metadata', 'metadata'),

            DateTime::make('Created At', 'created_at'),

            DateTime::make('Updated At', 'updated_at'),
        ];
    }
}
