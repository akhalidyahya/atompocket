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
    /**
     * Get the user associated with the Wallet
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function walletStatus(): HasOne
    {
        return $this->hasOne(WalletStatus::class, 'id', 'wallet_status_id');
    }
}
