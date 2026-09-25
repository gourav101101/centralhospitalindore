<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'patient_name', 'phone', 'email', 'age', 'gender',
        'department', 'preferred_doctor', 'preferred_date',
        'time_slot', 'symptoms', 'status', 'admin_notes',
    ];

    protected $casts = [
        'preferred_date' => 'date',
    ];

    public function scopePending($query) { return $query->where('status', 'pending'); }
    public function scopeConfirmed($query) { return $query->where('status', 'confirmed'); }
    public function scopeToday($query) { return $query->whereDate('preferred_date', today()); }
}
