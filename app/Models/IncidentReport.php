<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncidentReport extends Model
{
    protected $table = 'incident_reports'; // or 'incidentreport' if you renamed it
    public $timestamps = false;

    protected $fillable = [
        'userId',
        'hazardType',
        'description',
        'lat',
        'lng',
        'dateSubmitted',
        'status',
    ];
}
