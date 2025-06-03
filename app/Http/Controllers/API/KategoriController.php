<?php

namespace App\Http\Controllers\API;
use App\Models\Kategori;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
 * @OA\Get(
 *     path="/category",
 *     tags={"Category"},
 *     operationId="listOrSearchCategory",
 *     summary="List or search Category by name",
 *     description="Retrieve all categories or filter by partial match on 'nama' using query string",
 *     @OA\Parameter(
 *         name="nama",
 *         in="query",
 *         required=false,
 *         description="Optional. Partial or full name of the category to search for",
 *         @OA\Schema(
 *             type="string",
 *             example="Fiction"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="List of categories or search result",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Successfully retrieved categories"),
 *             @OA\Property(
 *                 property="data",
 *                 type="array",
 *                 @OA\Items(
 *                     @OA\Property(property="id", type="integer", example=1),
 *                     @OA\Property(property="nama", type="string", example="Fiction")
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="No matching categories found",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="No matching categories found")
 *         )
 *     )
 * )
 */
public function listCategory(Request $request)
{
    $name = $request->query('nama');

    if ($name) {
        $categories = Kategori::where('nama', 'LIKE', '%' . $name . '%')->get();

        if ($categories->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No matching categories found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Search results',
            'data' => $categories
        ]);
    }

    $categories = Kategori::all();
    return response()->json([
        'success' => true,
        'message' => 'Successfully retrieved categories',
        'data' => $categories
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
