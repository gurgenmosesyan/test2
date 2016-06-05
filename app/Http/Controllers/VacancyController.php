<?php

namespace App\Http\Controllers;

use App\Models\Vacancy\Vacancy;

class VacancyController extends Controller
{
    public function all()
    {
        $vacancies = Vacancy::select('vacancies.id','vacancies.published_at','ml.title','ml.function')->joinMl()->latest()->get();

        return view('vacancy.all')->with([
            'vacancies' => $vacancies
        ]);
    }

    public function index($lngCode, $id)
    {
        $vacancy = Vacancy::select('ml.*','vacancies.asap','vacancies.published_at','vacancies.start_date','vacancies.open_date','vacancies.deadline')
            ->joinMl()->where('vacancies.id', $id)->firstOrFail();

        return view('vacancy.index')->with([
            'vacancy' => $vacancy
        ]);
    }
}