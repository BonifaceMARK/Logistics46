<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplianceRegulation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lms_g46_complianceregulations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'regulation_id', 'title', 'description', 'jurisdiction', 'category',
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'regulation_id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
}
