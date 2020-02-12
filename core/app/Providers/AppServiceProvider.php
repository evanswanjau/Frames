<?php

namespace App\Providers;

use App\Advertisement;
use App\BasicSetting;
use App\Category;
use App\Menu;
use App\Partner;
use App\PaymentMethod;
use App\Social;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $basic = BasicSetting::first();
        Config::set('cart.tax',$basic->tax);

        $partner = Partner::get();
        $menu = Menu::get();
        $social = Social::get();
        $category = Category::get();
        $payment = PaymentMethod::get();
        $menubarCat = Category::whereStatus(1)->get();
        $footerCat = Category::take(8)->get();
        View::share('meta_status',1);
        View::share('site_title',$basic->title);
        View::share('basic',$basic);
        View::share('partners',$partner);
        View::share('menus',$menu);
        View::share('socials',$social);
        View::share('categories',$category);
        View::share('menubarCat',$menubarCat);
        View::share('footerCat',$footerCat);
        View::share('paymentImage',$payment);

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
