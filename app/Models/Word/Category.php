<?php

namespace App\Models\Word;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;
use App\Models\Word;
use App\Contracts\Model\ScopeSort;
use App\Models\User;

class Category extends Model implements ScopeSort
{
    use HasFactory;
    
    protected $table = 'word_categories';
    
    protected $fillable = [
        'user_id',
        'name',
    ];
    
    public function words()
    {
        return $this->hasMany(Word::class, 'word_category_id');
    }
    
    public static function createValidationRules(User $user)
    {
        return [
            'name' => [
                'required',
                'min:2',
                'max:50',
                Rule::unique('word_categories')->where(fn ($query) => $query->where('user_id', $user->id)),
            ],
        ];
    }
    
    public static function updateValidationRules(User $user, Category $category)
    {
        return [
            'name' => [
                'required',
                'min:2',
                'max:50',
                Rule::unique('word_categories')
                    ->where(fn ($query) => $query->where('user_id', $user->id))
                    ->ignore($category->id),
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
