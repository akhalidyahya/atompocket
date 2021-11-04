<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'status_id'
    ];

    /**
     * Get the data associated with the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function categoryStatus(): HasOne
    {
        return $this->hasOne(CategoryStatus::class, 'id', 'status_id');
    }
}
