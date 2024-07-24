<div class="row justify-content-center align-items-center vh-100">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header text-uppercase">
                Crypto Converter
            </div>
            <div class="card-body">
                @if (!$rate)
                    <div class="alert alert-warning" role="alert">
                        No BTC price available, reload the page to try again.
                    </div>
                @else
                <div class="input-group mb-3">
                    <span class="input-group-text">EUR</span>
                    <input type="text" id="eur" wire:model.live="eur" class="form-control" placeholder="EUR">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">BTC</span>
                    <input type="number" id="btc" wire:model.live="btc" class="form-control" placeholder="BTC">
                </div>
                <div class="mt-3">
                    <p class="fw-bold">1 BTC = {{ $formattedRate }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- @dump($__data) --}}
</div>