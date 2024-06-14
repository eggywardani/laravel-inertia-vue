<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ListSectionRequest;
use App\Http\Resources\SectionResource;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{

    public function __invoke(ListSectionRequest $request) {
        $sections = Section::where('classroom_id', $request->classroom_id)->get();

        return SectionResource::collection($sections);
    }
}
