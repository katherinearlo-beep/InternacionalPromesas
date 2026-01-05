<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountingEntry extends Model
{
    protected $table = 'accounting_entries';
    protected $fillable = [
        'tipo', 'documento', 'numero', 'fecha', 'observaciones',
        'total_debito', 'total_credito',
    ];

    public function movements()
    {
        return $this->hasMany(AccountingMovement::class, 'accounting_entry_id');
    }
}
