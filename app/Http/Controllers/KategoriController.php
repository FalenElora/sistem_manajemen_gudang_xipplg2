<?php

namespace App\Http\Controllers;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $categories = Kategori::all();

        return response()->json([
            'status' => 200,
            'message' => 'Categories retrieved successfully.',
            'data' => $categories
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);

        $category = Kategori ::create($request->all());

        return response()->json([
            'status' => 201,
            'message'=>'Category created successfully.',
            'data' => $category
        ],201);
    }
    public function show($id)
    {
        $category = Kategori::find($id);

        if(!$category){
            return response()->json([
                'status' => 404,
                'message' => 'Category not found.',
                'data' => null
            ], 404);
            
        }
         return response()->json([
                'status' => 200,
                'message' => 'Category retrieved successfully.',
                'data' => $category
            
             ],200);
        }
        public function update (Request $request, $id)

        {
            $category = Kategori::find($id);
            if (!$category){
                return response()->json([
                    'status' => 404,
                    'message' => 'Category not found.',
                    'data' => null
                ], 404);
            }

            $request->validate(['name' => 'string|max:255']);
            $category->update($request->all());

            return response()->json([
                'status' => 200,
                'message' => 'Category update successfully.',
                'data' => $category
            ],200);
        }
        public function destroy($id)
        {
            $category = Kategori::find($id);

            if (!$category){
                return response()->json([
                    'status' => 404,
                    'message'=> 'Category not found.',
                    'data' => null
                ], 404);
            }

            $category->delete();

            return response()->json([
                'status'=> 200,
                'message'=> 'Category deleted successfully.',
                'data' => null
            ],200);
        }
}
