<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class securityappmodel extends Model
{
    use HasFactory;

    // Model Details

    protected $table = 'securityapplication';

    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'mothername',
        'fathername',
        'caste',
        'mobile',
        'email',
        'dob',
        'aadharnumber',
        'martialstatus',
        'state',
        'district',
        'jobdivision',
        'jobdistrict',
        'thesil',
        'permanentaddress',
        'currentaddress',
        'education',
        'percentage',
        'experience',
    ];
}
