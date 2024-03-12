

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif


    <div class="container">
        <h2>Choose Your Prepaid Card and Deposit Amount</h2>
        <form action="{{ route('store-card') }}" method="post">
            @csrf

            <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" id="user_email" name="user_email" value="{{ Auth::user()->email }}">
            <input type="hidden" id="user_name" name="user_name" value="{{ Auth::user()->name }}">
            

            <label for="card">Choose Card:</label>
            <select name="card" id="card" onchange="showDescription()">
                <option value="visa_usd_gold" data-description=" This card is Best Facebook,Shein, Amazon Alibaba">Visa USD Gold</option>
                <option value="visa_usd_Premium" data-description="Great for online purchases and work good for Usa ">Visa USD Premium</option>
                <option value="mastercard_usd_Vip" data-description="Perfect for exclusive events and VIP work good">Mastercard USD Vip</option>
                <option value="mastercard_eur_Super" data-description="Ideal for everyday expenses and Good for ecommerce">Mastercard Euro Super</option>
            </select><br><br>
            
            <label for="amount">Enter Deposit Amount ($5 - $1000):</label>
            <input type="number" id="amount" name="amount" min="5" max="1000"><br><br>

            <div id="description"></div>

            <div id="totalAmountSection" style="display: none;">
                <h2>Total Amount</h2>
                <p id="totalAmount"></p>
            </div>
            
            <input type="button" value="Calculate Price" onclick="calculateTotal()">
            <input type="submit" value="Buy Card">
        </form>
    </div>

    <script>
        var feeData = {
            "visa_usd_gold": {"fixed": 1, "percentage": 10},
            "visa_usd_Premium": {"fixed": 1, "percentage": 10},
            "mastercard_usd_Vip": {"fixed": 1, "percentage": 10},
            "mastercard_eur_Super": {"fixed": 1, "percentage": 10}
        };

        function showDescription() {
            var cardSelect = document.getElementById('card');
            var descriptionDiv = document.getElementById('description');
            var selectedOption = cardSelect.options[cardSelect.selectedIndex];
            var description = selectedOption.getAttribute('data-description');
            descriptionDiv.innerHTML = description;
        }

        function calculateTotal() {
            var amount = parseFloat(document.getElementById('amount').value);
            var card = document.getElementById('card').value;
            var feeInfo = feeData[card];
            var fixedFee = feeInfo.fixed;
            var percentageFee = feeInfo.percentage;
            var fee = fixedFee + (amount * (percentageFee / 100));
            var totalAmount = amount + fee;
            document.getElementById('totalAmount').innerHTML = "Total Amount (including fee): $" + totalAmount.toFixed(2);
            document.getElementById('totalAmountSection').style.display = 'block';
        }
    </script>
@include('layouts.usermenu')
</x-app-layout>
<style>
 

.container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

form {
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    font-weight: bold;
}

input[type="number"],
select {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

input[type="button"],
input[type="submit"] {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
}

input[type="button"]:hover,
input[type="submit"]:hover {
    background-color: #0056b3;
}

#totalAmountSection {
    margin-top: 20px;
}

@media screen and (max-width: 600px) {
    .container {
        max-width: 100%;
        padding: 10px;
    }
}

</style>