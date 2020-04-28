<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DaysPeriod extends Model
{
    protected $fillable = [
        'days_number', 'description'
    ];
}
