<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\CoinGeckoService;
use Illuminate\Support\Arr;
use Livewire\Attributes\Validate;
use NumberFormatter;

class Calculator extends Component
{
    #[Validate('required|gte:0')]
    public $eur = 0;

    #[Validate('required|gte:0')]
    public $btc = 0;

    public $response;
    public $rate;
    public $formattedRate;

    public function mount(CoinGeckoService $coinGeckoService)
    {
        $this->response = $coinGeckoService->getExchangeRate();
        $this->rate = Arr::get($this->response, 'bitcoin.eur');
        $this->formattedRate = $this->formatPrice($this->rate);
    }

    public function convertFromEur()
    {
        if ($this->eur === '') {
            $this->btc = 0;
        }
        $this->validate();
        $this->btc = $this->eur / $this->rate;
    }

    public function convertFromBtc()
    {
        if ($this->btc === '') {
            $this->eur = 0;
        }
        $this->validate();
        $this->eur = $this->btc * $this->rate;
    }
    
    public function render()
    {
        return view('livewire.calculator');
    }

    public function formatPrice($value)
    {
        $formatter = new NumberFormatter('de_DE', NumberFormatter::CURRENCY);
        return $formatter->formatCurrency($value, 'EUR');
    }

    public function updated($key, $value) 
    {
        if ($key === 'btc') {
            $this->convertFromBtc();
        }

        if ($key ==='eur') {
            $this->convertFromEur();
        }
    }
}
