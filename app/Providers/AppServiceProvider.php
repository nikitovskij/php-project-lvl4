<?php

namespace App\Providers;

use Form;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Form::component('bsText', 'components.form.text', [
            'name',
            'value' => null,
            'attributes' => [],
            'additionalProperties' => [],
        ]);
        Form::component('bsSelect', 'components.form.select', [
            'params' => [],
            'list' => [],
            'value' => null,
            'attributes' => [],
        ]);
        Form::component('bsTextArea', 'components.form.textarea', [
            'name',
            'value' => null,
            'attributes' => [],
        ]);
    }
}
