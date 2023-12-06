<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
// use App\Providers\BraintreeGateway;
use Braintree\Gateway;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
    //  * @return void
     */
    public function boot()
    {
        $gateway = new Gateway([
            'environment' => 'sandbox',
            'merchantId' => 'y45kspkr479qbqqv',
            'publicKey' => 'q9djjd2vt8zvtbrd',
            'privateKey' => '4a7efb59e71e7a09cad2470ede9e8174'
        ]);
        $clientToken = $gateway->clientToken()->generate();
        return view('admin.apartments.show', compact('clientToken'));
    }
}
