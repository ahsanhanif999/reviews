<?php

namespace App\Services;

use Illuminate\Http\Response;
use App\Models\Tag;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\Api\TagResource;
use Illuminate\Support\Facades\Storage;

use Auth;
use Str;

class TagService
{
    private $companyService;
    private $audioFolder = 'audio';
    private $uploadDisk = 'public';

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    public function createTag(string $name, bool $isActive, int $createdById): Response
    {
        $user = Auth::user();

        try {

            $tag = Tag::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'created_by' => $createdById,
                'is_active' => $isActive
            ]);

            return Response(['success' => true, 'tag' => new TagResource($tag)], 201);
        } catch (\Exception $ex) {

            return Response(['success' => false, 'message' => $ex->getMessage()], 500);
        }
    }

    public function getTags():AnonymousResourceCollection
    {
        $tags = Tag::all();
        return TagResource::collection($tags);
    }
}
