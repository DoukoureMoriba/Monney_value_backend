<?php

namespace Database\Seeders;

use App\Models\Pair;
use App\Models\Currency;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PairSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $size = Currency::count();// Cette variable permet de compter tout les element de la table des devises.
        Currency::chunk($size, function ($currencies) {
            foreach ($currencies as $currency) {
                $otherCurrencies = Currency::where('id', '<>', $currency->id)->get();
                
                foreach ($otherCurrencies as $otherCurrency) {
                    $conversionrates = mt_rand(1,100)/100;
                    $pair = new Pair();
                    $pair->sourceCurrency()->associate($currency);// faire reference a id_sources
                    $pair->targetCurrency()->associate($otherCurrency);// faire reference a id_target
                    $pair->conversion_rates = $conversionrates;
                    $pair->count = 0;
                    $pair->save();
                }
            }
        });
        
    }
}
