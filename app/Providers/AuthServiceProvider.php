<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        'App\Category' => 'App\Policies\CategoryPolicy',
        'App\User' => 'App\Policies\UserPolicy',
        'Spatie\Permission\Models\Role' => 'App\Policies\RolePolicy',
        'Spatie\Permission\Models\Permission' => 'App\Policies\PermissionPolicy',
        'App\Cliente' => 'App\Policies\ClientePolicy',
        'App\Internet' => 'App\Policies\InternetPolicy',
        'App\DaysPeriod' => 'App\Policies\DaysPeriodPolicy',
        'App\Printer' => 'App\Policies\PrinterPolicy',
        'App\Television' => 'App\Policies\TelevisionPolicy',
        'App\Producto' => 'App\Policies\ProductoPolicy',
        'App\Recarga' => 'App\Policies\RecargaPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
