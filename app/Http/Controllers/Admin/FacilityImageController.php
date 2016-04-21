<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Core\BaseController;
use App\Models\Facility\FacilityImage;
use App\Models\Facility\Manager;
use App\Http\Requests\Admin\FacilityImageRequest;

class FacilityImageController extends BaseController
{
    protected $manager = null;

    public function __construct(Manager $manager)
    {
        $this->manager = $manager;
    }

    public function edit()
    {
        $images = FacilityImage::all();
        return view('admin.facility.image')->with([
            'images' => $images
        ]);
    }

    public function update(FacilityImageRequest $request)
    {
        $data = $request->all();
        $images = isset($data['images']) ? $data['images'] : [];
        $this->manager->updateImages($images);
        return $this->api('OK');
    }
}