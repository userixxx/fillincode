<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;

/**
 * @OA\Tag(name="Comments", description="Operations related to comments")
 */
class CommentController extends Controller
{
    /**
     * @OA\Get(
     *     path="/comments",
     *     summary="List all comments",
     *     tags={"Comments"},
     *     @OA\Response(
     *         response=200,
     *         description="List of comments",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Comment")
     *         )
     *     )
     * )
     */
    public function index()
    {
        return CommentResource::collection(Comment::all());
    }

    /**
     * @OA\Post(
     *     path="/comments",
     *     summary="Create a new comment",
     *     tags={"Comments"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/CommentRequest")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Created comment",
     *         @OA\JsonContent(ref="#/components/schemas/Comment")
     *     )
     * )
     */
    public function store(StoreCommentRequest $request)
    {
        $validated = $request->validated();
        $comment = Comment::create($validated);
        return new CommentResource($comment);
    }

    /**
     * @OA\Get(
     *     path="/comments/{id}",
     *     summary="Get a specific comment",
     *     tags={"Comments"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="The requested comment",
     *         @OA\JsonContent(ref="#/components/schemas/Comment")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Comment not found"
     *     )
     * )
     */
    public function show(Comment $comment)
    {
        return new CommentResource($comment);
    }

    /**
     * @OA\Put(
     *     path="/comments/{id}",
     *     summary="Update a specific comment",
     *     tags={"Comments"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/CommentRequest")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Updated comment",
     *         @OA\JsonContent(ref="#/components/schemas/Comment")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Comment not found"
     *     )
     * )
     */
    public function update(StoreCommentRequest $request, Comment $comment)
    {
        $validated = $request->validated();
        $comment->update($validated);
        return new CommentResource($comment);
    }

    /**
     * @OA\Delete(
     *     path="/comments/{id}",
     *     summary="Delete a specific comment",
     *     tags={"Comments"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Comment deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Comment not found"
     *     )
     * )
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->noContent();
    }
}
