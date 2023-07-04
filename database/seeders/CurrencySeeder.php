<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currency = new Currency();
        $currency-> code_currency = 'BTC';
        $currency->save();

        $currency = new Currency();
        $currency-> code_currency = 'ETH';
        $currency->save();

        $currency = new Currency();
        $currency-> code_currency = 'XOF';
        $currency->save();

        $currency = new Currency();
        $currency-> code_currency = 'USD';
        $currency->save();

        $currency = new Currency();
        $currency-> code_currency = 'EUR';
        $currency->save();
    }
}
