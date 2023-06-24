<?php

namespace App\Services;

use Illuminate\Http\Response;
use App\Models\Post;
use App\Models\Company;
use App\Models\PostTag;
use App\Services\CompanyService;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\Api\PostResource;
use Illuminate\Support\Facades\Storage;

use Auth;
use Str;

class PostService
{
    private $companyService;
    private $tagService;
    private $audioFolder = 'audio';
    private $uploadDisk = 'public';

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
        $this->tagService = $tagService;
    }

    public function createPost(array $data, $audioFile = null): Response
    {
        $user = Auth::user();
        $companyId = $this->companyService->getCompanyId($data);
        $postDetails = $this->handlePostDescription($data, null, $audioFile);

        try {

            $post = Post::create([
                'user_id' => $user->id,
                'company_id' => $companyId,
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'description' => $postDetails['description'],
                'status' => 'review',
                'audio_file' => $postDetails['audio_file']
            ]);

            if(isset($data['tags'])){

                $this->handlePostTags($data['tags'], $post->id);
            }

            return Response(['success' => true, 'post' => new PostResource($post)], 201);
        } catch (\Exception $ex) {

            return Response(['success' => false, 'message' => $ex->getMessage()], 500);
        }
    }

    public function updatePost(array $data, $id, $audioFile = null): Response
    {
        $user = Auth::user();

        if(isset($data['company_id']) || isset($data['company_name'])){

            $companyId = $this->companyService->getCompanyId($data);
        }

        try {

            $post = Post::findOrFail($id);
            $existingAudioFile = $post->audio_file ? $post->audio_file : null;
            $postDetails = $this->handlePostDescription($data, $existingAudioFile, $audioFile);

            try {

                $post->title = $data['title'];
                $post->slug = Str::slug($data['title']);
                $post->description = $postDetails['description'];
                $post->audio_file = $postDetails['audio_file'];
                $post->company_id = isset($companyId) ? $companyId : $post->company_id;
                $post->save();

                return Response(['success' => true, 'post' => new PostResource($post)], 200);
            } catch (\Exception $ex) {

                return Response(['success' => false, 'message' => $ex->getMessage()], 500);
            }
        } catch (\Exception $ex) {

            return Response(['success' => false, 'message' => $ex->getMessage()], 500);
        }
    }

    public function approvePost(array $data, $id): Response
    {
        $user = Auth::user();
        $post = Post::findOrFail($id);

        try {

            if(isset($data['company_id'])){

                $post->company_id = $data['company_id'];
            }else{

                $company = Company::onlyTrashed()->where('id', $post->company_id)->get()->first();

                if(!$company){

                    return Response(['success' => false, 'message' => 'company not found'], 404);
                }

                $company->restore();
            }

            $post->status = 'active';
            $post->save();

            return Response(['success' => true, 'post' => new PostResource($post)], 200);
        } catch (\Exception $ex) {

            return Response(['success' => false, 'message' => $ex->getMessage()], 500);
        }
    }

    public function getPost(int $id): Response
    {
        try {

            $post = new PostResource(Post::with('company')->findOrFail($id));
            return Response(['success' => true, 'post' => $post], 200);
        } catch (ModelNotFoundException $ex) {

            return Response(['success' => false, 'message' => $ex->getMessage()], 404);
        }
    }

    public function getPosts(mixed $type, mixed $tag): Response
    {
        try {

            if ($type == 'tag') {

                $posts = Post::whereHas('tags', function ($query) use ($tag) {
                    $query->where('name', $tag);
                })->get();
            }else{

                $posts = PostResource::collection(Post::with('company')->get());
            }

            return Response(['success' => true, 'posts' => $posts], 200);
        } catch (ModelNotFoundException $ex) {

            return Response(['success' => false, 'message' => $ex->getMessage()], 404);
        }
    }

    public function handlePostDescription(array $data, $existingAudioFile, $audioFile): array
    {
        $details = ['description' => null, 'audio_file' => null];

        if(isset($data['description'])){

            $details['description'] = $data['description'];
        }else if($existingAudioFile){

            if($audioFile){

                $this->removeAudioFile($existingAudioFile);
                $details['audio_file'] = $this->uploadAudioFile($audioFile);
            }
        }else{

            $details['audio_file'] = $this->uploadAudioFile($audioFile);
        }

        return $details;
    }

    public function handlePostTags(array $tags, int $postId): void
    {
        $user = Auth::user();

        foreach ($tags as $key => $tag) {

            if($tag['id'] == 0){

                $newTag = $this->tagService->createTag($tag['name'], false, $user->id);
            }else{

                $newTag = $this->tagService->createTag($tag['name'], false, $user->id);
            }

            $this->attachTag($newTag->id, $postId);
        }
    }

    public function attachTag(int $tagId, int $postId): PostTag
    {
        return PostTag::create([

            'post_id' => $postId,
            'tag_id' => $tagId,
        ]);
    }

    public function removeAudioFile(string $audioFileName): bool
    {
        $diskRoot = $disk->getDriver()->getAdapter()->getPathPrefix();
        $path = $diskRoot.$this->audioFolder;

        return Storage::disk($this->uploadDisk)->delete($path);
    }

    public function uploadAudioFile(UploadedFile $audioFile): string
    {
        $filename = Str::random(15) . '.' . $audioFile->getClientOriginalExtension();
        $path = $audioFile->storeAs($this->audioFolder, $filename, $this->uploadDisk);

        return $filename;
    }
}
