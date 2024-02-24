<title>Netflix Plan</title>
<style>
/* Default styles for your form */
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
.body {
    max-width: 800px;
    margin: 0 auto;
}

.arletview {
    margin-bottom: 20px;
}

.nflix {
    text-align: center;
}

form {
    max-width: 400px;
    margin: 0 auto;
    overflow: hidden; /* Add overflow: hidden to the form container */
}

.try {
    font-size: 1.5em;
    margin-bottom: 15px;
}

.form-group {
    margin-bottom: 20px;
}

.opc {
    background-color: var(--color1);
    font-size: 11px;
    color: rgb(203, 23, 23); /* Add text color for better visibility */
    padding: 5px 5px;
    border: none;
    cursor: pointer;
    border-radius: 5px; /* Add border-radius for rounded corners */
    font-family: Georgia, 'Times New Roman', Times, serif;
}

/* Style for success alert */
.alert-success {
    background-color: #dff0d8;
    border: 1px solid #3c763d;
    color: #3c763d;
    padding: 15px;
    margin-bottom: 20px;
}

/* Modern button styles with default background color */
.btt {
    color: rgb(208, 24, 24); /* White text color */
    padding: 12px 20px; /* Padding for better spacing */
    border: 1px solid var(--color3); /* Add border and set border color */
    border-radius: 5px; /* Add border-radius for rounded corners */
    font-size: 16px;
    background-color: var(--color8) !important; /* Set your desired default background color */
}

/* Hover effect for the button */
.btt:hover {
    background-color: var(--color7) !important; /* Darker green on hover */
}


/* Responsive styles for different screen sizes */
@media only screen and (max-width: 768px) {
    .body {
        max-width: 100%;
    }

    form {
        max-width: 100%;
    }

    .opc {
    background-color: rgb(245, 245, 245);
    font-size: 11px;
    color: rgb(203, 23, 23); /* Add text color for better visibility */
    padding: 5px 5px;
    border: none;
    cursor: pointer;
    border-radius: 5px; /* Add border-radius for rounded corners */
    font-family: Georgia, 'Times New Roman', Times, serif;
}
}

/* Styles for smaller screens like iPhone 5 */
@media only screen and (max-width: 320px) {
    .try {
        font-size: 1.2em;
    }

    form {
        max-width: 90%;
    }

    /* Limit the width of the select element on smaller screens */
    #subscription {
        width: 100%;
    }

    .opc {
    background-color: rgb(245, 245, 245);
    font-size: 11px;
    color: rgb(203, 23, 23); /* Add text color for better visibility */
    padding: 5px 5px;
    border: none;
    cursor: pointer;
    border-radius: 5px; /* Add border-radius for rounded corners */
    font-family: Georgia, 'Times New Roman', Times, serif;
}
}

#bgg{
    background: var(--color2)
}

</style>







<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
<div class="body">
    <div class="arletview">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}

            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        </div>
    @endif
    </div>
    <div class="nflix">
        <form method="POST" action="{{ route('subscription.submit') }}">
            @csrf <!-- Antifòm ki pa alògan Cross-Site Request Forgery -->
            <p class="try" id="bgg">Netflix Subscription Sharing</p>
            <div class="form-group">
                <label for="subscription" id="bgg">Chwazi Abònman:</label>
                <select class="form-control" name="subscription" id="subscription">
                    <option value="Gold" class="opc">Plan 1 - Gold 1 Mwa (400 HTG)</option>
                    <option value="Premium"  class="opc">Plan 2 - Premium 2 Mwa (700 HTG)</option>
                    <option value="Vip"  class="opc">Plan 3 - VIP 3 Mwa (1000 HTG)</option>
                </select>
            </div>
            <button type="submit" class="btt" id="xbd">Subscribe</button>
        </form>
    </div>
    

</div>
    @include('layouts.usermenu')
</x-app-layout>