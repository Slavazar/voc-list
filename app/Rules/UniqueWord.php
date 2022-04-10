<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\DataAwareRule;
use App\Models\Word;
use App\Models\User;

class UniqueWord implements Rule,  DataAwareRule
{
    protected $user;
    protected $word;
    protected $action = 'create';
    
    /**
     * All of the data under validation.
     *
     * @var array
     */
    protected $data = [];
    
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(User $user, Word $word = null)
    {
        $this->user = $user;
        
        if ($word) {
            $this->word = $word;
            $this->action = 'update';
        }
    }
 
    /**
     * Set the data under validation.
     *
     * @param  array  $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;
 
        return $this;
    } 

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($this->action == 'create') {
            $word = Word::where('user_id', $this->user->id)
                ->where('word', $this->data['word'])
                ->where('word_category_id', $this->data['word_category_id'])
                ->first();

            if ($word) {
                return false;
            }
        } else {
            $word = Word::where('user_id', $this->user->id)
                ->where('word', $this->data['word'])
                ->where('word_category_id', $this->data['word_category_id'])
                ->first();
            
            if ($word->id != $this->word->id) {
                return false;
            }
        }
        
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The word has already been taken.';
    }
}
