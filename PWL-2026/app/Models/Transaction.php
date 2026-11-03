<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = "transactions";
    protected $guarded = ['id'];
    public $timestamps = true;
    protected $fillable = [
        'invoice_number',
        'supplier_id',
        'transaction_type',
        'subtotal'
    ];

    public function transactionDetails(){
        return $this->hasMany(TransactionDetail::class, 'transaction_id', 'id');
    }

    public function Supplier() {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
}
