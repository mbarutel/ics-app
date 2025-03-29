<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'description',
        'media_release',
        'registration_prefix',
        'status',
        'created_by',
        'updated_by'
    ];

    protected $cast = [
        'status' => Status::class,
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
