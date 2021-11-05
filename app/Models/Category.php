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

    const FORM_VALIDATION = [
        'name'          => 'required|min:5',
        'description'   => 'max:100',
    ];

    const VALIDATION_MESAGE = [
        'name.required'     => 'Nama dompet wajib diisi!',
        'name.min'          => 'Nama dompet minimal :min karakter!',
        'description.max'   => 'Deskripsi tidak boleh melebihi :max karakter!',
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
