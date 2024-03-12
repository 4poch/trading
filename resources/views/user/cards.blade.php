<style>
     /* CSS for Visa Card */
.visa-card-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

.visa-card {
    width: 90%; /* Responsive width */
    max-width: 350px; /* Max width for larger screens */
    height: 220px; /* Fixed height */
    background-color: #f0f0f0; /* Default background color */
    border-radius: 10px;
    margin: 10px;
    padding: 20px;
    position: relative; /* Positioning for logo */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.visa-card img.logo {
    width: 60px; /* Adjust size as needed */
    height: 40px; /* Adjust size as needed */
    position: absolute;
    top: 10px; /* Adjust position as needed */
    right: 10px; /* Adjust position as needed */
}

.visa-card img {
    width: 40px;
    height: 40px;
    margin-bottom: 10px;
}

.card-details {
    display: flex;
    justify-content: space-between;
}

.card-details > div {
    flex: 1;
}

.card-number {
    font-size: 16px; /* Adjustable font size */
    text-align: center; /* Centering card number */
}

.expiration-date,
.cvv {
    font-size: 12px;
}

.paginet {
    margin-top: 20px;
}

</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <h1>All Cards</h1>
<div class="container visa-card-container">
    @foreach ($cards as $card)
        <div class="visa-card">
            <img src="img/chip.png" alt="Chip Icon" class="chip">
            <img src="img/nfc.png" alt="Signal Icon" class="signal-icon">
            <img src="img/4poch.png" alt="Visa Logo" class="logo">
            <div class="card-number">{{ $card->card_number }}</div>
            <div class="user-name">{{ $card->user_name }}</div>
            <div class="card-details">
                <div class="expiration-date">{{ $card->expiration_date }}</div>
                <div class="cvv">CVV: {{ $card->cvv }}</div>
            </div>
            <div class="amount">Amount: {{ $card->amount }}</div>
            <div class="status">Status: {{ $card->status }}</div>
        </div>
    @endforeach
</div>

<!-- Pagination Links -->
<div class="paginet">
    <!-- Pagination Links -->
    {{ $cards->links() }}
</div>


@include('layouts.usermenu')
</x-app-layout>

<script>
    // JavaScript for generating random background color
function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

// Apply random background color to each card
document.addEventListener('DOMContentLoaded', function() {
    var cards = document.querySelectorAll('.visa-card');
    cards.forEach(function(card) {
        card.style.backgroundColor = getRandomColor();
    });
});

</script>