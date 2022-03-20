<?php

namespace App\Providers;

use App\Repository\Interfaces\FeeInvoicesRepositoryInterface;
use App\Repository\Interfaces\FeesRepositoryInterface;
use App\Repository\Interfaces\ProcessingFeeRepositoryInterface;
use App\Repository\Interfaces\ReceiptStudentsRepositoryInterface;
use App\Repository\Interfaces\StudentGraduatedRepositoryInterface;
use App\Repository\Interfaces\StudentPromotionRepositoryInterface;
use App\Repository\Interfaces\StudentRepositoryInterface;
use App\Repository\Interfaces\TeacherRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{


    public function register()
    {

        $this->app->bind(
            TeacherRepositoryInterface::class,
            'App\Repository\Classes\TeacherRepository');

        $this->app->bind(
            StudentRepositoryInterface::class,
            'App\Repository\Classes\StudentRepository');

        $this->app->bind(
            StudentPromotionRepositoryInterface::class,
            'App\Repository\Classes\StudentPromotionRepository');

        $this->app->bind(
            StudentGraduatedRepositoryInterface::class,
            'App\Repository\Classes\StudentGraduatedRepository');

        $this->app->bind(
            FeesRepositoryInterface::class,
            'App\Repository\Classes\FeesRepository');

        $this->app->bind(
            FeeInvoicesRepositoryInterface::class,
            'App\Repository\Classes\FeeInvoicesRepository');

        $this->app->bind(
            ReceiptStudentsRepositoryInterface::class,
            'App\Repository\Classes\ReceiptStudentsRepository');

        $this->app->bind(
            ProcessingFeeRepositoryInterface::class,
            'App\Repository\Classes\ProcessingFeeRepository');

    }



    public function boot()
    {
        //
    }
}
