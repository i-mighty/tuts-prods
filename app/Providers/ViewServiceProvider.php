<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {

	    view()->composer('*', function ($view)
	    {
	    	if(Auth::check()){
			    $view->with('authUser', Auth::user());
		    }elseif(Auth::guard('admin')){
			    $view->with('authUser', Auth::guard('admin')->user());
		    }
	    });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
