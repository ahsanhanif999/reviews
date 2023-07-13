<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Tag;
use App\Services\TagService;

use Auth;
use Validator;

class TagController extends Controller
{
    private $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    public function index(Request $request): Response
    {
        $tags = $this->tagService->getTags();

        return response(['tags' => $tags, 'success' => true], 200);
    }


    public function create(Request $request): Response
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:tags|max:255',
            'created_by' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['message' => $validator->errors()], 401);
        }
    
        $tag = $this->tagService->createTag($request->name, false, $request->created_by);
    
        return $tag ? $tag : response(['message' => 'Error creating tag'], 500);
    }

}
