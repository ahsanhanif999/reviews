<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\Api\Admin\PostApproveRequest;
use App\Services\PostService;

class PostController extends AdminController
{
    private $postService;

    public function __construct(PostService $postService)
    {
        $this->middleware('auth.admin');
        $this->postService = $postService;
    }

    public function approve(PostApproveRequest $request, int $id): Response
    {
        $data = $request->validated();
        $response = $this->postService->approvePost($data, $id);

        return $response;
    }
}
