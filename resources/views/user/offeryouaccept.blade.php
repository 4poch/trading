<title>Your Accepted Offers</title>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container">
        <h2 style="color: #63ca33;">Voici la liste des offres que vous avez acceptées</h2>
        
        @if(session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
        @endif
        
        <!-- Afiche mesaj reyisit si gen reyisit -->
        @if(session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
        @endif
        <div class="offers-container">
            @if($acceptedOffers->count() > 0)
                @foreach($acceptedOffers as $offer)
                    @if($offer->accepted)
                        <div class="offer-wrapper">
                            <div class="card">
                                <div class="card-header">
                                    <h2>{{ $offer->type_Offer }}</h2>
                                </div>
                                <div class="card-body">
                                    <p>Amount in USD: ${{ $offer->Amount }}</p>
                                    <p>Cost Value: HTG {{ $offer->Cost_value }}</p>
                                    <p>Date: {{ $offer->created_at }}</p>
                            
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
                                </div>
                                @if(!$offer->approved) <!-- Ajoute kondisyon sa a -->
                                <form action="{{ route('offers.approve', $offer->id) }}" method="post">
                                    @csrf
                                <div class="bttx">
                                    
                                        <button class="approve-button" id="approveButton{{ $offer->id }}" onclick="approveOffer({{ $offer->id }})">Approve</button>
                                
                                    
                                    {{-- <button id="approveButton{{ $offer->id }}" onclick="approveOffer({{ $offer->id }})">Approve</button> --}}
                                </div>
                                </form>
                            @endif
                            </div>
                            
                        </div>
                    @endif
                @endforeach
                {{ $acceptedOffers->links() }}
            @else
                <p id="bgg">No accepted offers found.</p>
            @endif
        </div>
    </div>
    @include('layouts.usermenu')
</x-app-layout>

<script>
    function approveOffer(offerId) {
        // Fè request pou apwouve ofri a atravè AJAX oswa redireksyon (ou chwazi)
        // Aprè sa, fè bouton an disparèt
        document.getElementById('approveButton').style.display = 'none';
    }
</script>


<style>
    /* General styling */

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

    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
    }

    .x-app-layout h2 {
        margin: 0;
    }

    /* Dashboard styling */
    .offers-container {
        margin-top: 20px;
    }

    .offer-wrapper {
        margin-bottom: 20px;
    }

    .card {
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        background-color: #edffee;
    }

    .card-header {
        background-color: #026308;
        color: #e41313;
        padding: 10px;
    }

    .card-body {
        padding: 15px;
    }

    .h2{
        font-size: 5px;
    }

    .bttx {
        text-align: center;
        margin-top: 10px;
        background: var(--color2);
    }

    /* Stylizasyon pou bouton "Approve" */
    .approve-button {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
    }

    .approve-button:hover {
        background-color: #45a049;
    }
    #bgg{
        background: var(--color2)
    }
</style>
