<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Api\PostCreateRequest;
use App\Http\Requests\Api\PostUpdateRequest;
use App\Services\PostService;

class PostController extends Controller
{
    private $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index($type = null, $tag = null): Response
    {
        $response = $this->postService->getPosts($type, $tag);

        return $response;
    }

    public function store(PostCreateRequest $request): Response
    {
        $postData = $request->validated();
        $response = $this->postService->createPost($postData, $request->file('audio_file'));

        return $response;
    }

    public function show(Request $request, int $id): Response
    {
        $response = $this->postService->getPost($id);

        return $response;
    }

    public function update(PostUpdateRequest $request, int $id): Response
    {
        $postData = $request->validated();
        $response = $this->postService->updatePost($postData, $id, $request->file('audio_file'));

        return $response;
    }

    public function destroy(Post $post)
    {

    }
}
