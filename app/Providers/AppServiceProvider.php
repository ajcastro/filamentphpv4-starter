<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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
        \Filament\Actions\Action::configureUsing(
            function (\Filament\Actions\Action $action) {
                $action->label(
                    fn($action) => Str::of($action->getName())->snake()->replace('_', ' ')->title()
                );
            }
        );


        \Filament\Forms\Components\Field::configureUsing(
            function (\Filament\Forms\Components\Field $component) {
                $component->label(
                    fn($component) => Str::title(str_replace('_', ' ', $component->getName()))
                );
                $component->validationAttribute(
                    fn($component) => Str::lower($component->getLabel())
                );
            }
        );

        \Filament\Tables\Table::configureUsing(
            function (\Filament\Tables\Table $table) {
                // TODO: Can override these format settings per user preference later
                // using \Illuminate\Support\Facades\Auth::user()
                $table->defaultDateDisplayFormat(config('app.date_format'));
                $table->defaultDateTimeDisplayFormat(config('app.datetime_format'));
                $table->defaultTimeDisplayFormat(config('app.time_format'));
            }
        );

        \Filament\Tables\Columns\Column::configureUsing(
            function (\Filament\Tables\Columns\Column $column) {
                $column->label(
                    fn($column) => Str::title(str_replace('_', ' ', $column->getName()))
                );

                if (method_exists($column, 'validationAttribute')) {
                    $column->validationAttribute(
                        fn($column) => Str::lower($column->getLabel())
                    );
                }
            }
        );


        \Filament\Actions\Imports\ImportColumn::configureUsing(
            function (\Filament\Actions\Imports\ImportColumn $component) {
                $component->label(
                    fn($component) => Str::title(str_replace('_', ' ', $component->getName()))
                );
                $component->validationAttribute(
                    fn($component) => Str::lower($component->getLabel())
                );
            }
        );
    }
}
