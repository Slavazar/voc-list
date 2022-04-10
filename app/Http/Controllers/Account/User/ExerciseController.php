<?php

namespace App\Http\Controllers\Account\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
//use Illuminate\Support\Facades\Validator;
use App\Models\User\Exercise;
use App\Models\Word\Category;

class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        $exercises = Exercise::where('user_exercises.user_id', $user->id)
            ->join('word_categories', 'word_categories.id', '=', 'user_exercises.word_category_id')
            ->select('user_exercises.*', 'word_categories.name as category_name')
            ->sort()
            ->paginate(10);

        return Inertia::render('Account/User/Exercise/Index', [
            'exercises' => $exercises,
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
        
        return Inertia::render('Account/User/Exercise/Create', [
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
        
        $data = $request->validate(Exercise::createValidationRules($user));
        
        $data['user_id'] = $user->id;
        
        $exercise = Exercise::create($data);

        return redirect()->route('account.exercises.edit', ['exercise' => $exercise->id])
            ->with('success', __('The exercise was added successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function show(Exercise $exercise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function edit(Exercise $exercise)
    {
        $user = Auth::user();
        
        if ($exercise->user_id != $user->id) {
            return redirect()->route('account.exercises.index')
                ->with('error', __('You are not allowed to access this item.'));
        }
        
        $categories = Category::where('user_id', $user->id)->get();
        
        return Inertia::render('Account/User/Exercise/Edit', [
            'exercise' => $exercise,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exercise $exercise)
    {
        $user = Auth::user();
        
        if ($exercise->user_id != $user->id) {
            return redirect()->route('account.exercises.index')
                ->with('error', __('You are not allowed to access this item.'));
        }
        
        $data = $request->validate(Exercise::updateValidationRules($user, $exercise));
        
        $exercise->update($data);

        return redirect()->route('account.exercises.edit', ['exercise' => $exercise->id])
            ->with('success', __('The exercise was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exercise $exercise)
    {
        $user = Auth::user();
        
        if ($exercise->user_id != $user->id) {
            return redirect()->route('account.exercises.index')
                ->with('error', __('You are not allowed to access this item.'));
        }
        
        $exercise->delete();
        
        return Redirect::route('account.exercises.index')
            ->with('status', __('The exercise was deleted successfully.'));
    }
}
