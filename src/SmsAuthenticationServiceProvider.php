<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/6/6 0006
 * Time: 上午 10:22
 */

namespace Jzyuchen\SmsAuthentication;


use Illuminate\Support\ServiceProvider;

class SmsAuthenticationServiceProvider extends ServiceProvider {

    public function boot()
    {
        $config     = realpath(__DIR__.'/../config/config.php');

        $this->publishes([
            $config     => config_path('sms-auth.php'),
        ]);

        $mFrom = __DIR__ . '/../migrations/';
        $mTo = $this->app['path.database'] . '/migrations/';
        $this->publishes([
            $mFrom . '2015_06_06_000001_create_sms_table.php' => $mTo . '2015_06_06_000001_create_sms_table.php',
        ]);
    }
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind("sms-auth", function() {
            return new SmsAuth();
        });
    }
}