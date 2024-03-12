<title>Your Created Offers</title>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
        
    <section class="money">
        <div class="balance square">
            <div class="cardbox1">
                <div class="htgf">
                    <img src="img/htg.png" alt="HTG Flag" class="flag-icon"> <!-- Flag icon -->
                    <p class="amount">HTG Balance:</p>
                </div>
                <div class="balance-text">
                    <p class="bott">{{ $balance->htg_balance ?? 0.00 }} G</p>
                </div>
            </div>
        </div>
        <div class="balance rounded">
            <div class="cardbox1">
                <div class="usdf">
                    <img src="img/usa.png" alt="USD Flag" class="flag-icon"> <!-- Flag icon -->
                    <p class="amount">USD Balance:</p>
                </div>
                <div class="balance-text">
                    <p class="bott">{{ $balance->usd_balance ?? 0.00 }} $</p>
                </div>
            </div>
        </div>
    </section>
    <div class="user-offer">
        <h1>voici votre liste d'offres que vous avez créée</h1>

        <div class="offers-container">
            @foreach($offers as $offer)
                @if($offer->user_id === auth()->user()->id)
                    <div class="offer-wrapper">
                        <div class="card">
                            <div class="card-header">
                                <h2>{{ $offer->type_Offer }}</h2>
                            </div>
                            <div class="card-body">
                                <p>
                                    Amount in USD: <span style="color: {{ $offer->Amount > 0 ? '#73d015' : 'red' }}">
                                        ${{ $offer->Amount }}
                                    </span>
                                </p>
                                
                                <p>
                                    Cost Value: <span style="color: {{ $offer->Cost_value > 0 ? '#4b53ff' : 'red' }}">
                                        HTG {{ $offer->Cost_value }}
                                    </span>
                                </p>
                                <p>
                                    Accepted: <span style="color: {{ $offer->accepted ? '#28b156' : 'red' }}; font-size: 16px;">
                                        {{ $offer->accepted ? 'Yes' : 'No' }}
                                    </span>
                                </p>
                                <p>
                                    Completed: <span style="color: {{ $offer->Completed ? '#28b156' : '#2980b9' }}; font-size: 16px;">
                                        {{ $offer->completed ? 'Yes' : 'No' }}
                                    </span>
                                </p>
                                <p>
                                    approved: <span style="color: {{ $offer->approved ? '#28b156' : 'red' }}; font-size: 16px;">
                                        {{ $offer->approved ? 'Yes' : 'No' }}
                                    </span>
                                </p>

                            
                                <!-- Afiche yon tèks pou itilizatè a voye lajan an USD sou adres crypto a -->
                                <div class="instruction">Send the amount of <span class="amount">${{ $offer->Amount }}</span> USD to the following address:</div>
                                <div class="crypto-address-container">
                                    <div class="crypto-address" id="cryptoAddress_{{ $offer->id }}">{{ $offer->crypto_address }}</div>
                                    <button onclick="copyAddress({{ $offer->id }})">Copy Address</button>
                                </div>
                                <!-- Bouton pou mark ofri a kòm konplè -->
                    @unless($offer->completed)
                    <form id="completeOfferForm_{{ $offer->id }}" action="{{ route('offers.complete', $offer->id) }}" method="post" class="as-complete">
                        @csrf
                        <button type="button" onclick="completeOffer({{ $offer->id }})" class="bnd">Mark as Complete</button>
                    </form>
                @endunless
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

        </div>
        {{ $offers->links() }}

    @include('layouts.usermenu')
</x-app-layout>

<script>
    function copyAddress(offerId) {
    var cryptoAddress = document.getElementById("cryptoAddress_" + offerId);
    var textArea = document.createElement("textarea");
    textArea.value = cryptoAddress.innerText;
    document.body.appendChild(textArea);
    textArea.select();
    document.execCommand('copy');
    document.body.removeChild(textArea);
    alert("Address copied to clipboard!");
}


</script>

<script>
    function completeOffer(offerId) {
        var confirmation = confirm("Are you sure you want to mark this offer as complete?");
        
        if (confirmation) {
            document.getElementById('completeOfferForm_' + offerId).submit();
        }
    }
</script>

<style>
   

    /* Base styles */
    :root {
  --color1:#b6e7b7; 
  --color2:#c1f8bb; 
  --color3:#3ed516; 
  --color4:#2980b9; 
  --color5: #333; 
  --color6:#026308; 
  --color7:#99ffc1;
  --color8:#0a2cc8;
  --color9:#c8344d;
  --color10:#e41313;
}


.user-offer {
    margin: 20px;
}

h1 {
    font-size: 24px;
    margin-bottom: 10px;
    background-color: #c1f8bb;
}

.offers-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.offer-wrapper {
    width: calc(33.33% - 20px);
    margin-bottom: 20px;
}

.card {
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background-color: #d7f7de;
}

.card-header {
    background-color: #3ed516;
    padding: 10px;
    text-align: center;
}

.card-header h2 {
    margin: 0;
    font-size: 18px;
    color: #333;
}

.card-body {
    padding: 20px;
}

.card-body p {
    margin: 0;
    font-size: 16px;
    color: #555;
}

.instruction {
    margin-top: 10px;
    font-size: 14px;
    color: #777;
}

.amount {
    font-weight: bold;
    color: #3498db;
}

.crypto-address-container {
    margin-top: 10px;
}

.crypto-address {
    font-family: monospace;
    word-break: break-all;
    padding: 5px;
    background-color: #ecf0f1;
    border: 1px solid #bdc3c7;
    border-radius: 4px;
}

button {
    background-color: #3498db;
    color: #fff;
    padding: 8px 12px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #2980b9;
}

.as-complete {
    margin-top: 15px;
}

.bnd {
    background-color: #27ae60;
}

/* Media queries for responsiveness */

@media (max-width: 768px) {
    .offer-wrapper {
        width: calc(50% - 20px);
    }
}

@media (max-width: 576px) {
    .offer-wrapper {
        width: 100%;
    }
}
/* Default styles for larger screens */
.money {
    display: flex;
    
}

.balance {
    width: 250px;
    height: 250px;
    padding: 20px;
    border: 2px solid #333;
    border-radius: 8px;
    background-color: #ffffff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    box-sizing: border-box;
    position: relative;
}

.flag-icon {
    width: 50px;
    height: 50px;
    margin-left: -40%;
    border-radius: 50%;
}

.cardbox1 {
    display: flex;
    flex-direction: column; /* Adjust to a column layout */
    align-items: center;
    background: #fff;
    height: 100%;
}

.amount {
    font-size: 20px;
    margin-top: -30px;
    font-weight: bold;
}

.balance-text {
    margin: 10px 0;
    font-size: 16px;
    display: flex;
    align-items: center;
}

/* Additional styling for USD balance */
.balance.rounded {
    background-color: #fcfcfc;
    border-radius: 12px;
}

/* Additional styling for USD flag icon */
.balance.rounded .flag-icon {
    /* Add specific styles for the rounded balance */
}

.bott {
    margin-top: 110px;
    margin-left: -100px;
    font-size: 20px;
}

</style>