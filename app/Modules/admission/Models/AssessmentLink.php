<?php

namespace Admission\Models;

use Illuminate\Database\Eloquent\Model;

class AssessmentLink extends Model
{
    protected $table = 'assessment_links';
    protected $fillable = [
        'id',
        'testName',
        'linkAddress',
        'divisionsId',
        'gradeId',
        'status',
        'notes',
        'testType',
        'user_id',
    ];

    public function admins()
    {
        return $this->belongsTo('App\Admin', 'user_id')->withTrashed();
    }
    public function grade()
    {
        return $this->belongsTo('Admission\Models\Grade', 'gradeId');
    }
}

