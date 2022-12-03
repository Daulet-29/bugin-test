<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            IRecruitingService::class,
            RecruitingService::class
        );
        $this->app->bind(
            HrServiceInterface::class,
            HrService::class
        );
        $this->app->bind(IRecruitingCandidateService::class, RecruitingCandidateService::class);
    }
}
