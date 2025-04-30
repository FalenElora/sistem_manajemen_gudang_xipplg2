<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * @OA\Get(
     *     path="/category",
     *     tags={"Category"},
     *     operationId="listCategory",
     *     summary="List of Categories",
     *     description="Retrieve a list of book categories",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "message": "Successfully retrieved categories",
     *                 "data": {
     *                     {"id": 1, "name": "Fiction"},
     *                     {"id": 2, "name": "Non-Fiction"}
     *                 }
     *             }
     *         )
     *     )
     * )
     */
    public function listCategory()
    {
        return response()->json([
            'success' => true,
            'message' => 'Successfully retrieved categories',
            'data' => [
                [ 'id' => 1, 'name' => 'Fiction' ],
                [ 'id' => 2, 'name' => 'Non-Fiction' ]
            ]
        ]);
    }

    /**
     * @OA\Post(
     *     path="/category",
     *     tags={"Category"},
     *     operationId="createCategory",
     *     summary="Create a new category",
     *     description="Add a new book category",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="Science")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Category created successfully",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "message": "Category created successfully",
     *                 "data": {"id": 3, "name": "Science"}
     *             }
     *         )
     *     )
     * )
     */
    public function createCategory(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Category created successfully',
            'data' => [
                'id' => 3,
                'name' => $request->name
            ]
        ], 201);
    }

    /**
     * @OA\Put(
     *     path="/category/{id}",
     *     tags={"Category"},
     *     operationId="updateCategory",
     *     summary="Update a category",
     *     description="Update a book category by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="Updated Fiction")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Category updated successfully",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "message": "Category updated successfully",
     *                 "data": {"id": 1, "name": "Updated Fiction"}
     *             }
     *         )
     *     )
     * )
     */
    public function updateCategory(Request $request, $id)
    {
        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully',
            'data' => [
                'id' => (int)$id,
                'name' => $request->name
            ]
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/category/{id}",
     *     tags={"Category"},
     *     operationId="deleteCategory",
     *     summary="Delete a category",
     *     description="Delete a book category by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Category deleted successfully",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "message": "Category deleted successfully"
     *             }
     *         )
     *     )
     * )
     */
    public function deleteCategory($id)
    {
        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully'
        ]);
    }
}
