<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
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
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'User' => 'App\Models\User',
            'Vehicle' => 'App\Models\Vehicle',
            'Invoice' => 'App\Models\Invoice',
            'InvoicePayment' => 'App\Models\InvoicePayment',
            'Location' => 'App\Models\Location',
            'Customer' => 'App\Models\Customer',
        ]);
        Blade::directive(
            'money',
            function ($expression) {
                $arguments = explode(',', $expression);
                $amount = trim($arguments[0]);
                $currency = isset($arguments[1]) ? trim($arguments[1]) : '$';
                $formattedAmount = "<?php echo '{$currency}' . number_format({$amount} ?? 0, 2); ?>";
                return $formattedAmount;
            }
        );
        Paginator::defaultView('vendor.pagination.bootstrap-4');
    }
}
