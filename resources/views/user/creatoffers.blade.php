<title>Creat Offers</title>
<style>
    /* General Styles */
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
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

/* Layout Styles */
.x-app-layout {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

/* Header Styles */
.x-slot[name="header"] {
    text-align: center;
    margin-bottom: 20px;
}

/* Offer Section Styles */
.offer1 {
    text-align: center;
    padding: 20px;
}

/* Form Styles */
form {
    display: flex;
    flex-direction: column;
    align-items: center;
}

label {
    margin-top: 10px;
}

input, select {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
}

.checkbox-container {
    display: flex;
    align-items: center;
}

#policy_agreement {
    margin-right: 5px;
}

/* Submit Button Styles */
input[type="submit"] {
    background-color: #4caf50;
    color: white;
    padding: 10px;
    border: none;
    cursor: pointer;
}

#bgg{
    background: var(--color2);
}
/* User Menu Styles */
/* Add additional styles for the user menu if needed */

/* Media Query for Mobile Devices */
@media only screen and (max-width: 600px) {
    .x-app-layout {
        padding: 10px;
    }

    .offer1 {
        padding: 10px;
    }
}

</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="offer1">
        <p id="bgg">Sell Your crypto</p>
        <div class="gift-icon">
        <i class="fa fa-gift"></i>
        </div>
        <form action="{{ route('offers.store') }}" method="post">
            @csrf
            <label for="type_Offer" id="bgg">Type Offer:</label>
            <select id="type_Offer" name="type_Offer">
                <option value="USDT">USDT</option>
                <option value="BTC">BTC</option>
                <option value="LTC">LTC</option>
                <option value="TRX">TRX</option>
                <option value="BNB">BNB Smart Chain</option>
                <!-- Ajoute plis tip ofri -->
            </select><br>
            <input type="hidden" id="user_id" name="user_id" value="user_id">

            <label for="amount" id="bgg">Amount in USD:</label>
            <input type="number" id="amount" name="Amount" required><br>
            
            <label for="Cost_value" id="bgg">Cost You ask in HTG:</label>
            <input type="number" id="Cost_value" name="Cost_value" required><br>
            
            
            <input type="checkbox" id="policy_agreement" name="policy_agreement" required>
            <label for="policy_agreement" id="bgg">I agree to the policy of this website</label><br>
            
            <input type="submit" value="Create Offer">
        </form>
    </div>

</div>
@include('layouts.usermenu')
</x-app-layout>