<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataNotifikasi extends Model
{
    use HasFactory;
    protected $table = 'data_notifikasi';
    protected $guarded = [];
    protected $dates = ['tanggal'];

    /**
     * Get the user that owns the DataNotifikasi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
