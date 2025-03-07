<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'description',
        'start_date',
        'end_date',
        'venue',
        'status',
        'created_by',
        'updated_by'
    ];

    protected $cast = [
        'status' => Status::class,
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
