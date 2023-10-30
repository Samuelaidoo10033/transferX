<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class Rate extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Rate>
     */
    public static $model = \App\Models\Rate::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        $options = [
            'NGN' => 'NGN',
            'GHC' => 'GHC',
        ];
        return [
            ID::make()->sortable(),
            Select::make('From')->options(
                function ()
                {
                    return ['NGN' => 'NGN', 'GHC' => 'GHC'];
                }
            ),
            Select::make('TO')
                ->options(
                    function ()
                    {
                        return ['NGN' => 'NGN', 'GHC' => 'GHC'];
                    }
                )
                ->dependsOn(
                    ['from'],
                    function (Select $field, NovaRequest $request, FormData $formData) use ($options)
                    {
                        $field->options(collect($options)->filter(
                            function ($item) use ($formData)
                            {
                                return $item !== $formData->from;
                            })->toArray());
                    }
                )
            ,
            Number::make('Amount')->step(0.0001)->help('One unit of the first currency is how much of the second currency?'),
            Boolean::make('Active')->exceptOnForms()
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
