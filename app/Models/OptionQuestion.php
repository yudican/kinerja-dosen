<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionQuestion extends Model
{
    use HasFactory;
    protected $guarded = [];
    /**
     * Get the question that owns the OptionQuestion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * Get all of the questionAnswer for the OptionQuestion
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questionAnswer()
    {
        return $this->hasMany(QustionAnswerDetail::class, 'option_question_id');
    }
}
