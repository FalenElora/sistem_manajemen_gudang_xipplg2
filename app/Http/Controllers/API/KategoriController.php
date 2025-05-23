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
 * @OA\Get(
 *     path="/category/{id}",
 *     tags={"Category"},
 *     operationId="getCategoryById",
 *     summary="Get category by ID",
 *     description="Retrieve a single category by its ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Category found",
 *         @OA\JsonContent(
 *             example={
 *                 "success": true,
 *                 "message": "Category retrieved successfully",
 *                 "data": {"id": 1, "name": "Fiction"}
 *             }
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Category not found",
 *         @OA\JsonContent(
 *             example={
 *                 "success": false,
 *                 "message": "Category not found"
 *             }
 *         )
 *     )
 * )
 */
public function getCategoryById($id)
{
    // Contoh implementasi tanpa database
    $categories = [
        1 => ['id' => 1, 'name' => 'Fiction'],
        2 => ['id' => 2, 'name' => 'Non-Fiction']
    ];

    if (isset($categories[$id])) {
        return response()->json([
            'success' => true,
            'message' => 'Category retrieved successfully',
            'data' => $categories[$id]
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Category not found'
        ], 404);
    }
}
/**
 * @OA\Get(
 *     path="/category/search",
 *     tags={"Category"},
 *     operationId="searchCategoryByName",
 *     summary="Search categories by name",
 *     description="Retrieve categories that match a given name",
 *     @OA\Parameter(
 *         name="name",
 *         in="query",
 *         required=true,
 *         description="Category name or partial match",
 *         @OA\Schema(type="string", example="Fiction")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Search results",
 *         @OA\JsonContent(
 *             example={
 *                 "success": true,
 *                 "message": "Categories found",
 *                 "data": {
 *                     {"id": 1, "name": "Fiction"}
 *                 }
 *             }
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="No categories found",
 *         @OA\JsonContent(
 *             example={
 *                 "success": false,
 *                 "message": "No categories found"
 *             }
 *         )
 *     )
 * )
 */
public function searchByName(Request $request)
{
    $name = strtolower($request->query('name'));

    // Contoh data statis (bisa diganti pakai database nanti)
    $categories = [
        ['id' => 1, 'name' => 'Fiction'],
        ['id' => 2, 'name' => 'Non-Fiction'],
        ['id' => 3, 'name' => 'Science'],
    ];

    $results = array_filter($categories, function ($category) use ($name) {
        return str_contains(strtolower($category['name']), $name);
    });

    if (count($results) > 0) {
        return response()->json([
            'success' => true,
            'message' => 'Categories found',
            'data' => array_values($results)
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'No categories found'
        ], 404);
    }
}



    /**
     * @OA\Post(
     *     path="/category",
     *     tags={"Category"},
     *     operationId="createCategory",
     *     summary="Create a new category",
     *     security={{"bearerAuth":{}}},
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
     *     security={{"bearerAuth":{}}},
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
     *     security={{"bearerAuth":{}}},
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
