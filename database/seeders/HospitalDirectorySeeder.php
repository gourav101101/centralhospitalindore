<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Database\Seeder;

class HospitalDirectorySeeder extends Seeder
{
    public function run(): void
    {
        $names = ['Obstetrics and Gynaecology', 'Pediatrics & Neonatology', 'Fetal Medicine', 'Gastroenterology', 'General Medicine', 'General Surgery', 'Joint Replacement', 'Neurology', 'Neurosurgery', 'Oncosurgery', 'Orthopedic & Trauma', 'Radiology', 'Urology', 'Fertility', 'Cardiology'];

        foreach ($names as $index => $name) {
            Department::updateOrCreate(['name' => $name], [
                'icon' => str_contains($name, 'Pediatric') ? 'child' : (str_contains($name, 'Neuro') ? 'brain' : (str_contains($name, 'Cardio') ? 'heart' : 'medical')),
                'description' => "Specialist diagnosis, treatment and compassionate patient care in {$name}.",
                'sort_order' => $index + 1,
                'is_active' => true,
            ]);
        }

        $doctors = [
            ['name' => 'Dr. Nidhi Mishra', 'designation' => 'Director & Co-Founder · Gynecologist, IVF and Fetal Medicine Consultant', 'department' => 'Obstetrics and Gynaecology', 'experience' => '15+ years', 'qualification' => 'Gynecology, IVF & Fetal Medicine', 'photo' => 'uploads/doctors/dr-nidhi-mishra.jpg', 'sort_order' => 1],
            ['name' => 'Dr. Gaurav Mishra', 'designation' => 'Director & Co-Founder · Pediatrician and Neonatologist', 'department' => 'Pediatrics & Neonatology', 'experience' => '15+ years', 'qualification' => 'Pediatrics & Neonatology', 'photo' => 'uploads/doctors/dr-gaurav-mishra.jpg', 'sort_order' => 2],
        ];

        foreach ($doctors as $doctor) {
            Doctor::updateOrCreate(['name' => $doctor['name']], [...$doctor, 'is_active' => true]);
        }
    }
}
