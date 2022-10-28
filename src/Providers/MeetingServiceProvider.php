<?php

namespace Nrz\Meeting\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Route;
use JoisarJignesh\Bigbluebutton\BigbluebuttonServiceProvider;
use JoisarJignesh\Bigbluebutton\Facades\Bigbluebutton;

class MeetingServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__."/../Database/Migrations");
//         Route::middleware('api')
//             ->prefix("api")
//             ->group(__DIR__ . '/../Routes/meeting_routes.php');
        $this->app->register(BigbluebuttonServiceProvider::class);
        $loader = AliasLoader::getInstance();
        $loader->alias("Bigbluebutton" , \JoisarJignesh\Bigbluebutton\Facades\Bigbluebutton::class);
    }
}
