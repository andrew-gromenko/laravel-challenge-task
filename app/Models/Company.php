<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $hidden = [
        'pivot',
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'id',
        'name',
        'started_at',
    ];

    protected $appends = ['years'];

    public function getYearsAttribute()
    {
        $date = Carbon::parse($this->started_at);
        $now = Carbon::now();

        return $date->diffInYears($now);
    }

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'user_company',
            'company_id',
            'user_id');
    }

}
