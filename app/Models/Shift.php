<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    public function shiftStaff()
    {
        return $this->hasMany(ShiftStaff::class);
    }
}
