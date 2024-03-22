<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplianceRequirement extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lms_g46_compliancerequirements';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'requirement_id', 'regulation_id', 'requirement_text', 'deadline', 'status', 'responsible_department', 'notes',
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'requirement_id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Get the regulation that owns the requirement.
     */
    public function regulation()
    {
        return $this->belongsTo(ComplianceRegulation::class, 'regulation_id', 'regulation_id');
    }

    /**
     * Get the department responsible for the requirement.
     */
    public function department()
    {
        return $this->belongsTo(ComplianceDepartment::class, 'responsible_department', 'department_id');
    }
}
