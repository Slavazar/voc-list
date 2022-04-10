<?php

namespace App\Http\Controllers\Account\Word;

use App\Http\Controllers\Controller;
use App\Models\Word\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        $categories = Category::where('user_id', $user->id)
                ->withCount('words')
                ->sort()
                ->paginate(10);

        return Inertia::render('Account/Word/Category/Index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Account/Word/Category/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        
        $data = $request->validate(Category::createValidationRules($user));
        
        $data['user_id'] = $user->id;
        
        $category = Category::create($data);

        return redirect()->route('account.categories.edit', ['category' => $category->id])
            ->with('success', __('The category was added successfully.'));
        
        //return redirect()->route('words.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Word\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Word\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $user = Auth::user();
        
        if ($category->user_id != $user->id) {
            return redirect()->route('account.categories.index')
                ->with('error', __('You are not allowed to access this item.'));
        }
        
        return Inertia::render('Account/Word/Category/Edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Word\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $user = Auth::user();
        
        if ($category->user_id != $user->id) {
            return redirect()->route('account.categories.index')
                ->with('error', __('You are not allowed to access this item.'));
        }
        
        $data = $request->validate(Category::updateValidationRules($user, $category));
        
        $category->update($data);

        return redirect()->route('account.categories.edit', ['category' => $category->id])
            ->with('success', __('The category was updated successfully.'));
        //return redirect()->route('words.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Word\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $user = Auth::user();
        
        if ($category->user_id != $user->id) {
            return redirect()->route('account.categories.index')
                ->with('error', __('You are not allowed to access this item.'));
        }
        
        $category->delete();
        
        return Redirect::route('account.categories.index')
            ->with('status', __('The category was deleted successfully.'));
    }
}
