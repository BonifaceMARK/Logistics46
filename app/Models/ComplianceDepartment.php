<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplianceDepartment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lms_g46_Compliancedepartments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'department_id', 'name', 'contact_person', 'contact_email', 'contact_phone',
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'department_id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Get the requirements associated with the department.
     */
    public function requirements()
    {
        return $this->hasMany(ComplianceRequirement::class, 'responsible_department', 'department_id');
    }
}
