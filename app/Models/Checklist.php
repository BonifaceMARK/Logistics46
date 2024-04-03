<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    protected $fillable = ['department', 'documentation_name', 'checklist_item', 'status', 'notes'];


}
