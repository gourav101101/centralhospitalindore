<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AppointmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_appointment_form_only_shows_active_departments_and_doctors(): void
    {
        Department::create(['name' => 'Cardiology', 'is_active' => true]);
        Department::create(['name' => 'Hidden department', 'is_active' => false]);
        Doctor::create([
            'name' => 'Dr. Asha Rao',
            'designation' => 'Consultant',
            'department' => 'Cardiology',
            'is_active' => true,
        ]);
        Doctor::create([
            'name' => 'Dr. Hidden',
            'designation' => 'Consultant',
            'department' => 'Cardiology',
            'is_active' => false,
        ]);

        $this->get(route('appointment'))
            ->assertOk()
            ->assertSee('Cardiology')
            ->assertSee('Dr. Asha Rao')
            ->assertDontSee('Hidden department')
            ->assertDontSee('Dr. Hidden');
    }

    public function test_an_appointment_requires_an_available_doctor_from_the_selected_department(): void
    {
        Department::create(['name' => 'Cardiology', 'is_active' => true]);
        Department::create(['name' => 'Neurology', 'is_active' => true]);
        Doctor::create([
            'name' => 'Dr. Asha Rao',
            'designation' => 'Consultant',
            'department' => 'Cardiology',
            'is_active' => true,
        ]);

        $payload = [
            'patient_name' => 'Test Patient',
            'phone' => '9876543210',
            'department' => 'Neurology',
            'preferred_doctor' => 'Dr. Asha Rao',
            'preferred_date' => today()->addDay()->toDateString(),
            'time_slot' => 'morning-1',
        ];

        $this->from(route('appointment'))
            ->post(route('appointment.store'), $payload)
            ->assertRedirect(route('appointment'))
            ->assertSessionHasErrors('preferred_doctor');
    }

    public function test_an_appointment_can_be_saved_with_an_available_doctor(): void
    {
        Department::create(['name' => 'Cardiology', 'is_active' => true]);
        Doctor::create([
            'name' => 'Dr. Asha Rao',
            'designation' => 'Consultant',
            'department' => 'Cardiology',
            'is_active' => true,
        ]);

        $response = $this->post(route('appointment.store'), [
            'patient_name' => 'Test Patient',
            'phone' => '9876543210',
            'department' => 'Cardiology',
            'preferred_doctor' => 'Dr. Asha Rao',
            'preferred_date' => today()->addDay()->toDateString(),
            'time_slot' => 'morning-1',
        ]);
        
        $this->assertTrue($response->isRedirect());
        $this->assertStringContainsString('wa.me', $response->headers->get('Location'));

        $this->assertDatabaseHas('appointments', [
            'patient_name' => 'Test Patient',
            'department' => 'Cardiology',
            'preferred_doctor' => 'Dr. Asha Rao',
        ]);
    }
}
