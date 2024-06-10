<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftStaff extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'email',
        'shift_id'
    ];

    public function shift()
    {
        return $this->belongTo(Shift::class);
    }
}
