<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;
use App\Models\Word\Category;
use App\Contracts\Model\ScopeSort;
use App\Rules\UniqueWord;

class Word extends Model implements ScopeSort
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'word_category_id',
        'word',
        'transcription',
        'translation'
    ];
    
    public function category()
    {
        return $this->belongsTo(Category::class, 'word_category_id');
    }
    
    public static function createValidationRules(User $user)
    {
        return [
            'word_category_id' => ['required'],
            'word' => [
                'required',
                'min:2',
                'max:50',
                new UniqueWord($user)
            ],
            'transcription' => ['required', 'min:2', 'max:50'],
            'translation' => ['required', 'min:2', 'max:50'],
        ];
    }
    
    public static function updateValidationRules(User $user, Word $word)
    {
        return [
            'word_category_id' => ['required'],
            'word' => [
                'required',
                'min:2',
                'max:50',
                new UniqueWord($user, $word)
            ],
            'transcription' => ['required', 'min:2', 'max:50'],
            'translation' => ['required', 'min:2', 'max:50'],
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
