<?php

namespace App\Models\Vacancy;

use App\Core\Model;

class Vacancy extends Model
{
    const ASAP_YES = '1';
    const ASAP_NO = '0';

    protected $table = 'vacancies';

    protected $fillable = [
        'asap',
        'published_at',
        'start_date',
        'open_date',
        'deadline'
    ];

    public function ml()
    {
        return $this->hasMany(VacancyMl::class, 'id', 'id');
    }
}