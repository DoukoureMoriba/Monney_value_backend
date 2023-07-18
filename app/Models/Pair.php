<?php

namespace App\Models;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pair extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_sources',
        'id_target',
        'conversion_rates',
        'count',
    ];



    public function sourceCurrency()
    {
        // Recuperation des infos des pairs
        return $this->belongsTo(Currency::class, 'id_sources');
    }

    public function targetCurrency()
    {
        // Recuperation des infos des pairs
        return $this->belongsTo(Currency::class, 'id_target');
    }
}
