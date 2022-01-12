<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentReplyRequest;
use App\Http\Requests\CommentStoreRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $comments = Comment::latest()
            ->whereNull('parent_id')
            ->with('children')
            ->get();
        return response()->json(CommentResource::collection($comments));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CommentStoreRequest $request
     * @return JsonResponse
     */
    public function store(CommentStoreRequest $request): JsonResponse
    {
        $comment = Comment::create($request->all());
        return response()->json(new CommentResource($comment), 201);
    }

    /**
     * @param CommentReplyRequest $request
     * @return JsonResponse
     */
    public function reply(CommentReplyRequest $request): JsonResponse
    {
        $comment = Comment::create($request->all());
        return response()->json(new CommentResource($comment->loadMissing('children')), 201);
    }
}
