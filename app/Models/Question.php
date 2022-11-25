<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //use Uuid;
    use HasFactory;

    //public $incrementing = false;

    protected $fillable = ['pertanyaan'];

    protected $dates = [];


    /**
     * Get all of the optionQuestions for the Question
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function optionQuestions()
    {
        return $this->hasMany(OptionQuestion::class);
    }

    /**
     * Get all of the qustionAnswers for the Question
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function getJawaban($answer_id)
    {
        $question = $this->optionQuestions()->where('id', $answer_id)->first();
        if ($question) {
            return $question->nama_jawaban;
        }
    }
}
