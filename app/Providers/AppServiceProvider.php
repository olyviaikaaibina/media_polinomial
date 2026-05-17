<?php

namespace App\Providers;

use App\Helpers\ProgressSidebarHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $sidebarProgress = [
                'alwaysUnlockedSlugs' => [
                    'peta-konsep',
                    'apersepsi',
                ],

                'unlockedSlugs' => [
                    'peta-konsep',
                    'apersepsi',
                    'pengertianpolinomial',
                ],

                'completedSlugs' => [],
                'openedSlugs' => [],
                'passedQuizIds' => [],

                'canAccessQuizA' => false,
                'canAccessQuizB' => false,
                'canAccessQuizC' => false,
                'canAccessQuizD' => false,
                'canAccessQuizE' => false,
                'canAccessEvaluasi' => false,

                'canAccessQuizByBab' => [
                    1 => false,
                    2 => false,
                    3 => false,
                    4 => false,
                    5 => false,
                ],
            ];

            if (Auth::check()) {
                $studentId = Auth::id();

                $sidebarProgress = ProgressSidebarHelper::getSidebarProgress($studentId);
            }

            $view->with($sidebarProgress);
        });
    }
}
