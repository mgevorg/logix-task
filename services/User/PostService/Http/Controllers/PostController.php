<?php

namespace Services\User\PostService\Http\Controllers;

use App\Http\Controllers\Controller;

use Services\User\PostService\Http\Requests\StoreRequest;
use Services\User\PostService\Http\Requests\UpdateRequest;
use Services\User\PostService\Http\Resources\PostResource;
use App\Models\Post;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="PostController API",
 *     version="1.0",
 * ),
 * @OA\PathItem(
 *     path="/api/"
 * ),
 * @OA\Components(
 *     @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     )
 * )
 */
class PostController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/posts/",
     *     summary="Display a listing of the post resource.",
     *     tags={"Post"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(),
     *
     *     @OA\Response(
     *          response=200,
     *          description="OK",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="array", @OA\Items(
     *                    @OA\Property(property="id", type="integer", example=1),
     *                    @OA\Property(property="name", type="string", example="Some Title"),
     *                    @OA\Property(property="description", type="string", example="Some Description"),
     *                    @OA\Property(property="image", type="string", example="base64example"),
     *              )),
     *          ),
     *     ),
     * ),
     */
    public function index()
    {
        $posts = Post::all();
        return PostResource::collection($posts);
    }

    public function create()
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/api/posts",
     *     summary="Create post resource.",
     *     tags={"Post"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *          @OA\JsonContent(
     *               allOf={
     *                    @OA\Schema(
     *                         @OA\Property(property="name", type="string", example="Some Title"),
     *                         @OA\Property(property="description", type="string", example="Some Title"),
     *                         @OA\Property(property="image", type="string", example=321),
     *                    ),
     *               },
     *          ),
     *     ),
     *
     * @OA\Response(
     *          response=201,
     *          description="Created",
     *          @OA\JsonContent(
     *               @OA\Property(property="data", type="object",
     *                    @OA\Property(property="id", type="integer", example=1),
     *                    @OA\Property(property="title", type="string", example="Some Title"),
     *                    @OA\Property(property="likes", type="string", example=321),
     *               ),
     *          ),
     *     ),
     * ),
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $post = Post::create($data);
        return PostResource::make($post);
    }

    /**
     * @OA\Get(
     *     path="/api/posts/{post}",
     *     summary="Display the specified post resource.",
     *     tags={"Post"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *          description="id of the post",
     *          in="path",
     *          name="post",
     *          required=true,
     *          example=1,
     *     ),
     *     @OA\RequestBody(),
     *
     * @OA\Response(
     *          response=200,
     *          description="OK",
     *          @OA\JsonContent(
     *               @OA\Property(property="data", type="object",
     *                    @OA\Property(property="id", type="integer", example=1),
     *                    @OA\Property(property="title", type="string", example="Some Title"),
     *                    @OA\Property(property="likes", type="string", example=321),
     *               ),
     *          ),
     *     ),
     * ),
     */
    public function show(Post $post)
    {
        return PostResource::make($post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * @OA\Patch(
     *     path="/api/posts/{post}",
     *     summary="Update the specified resource in storage.",
     *     tags={"Post"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *          description="id of the post",
     *          in="path",
     *          name="post",
     *          required=true,
     *          example=666,
     *     ),
     *
     *     @OA\RequestBody(
     *          @OA\JsonContent(
     *               allOf={
     *                    @OA\Schema(
     *                         @OA\Property(property="title", type="string", example="Some Title"),
     *                         @OA\Property(property="likes", type="integer", example=321),
     *                    ),
     *               },
     *          ),
     *     ),
     *
     *     @OA\Response(
     *          response=200,
     *          description="OK",
     *          @OA\JsonContent(
     *               @OA\Property(property="data", type="object",
     *                    @OA\Property(property="id", type="integer", example=1),
     *                    @OA\Property(property="title", type="string", example="Some Title"),
     *                    @OA\Property(property="likes", type="string", example=321),
     *               ),
     *          ),
     *     ),
     * ),
     */
    public function update(UpdateRequest $request, Post $post)
    {
        $data = $request->validated();
        $post->update($data);
//        $post = $post->fresh();

        return PostResource::make($post);
    }

    /**
     * @OA\Delete(
     *     path="/api/posts/{post}",
     *     summary="Remove the specified post resource from storage.",
     *     tags={"Post"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *          description="id of the post",
     *          in="path",
     *          name="post",
     *          required=true,
     *          example=3,
     *     ),
     *     @OA\RequestBody(),
     *
     *     @OA\Response(
     *          response=200,
     *          description="OK",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Delete"),
     *          ),
     *     ),
     * ),
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(array('message' => 'Delete'));
    }
}
