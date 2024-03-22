<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplianceDocument extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lms_g46_compliancedocuments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'document_id', 'title', 'document_type', 'file_path', 'upload_date', 'expiration_date', 'related_regulation_id',
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'document_id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Get the regulation related to the document.
     */
    public function regulation()
    {
        return $this->belongsTo(ComplianceRegulation::class, 'related_regulation_id', 'regulation_id');
    }
}
