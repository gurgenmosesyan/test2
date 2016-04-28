<?php

namespace App\Models\Vacancy;

use DB;

class Manager
{
    public function store($data)
    {
        $data = $this->processSave($data);
        $vacancy = new Vacancy();
        DB::transaction(function() use($data, $vacancy) {
            $vacancy->save();
            $this->storeMl($data['ml'], $vacancy);
        });
    }

    public function update($id, $data)
    {
        $vacancy = Vacancy::findOrFail($id);
        $data = $this->processSave($data);
        DB::transaction(function() use($data, $vacancy) {
            $vacancy->update();
            $this->updateMl($data['ml'], $vacancy);
        });
    }

    protected function processSave($data)
    {
        if (!isset($data['asap'])) {
            $data['asap'] = Vacancy::ASAP_NO;
        }
        $data['published_at'] = empty($data['published_at']) ? date('Y-m-d') : date('Y-m-d', strtotime($data['published_at']));
        return $data;
    }

    protected function storeMl($data, Vacancy $vacancy)
    {
        $ml = [];
        foreach ($data as $lngId => $mlData) {
            $mlData['lng_id'] = $lngId;
            $ml[] = new VacancyMl($mlData);
        }
        $vacancy->ml()->saveMany($ml);
    }

    protected function updateMl($data, Vacancy $vacancy)
    {
        VacancyMl::where('id', $vacancy->id)->delete();
        $this->storeMl($data, $vacancy);
    }

    public function delete($id)
    {
        DB::transaction(function() use($id) {
            Vacancy::where('id', $id)->delete();
            VacancyMl::where('id', $id)->delete();
        });
    }
}