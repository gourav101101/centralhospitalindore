<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientFeedback extends Model
{
    protected $table = 'patient_feedback';

    protected $fillable = ['patient_name', 'department', 'rating', 'feedback', 'status'];

    protected $casts = ['rating' => 'integer'];

    public function scopeApproved($query) { return $query->where('status', 'approved'); }
    public function scopePending($query) { return $query->where('status', 'pending'); }
}
