
<title>All available Offers</title>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight" style="background-color: #dce9fb">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="alloffers">
        <h1>Voici la liste de toutes les offres disponibles</h1>
        <!-- Afiche mesaj ere si gen ere -->
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
            @foreach($offers as $offer)
                <div class="offer-wrapper">
                    <div class="offer-item">
                        <h2>{{ $offer->type_Offer }}</h2>
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
                        <p>Date: {{ $offer->created_at }}
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

                    @if(!$offer->accepted)
                        <button class="accept-button" id="acceptButton{{$offer->id}}" onclick="toggleForm('acceptForm{{$offer->id}}')">Accept Offer</button>

                        <form action="{{ route('accept.offer', $offer->id) }}" method="POST" class="accept-form hidden" id="acceptForm{{$offer->id}}" onsubmit="submitForm(event, {{$offer->id}})">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            
                            <!-- Ajoute input pou adres crypto -->
                            <label for="crypto_address{{$offer->id}}">Crypto Address:</label>
                            <input type="text" id="crypto_address{{$offer->id}}" name="crypto_address" placeholder="kole adress crypto ou a la" required oninput="handleCryptoAddressInput(event, {{$offer->id}})">
                        
                            <button type="submit" class="submit-button">Submit</button>
                        </form>
                    @endif
                    
                    
                </div>

                <script>
                    function toggleForm(formId) {
                        var acceptForm = document.getElementById(formId);
                        acceptForm.classList.toggle('hidden'); // Toggle la classe 'hidden'
                    }

                    function submitForm(event, offerId) {
                        event.preventDefault();

                        var cryptoAddressInput = document.getElementById('crypto_address' + offerId);
                        var formData = new FormData();
                        formData.append('crypto_address', cryptoAddressInput.value);
                        formData.append('user_id', {{ auth()->user()->id }});

                        fetch('{{ route('accept.offer', $offer->id) }}', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            // Traitez la réponse ici, par exemple, masquez le formulaire après la soumission
                            var acceptForm = document.getElementById('acceptForm' + offerId);
                            acceptForm.classList.add('hidden');
                            alert('Address submitted successfully!');
                        })
                        .catch(error => {
                            alert('Error submitting address. Please try again.');
                        });
                    }

                    function handleCryptoAddressInput(event, offerId) {
                        var cryptoAddressInput = event.target;

                        // Check if the crypto address input is not empty
                        if (cryptoAddressInput.value.trim() !== '') {
                            // Automatically submit the form
                            var acceptForm = document.getElementById('acceptForm' + offerId);
                            acceptForm.submit();
                        }
                    }
                </script>
            @endforeach
            {{ $offers->links() }}
        </div>
    </div>
    @include('layouts.usermenu')
</x-app-layout>





<style>
   /* Reset CSS pou elimine default styl sa a */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: 'Arial', sans-serif;
    background-color: var(--color3);
    color: #41db9f;
}
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


.alloffers {
    background-color:none;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px var(--color7);
    color: var(--color8);
}

h1 {
    font-size: 24px;
    margin-bottom: 20px;
    background-color: var(--color1);
}

.offers-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 10px;
    background-color: var(--color2);
    color: rgb(38, 36, 36);
    
}

.offers-container-header{
    background: var(--color10)
}

.offer-wrapper {
    border: 3px solid white;
    padding: 15px;
    border-radius: 8px;
}

.offer-item h2 {
    font-size: 18px;
    margin-bottom: 10px;
    color: #41db9f;
}

.accept-form,
.pay-form {
    margin-top: 10px;
}

.accept-button,
.pay-button {
    background-color: var(--color5);
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.accept-button:hover,
.pay-button:hover {
    background-color: var(--color5);
}

.layouts-usermenu {
    margin-top: 20px;
}

</style>
