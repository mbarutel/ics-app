<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'description',
        'start_date',
        'end_date',
        'venue'
    ];

    protected $cast = [
        'status' => Status::class
    ];
}
