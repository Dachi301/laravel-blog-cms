<?php

namespace App\Http\Controllers;

use App\Enums\RolesEnum;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $userIsNotAdmin = !$user->hasRole(RolesEnum::ADMIN->value);
        $userIsNotEditor = !$user->hasRole(RolesEnum::EDITOR->value);

        if ($userIsNotAdmin && $userIsNotEditor) {
            return response()->json([
                'message' => 'Only admins and editors can view categories'
            ], 403);
        }

        return response()->json(Category::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $userIsNotAdmin = !$user->hasRole(RolesEnum::ADMIN->value);
        $userIsNotEditor = !$user->hasRole(RolesEnum::EDITOR->value);

        if ($userIsNotAdmin && $userIsNotEditor) {
            return response()->json([
                'message' => 'Only admins and editors can create categories.'
            ], 403);
        }

        $request->validate([
            'name' => 'required|string|unique:categories,name',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);

        $category = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);

        return response()->json($category, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $user = Auth::user();

        $userIsNotAdmin = !$user->hasRole(RolesEnum::ADMIN->value);
        $userIsNotEditor = !$user->hasRole(RolesEnum::EDITOR->value);
        $category = Category::where('slug', $slug)->first();

        if (!$category) {
            return response()->json([
                'message' => 'Category not found'
            ], 404);
        }

        if ($userIsNotAdmin && $userIsNotEditor) {
            return response()->json([
                'message' => 'Only admins and editors can view category.'
            ], 403);
        }

        return response()->json($category, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $user = Auth::user();
        $userIsNotAdmin = !$user->hasRole(RolesEnum::ADMIN->value);
        $userIsNotEditor = !$user->hasRole(RolesEnum::EDITOR->value);

        $category = Category::where('slug', $slug)->first();

        if (!$category) {
            return response()->json([
                'message' => 'Category not found'
            ], 404);
        }

        if ($userIsNotAdmin && $userIsNotEditor) {
            return response()->json([
                'message' => 'Only admins and editors can update categories.'
            ], 403);
        }

        $request->validate([
            'name' => 'required|string|unique:categories,name,' . $category->id,
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);

        return response()->json($category, 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $user = Auth::user();

        $userIsNotAdmin = !$user->hasRole(RolesEnum::ADMIN->value);
        $userIsNotEditor = !$user->hasRole(RolesEnum::EDITOR->value);

        $category = Category::where('slug', $slug)->first();

        if (!$category) {
            return response()->json([
                'message' => 'Category not found'
            ], 404);
        }

        if ($userIsNotAdmin && $userIsNotEditor) {
            return response()->json([
                'message' => 'Only admins and editors can delete categories.'
            ], 403);
        }

        $category->delete();
        return response()->json(['message' => 'Category deleted successfully'], 200);
    }
}
