<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Wallet extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'reference',
        'description',
        'wallet_status_id'
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
     * Get the data associated with the Wallet
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function walletStatus(): HasOne
    {
        return $this->hasOne(WalletStatus::class, 'id', 'wallet_status_id');
    }
}
