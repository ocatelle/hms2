<?php

namespace App\Providers;

use Carbon\Carbon;
use HMS\Auth\PasswordStore;
use HMS\Auth\HmsUserProvider;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Auth;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(EntityManagerInterface $em, PasswordStore $passwordStore)
    {
        $this->registerPolicies();

        Auth::provider('hms', function ($app, array $config) use ($em, $passwordStore) {
            return new HmsUserProvider($app['hash'], $em, $config['model'], $passwordStore);
        });

        // Passport bits.
        Passport::routes();
        Passport::tokensExpireIn(Carbon::now()->addDays(config('hms.passport_token_expire_days')));
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(config('hms.passport_refresh_token_expire_days')));
    }
}
