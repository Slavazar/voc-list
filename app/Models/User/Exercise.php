<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

use App\Models\Word\Category;
use App\Contracts\Model\ScopeSort;
use App\Models\User;

class Exercise extends Model implements ScopeSort
{
    use HasFactory;
    
    protected $table = 'user_exercises';
    
    protected $fillable = [
        'user_id',
        'word_category_id',
        'name',
    ];
    
    public function category()
    {
        return $this->belongsTo(Category::class, 'word_category_id');
    }
    
    public static function createValidationRules(User $user)
    {
        return [
            'word_category_id' => ['required'],
            'name' => [
                'required',
                'min:2',
                'max:50',
                Rule::unique('user_exercises')->where(fn ($query) => $query->where('user_id', $user->id)),
            ],
        ];
    }
    
    public static function updateValidationRules(User $user, Exercise $exercise)
    {
        return [
            'word_category_id' => ['required'],
            'name' => [
                'required',
                'min:2',
                'max:50',
                Rule::unique('user_exercises')
                    ->where(fn ($query) => $query->where('user_id', $user->id))
                    ->ignore($exercise->id),
            ],
        ];
    }
    
    /**
     * Scope a query to only include popular users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSort($query)
    {
        $req = Request::query();
        
        $queryData = [
            'sort' => $req['sort'] ?? '',
            'direction' => $req['direction'] ?? '',
            'page' => $req['page'] ?? '',
        ];
        
        if (!empty($queryData['sort'])) {
            if (empty($queryData['direction'])) {
                return $query->orderBy($queryData['sort'], 'asc');
            } else {
                return $query->orderBy($queryData['sort'], $queryData['direction']);
            }
        }
        
        return $query;
    }    
}
