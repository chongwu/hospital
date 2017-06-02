<?php

namespace App\Providers;

use App\Appointment;
use App\Doctor;
use App\DoctorType;
use App\Policies\AppointmentPolicy;
use App\Policies\DoctorPolicy;
use App\Policies\DoctorTypePolicy;
use App\Policies\VisitorPolicy;
use App\Visitor;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

    }
}
