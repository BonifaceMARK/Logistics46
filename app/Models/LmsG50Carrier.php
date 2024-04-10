<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LmsG50Carrier extends Model
{
    protected $table = 'lms_g50_carriers';

    protected $fillable = [
        'company_name',
        'company_address',
        'contact_name',
        'email',
        'phone',
        'certificate_of_business_registration_image',
        'certificate_of_dti_image',
        'business_license_image',
        'certificate_of_bir_image',
        'certificate_of_insurance_image',
        'notes', // Added notes field
        'status', // Added status field
    ];
}
