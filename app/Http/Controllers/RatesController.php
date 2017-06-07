<?php

namespace App\Http\Controllers;
use \GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Rate;

class RatesController extends Controller
{
    private $client;
    
    public function __construct()
    {
        $this->client = new Client();
    }

    public function index() {
        $allCurrencies = \Fixer::getAllCurrencies($this->client);
        return view('welcome', compact('allCurrencies'));
    }

    public function search(Request $request) {
        $allCurrencies = \Fixer::getAllCurrencies($this->client);
        $result = \Fixer::getRateByCurrency($this->client, $request->input('base'), $request->input('target'));

        Rate::create([
            'base_currency' => $request->input('base'),
            'target_currency' => $request->input('target'),
            'rate' => $result
        ]);

        $history = $this->getHistory($request->input('base'), $request->input('target'));

        $viewData = [
            'allCurrencies' => $allCurrencies,
            'base' => $request->input('base'),
            'target' => $request->input('target'),
            'result' => $result,
            'history' => $history
        ];

        return view('welcome', $viewData);
    }

    public function test() {
        dd($this->getHistory('USD', 'EUR'));
    }

    private function getHistory($base, $target)
    {
        /** 
         * I used this method to fetch the unique rates as opposed
         * to using laravels group by method because in the latest 
         * version of mysql groupBy doesn't work out of the box unless
         * you set in the mysql configuration file
         **/
        $uniqueRates = [];
        $selectedRates = [];
        $rates = Rate::where('base_currency', $base)->where('target_currency', $target)->get();

        foreach ($rates as $rate) {
            if (!in_array($rate->rate, $selectedRates)) {
                $uniqueRates[] = $rate;
                $selectedRates[] = $rate->rate;
            }
        }

        return $uniqueRates;
    }
}
