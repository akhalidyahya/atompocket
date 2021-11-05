<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_code',
        'description',
        'transaction_date',
        'amount',
        'wallet_id',
        'category_id',
        'status_id',
    ];

    const FORM_VALIDATION = [
        'amount'        => 'required|numeric',
        'description'   => 'max:100',
    ];

    const VALIDATION_MESAGE = [
        'amount.required'   => 'Nilai transaksi wajib diisi!',
        'amount.numeric'    => 'Nilai transaksi harus berupa angka!',
        'description.max'   => 'Deskripsi tidak boleh melebihi :max karakter!',
    ];

    /**
     * Get the wallet that owns the Transaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class, 'wallet_id', 'id');
    }

    /**
     * Get the category that owns the Transaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * Get the status that owns the Transaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(TransactionStatus::class, 'status_id', 'id');
    }
}
