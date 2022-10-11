<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QustionAnswerDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the user that owns the QustionAnswerDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the dataJadwal that owns the QustionAnswerDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dataJadwal()
    {
        return $this->belongsTo(DataJadwal::class);
    }

    /**
     * Get the optionQuestion that owns the QustionAnswerDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function optionQuestion()
    {
        return $this->belongsTo(OptionQuestion::class);
    }
}
