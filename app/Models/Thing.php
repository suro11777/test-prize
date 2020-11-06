<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Thing extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'prize_id',
        'name',
        'count',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prize()
    {
        return $this->belongsTo(Prize::class);
    }
}
