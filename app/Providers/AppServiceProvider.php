<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\Topic;
use App\Observers\PostObserver;
use Carbon\Carbon;
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
        Carbon::setLocale('zh');
        //全視圖變數 $header_topics
        View::share('header_topics',Topic::get());

        //監視者
        Post::observe(PostObserver::class);
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
