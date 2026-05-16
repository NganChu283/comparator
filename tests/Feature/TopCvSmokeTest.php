<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TopCvSmokeTest extends TestCase
{
    use RefreshDatabase;

    public function test_core_public_and_role_pages_render(): void
    {
        $this->seed();

        $this->get('/')->assertOk();
        $this->get('/jobs')->assertOk();
        $this->get('/companies')->assertOk();

        $this->actingAs(User::where('email', 'candidate@topcv.test')->first());
        $this->get('/candidate/dashboard')->assertOk();
        $this->get('/candidate/cvs')->assertOk();
        $this->get('/candidate/applications')->assertOk();

        $this->actingAs(User::where('email', 'employer@topcv.test')->first());
        $this->get('/employer/dashboard')->assertOk();
        $this->get('/employer/company')->assertOk();
        $this->get('/employer/jobs')->assertOk();

        $this->actingAs(User::where('email', 'admin@topcv.test')->first());
        $this->get('/admin/dashboard')->assertOk();
        $this->get('/admin/users')->assertOk();
        $this->get('/admin/jobs')->assertOk();
        $this->get('/admin/categories')->assertOk();
    }
}
