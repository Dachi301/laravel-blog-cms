<?php

namespace App\Http\Controllers;

use App\Enums\RolesEnum;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($slug)
    {
        $category = Category::where('slug', $slug)->first();

        $user = Auth::user();
        $userIsNotAdmin = !$user->hasRole(RolesEnum::ADMIN->value);
        $userIsNotEditor = !$user->hasRole(RolesEnum::EDITOR->value);

        if ($userIsNotAdmin && $userIsNotEditor) {
            return response()->json([
                'message' => 'Only admins and editors can view sub-categories.'
            ], 403);
        }

        if (!$category) {
            return response()->json([
                'message' => 'Category not found'
            ], 404);
        }

        $subCategories = $category->sub_categories;

        if ($subCategories->isEmpty()) {
            return response()->json([
                'message' => 'No subcategories found for this category.'
            ], 200);
        }

        return response()->json($subCategories, 200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->first();

        $user = Auth::user();
        $userIsNotAdmin = !$user->hasRole(RolesEnum::ADMIN->value);
        $userIsNotEditor = !$user->hasRole(RolesEnum::EDITOR->value);

        if ($userIsNotAdmin && $userIsNotEditor) {
            return response()->json([
                'message' => 'Only admins and editors can create sub-categories.'
            ], 403);
        }

        if (!$category) {
            return response()->json([
                'message' => 'Category not found'
            ], 404);
        }

        $request->validate([
            'name' => 'required|string|unique:sub_categories,name,NULL,id,category_id,' . $category->id
        ]);

        $subCategory = $category->sub_categories()->create([
            'name' => $request->name,
        ]);

        return response()->json($subCategory, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($categorySlug, $subCategoryId)
    {
        $category = Category::where('slug', $categorySlug)->first();

        $user = Auth::user();
        $userIsNotAdmin = !$user->hasRole(RolesEnum::ADMIN->value);
        $userIsNotEditor = !$user->hasRole(RolesEnum::EDITOR->value);

        if ($userIsNotAdmin && $userIsNotEditor) {
            return response()->json([
                'message' => 'Only admins and editors can view sub-category.'
            ], 403);
        }

        if (!$category) {
            return response()->json([
                'message' => 'Category not found'
            ], 404);
        }

        $subCategory = $category->sub_categories()->find($subCategoryId);

        if (!$subCategory) {
            return response()->json([
                'message' => 'Subcategory not found'
            ], 404);
        }

        return response()->json($subCategory, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $categorySlug, $subCategoryId)
    {
        $category = Category::where('slug', $categorySlug)->first();

        $user = Auth::user();
        $userIsNotAdmin = !$user->hasRole(RolesEnum::ADMIN->value);
        $userIsNotEditor = !$user->hasRole(RolesEnum::EDITOR->value);

        if ($userIsNotAdmin && $userIsNotEditor) {
            return response()->json([
                'message' => 'Only admins and editors can update sub-category.'
            ], 403);
        }

        if (!$category) {
            return response()->json([
                'message' => 'Category not found'
            ], 404);
        }

        $subCategory = $category->sub_categories()->find($subCategoryId);

        if (!$subCategory) {
            return response()->json([
                'message' => 'Subcategory not found'
            ], 404);
        }

        $request->validate([
            'name' => 'required|string|unique:sub_categories,name,' . $subCategory->id . ',id,category_id,' . $category->id,
        ]);

        $subCategory->update([
            'name' => $request->name,
        ]);

        return response()->json($subCategory, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($categorySlug, $subCategoryId)
    {
        $category = Category::where('slug', $categorySlug)->first();

        $user = Auth::user();
        $userIsNotAdmin = !$user->hasRole(RolesEnum::ADMIN->value);
        $userIsNotEditor = !$user->hasRole(RolesEnum::EDITOR->value);

        if ($userIsNotAdmin && $userIsNotEditor) {
            return response()->json([
                'message' => 'Only admins and editors can delete sub-category.'
            ], 403);
        }

        if (!$category) {
            return response()->json([
                'message' => 'Category not found'
            ], 404);
        }

        $subCategory = $category->sub_categories()->find($subCategoryId);

        if (!$subCategory) {
            return response()->json([
                'message' => 'Subcategory not found'
            ], 404);
        }

        $subCategory->delete();

        return response()->json(['message' => 'Subcategory deleted successfully'], 200);
    }
}
