<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChecklistItem extends Model
{
    protected $table = 'checklist_items';

    protected $guarded = [];

    protected $fillable = ['department', 'item', 'status']; // Added 'status' to the fillable array
}
