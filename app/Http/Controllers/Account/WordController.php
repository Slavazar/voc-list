<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use App\Models\Word;
use App\Models\Word\Category;

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        
        $words = Word::where('words.user_id', $user->id)
            ->join('word_categories', 'word_categories.id', '=', 'words.word_category_id')
            ->select('words.*', 'word_categories.name as category_name')
            ->sort()
            ->paginate(10);
        
        return Inertia::render('Account/Word/Index', [
            'words' => $words,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $categories = Category::where('user_id', $user->id)->get();
        
        return Inertia::render('Account/Word/Create', [
            'categories' => $categories
        ]);
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
        
        $data = $request->validate(Word::createValidationRules($user));
        
        $data['user_id'] = $user->id;
        
        $word = Word::create($data);

        return redirect()->route('account.words.edit', ['word' => $word->id])
            ->with('success', __('The word was added successfully.'));
        
        //return redirect()->route('words.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function show(Word $word)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function edit(Word $word)
    {
        $user = Auth::user();
        
        if ($word->user_id != $user->id) {
            return redirect()->route('account.words.index')
                ->with('error', __('You are not allowed to access this item.'));
        }
        
        $categories = Category::where('user_id', $user->id)->get();
        
        return Inertia::render('Account/Word/Edit', [
            'word' => $word,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Word $word)
    {
        $user = Auth::user();
        
        if ($word->user_id != $user->id) {
            return redirect()->route('account.words.index')
                ->with('error', __('You are not allowed to access this item.'));
        }
        
        $data = $request->validate(Word::updateValidationRules($user, $word));
        
        $word->update($data);

        return redirect()->route('account.words.edit', ['word' => $word->id])
            ->with('success', __('The word was updated successfully.'));
        //return redirect()->route('words.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function destroy(Word $word)
    {
        $user = Auth::user();
        
        if ($word->user_id != $user->id) {
            return redirect()->route('account.words.index')
                ->with('error', __('You are not allowed to access this item.'));
        }
        
        $word->delete();
        
        return Redirect::route('account.words.index')
            ->with('status', __('The word was deleted successfully.'));
    }
}
