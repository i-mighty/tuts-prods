<?php

namespace App\Providers;

use App\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Schema\Builder;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        //
	    Builder::defaultStringLength(191);
	    if(Auth::id()){
	    	$id = Auth::user()->getAuthIdentifier();
		    $user = User::where('id', $id)
		                         ->get();
	    	View::share('user', $user);
	    }
	    Relation::morphMap([
	    	'admin' => 'App\Admin',
		    'user' => 'App\User',
	    ]);
	    if(env('APP_ENV') == 'production' || env('APP_ENV') == 'stage'){
	    	URL::forceScheme('https');
	    }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
