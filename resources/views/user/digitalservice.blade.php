<title>Buy Services</title>
<style>
    /* Kòd CSS pou HTML ou a */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 0;
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
.x-app-layout {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.body {
    display: flex;
    justify-content: space-between;
}

.oksevis {
    width: 100%;
    background-color: transparent;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px var(--color8);
    left: 0;
    right: 0;
}

/* Styilize form la */
form {
    display: flex;
    flex-direction: column;
    background-color: var(--color2)
}

label {
    margin-top: 10px;
}

select, input, textarea {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    margin-bottom: 15px;
    box-sizing: border-box;
    border: 1px solid var(--color2);
    border-radius: 4px;
    
}

textarea {
    resize: vertical;
}

input[type="submit"] {
    background-color: var(--color8);
    color: rgb(24, 195, 92);
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: var(--color4);
}

.ssb{
    background-color: var(--color3);
    font-size: 12px;
}

/* Media query pou adapte ak telefòn */
@media only screen and (max-width: 600px) {
    .body {
        flex-direction: column;
    }

    .oksevis, .usermenu {
        width: 100%;
        margin-top: 20px;
    }
}

</style>

<title>masterservice</title>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
<div class="body">
<div class="oksevis">

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

    <form action="{{ route('nouvopro.storeData') }}" method="POST">
        @csrf

        <!-- Chwa pou sèvis -->
        <label for="service">Choos your service:</label>
        <select id="service" name="service" required class="ssb">
            <option value="Amazon">Amazon-Order</option>
            <option value="eBay">eBay-Order</option>
            <option value="Shein">Shein Order</option>
            <option value="Temu">Temu Order</option>
            <option value="Netflix">Netflix Payment</option>
            <option value="Disney">Disney+ Payment</option>
            <option value="Adsense">Adsense  Verified Account 150$-for-each</option>
            <option value="Website">Website Traffic 30$ for 1000 worldwid visitor</option>
            <option value="Other">Other Request</option>
        </select>
    
        <!-- Zòn pou enprime done -->
        <label for="websiteLink">Website Link:</label>
        <input type="text" id="websiteLink" name="website_link" required placeholder="add your link : https://monsite.com">
        
        <label for="websiteInfo">Website Account Info:</label>
        <input type="text" id="websiteInfo" name="websiteInfo" required placeholder="connexion if required">
    
        <label for="quantity">Unit:</label>
        <input type="number" id="quantity" name="quantity" required placeholder="Ex: 5 unit">
    
        <label for="estimateValue">Cost Estimate Value:</label>
        <input type="number" id="estimateValue" name="estimateValue" required placeholder="Ex: 100$">
    
        <label for="orderDescription">Describe your Oder :</label>
        <textarea id="orderDescription" name="orderDescription"></textarea required>
    
        <!-- Checkbox pou aksepte politik la -->
        <input type="checkbox" id="policyAccepted" name="policyAccepted" required>
        <label for="policyAccepted">policyAccepted.</label>
    
        <!-- Bouton soumèt -->
        <input type="submit" value="Submit your oder">
    </form>
    

</div>

@include('layouts.usermenu')
</x-app-layout>
    
</div>