<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Core\BaseController;
use App\Models\Facility\FacilityText;
use App\Models\Facility\Manager;
use App\Http\Requests\Admin\FacilityTextRequest;
use App\Core\Language\Language;

class FacilityTextController extends BaseController
{
    protected $manager = null;

    public function __construct(Manager $manager)
    {
        $this->manager = $manager;
    }

    public function edit()
    {
        $text = FacilityText::all()->keyBy('lng_id');
        $languages = Language::all();
        return view('admin.facility.text')->with([
            'text' => $text,
            'languages' => $languages
        ]);
    }

    public function update(FacilityTextRequest $request)
    {
        $data = $request->all();
        $this->manager->updateText($data['ml']);
        return $this->api('OK');
    }
}