<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    protected $fillable = ['department', 'checklist_items', 'status'];

    protected $casts = [
        'checklist_items' => 'array',
    ];
}
