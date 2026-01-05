<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountingMovement extends Model
{
    protected $table = 'accounting_movements';
    protected $fillable = [
        'accounting_entry_id',
        'cuenta',
        'nombre_cuenta',
        'debito',
        'credito',
        'observaciones',
    ];

    public function entry()
    {
        return $this->belongsTo(AccountingEntry::class, 'accounting_entry_id');
    }
}
