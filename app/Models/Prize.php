<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Prize extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'type',
        'is_stock',
        'name',
        'count',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function things()
    {
        return $this->hasMany(Thing::class);
    }
}
