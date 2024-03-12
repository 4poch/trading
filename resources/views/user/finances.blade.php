
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

 <div class="master">  
<div class="wc">
    @if(Auth::check())
        <div class="dashboard-box">
            Welcome, {{ Auth::user()->name }}!
            <h2>Here is your finance dashboard</h2>
        </div>
    @endif
</div>

<div class="arletview">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
</div>  

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

<div class="btngroup">
    <div class="belbouton"><button type="button" class="btn btn-primary" id="depositBtn">Deposit</button></div>
    <div class="belbouton2"><button type="button" class="btn btn-danger" id="withdrawBtn">Withdraw</button></div>
    <button type="button" id="convertCurrencyButton" onclick="showCurrencyConverterForm()" class="convert">Convert</button>
    </div>


            <div class="cardbox2">
<div id="currencyConverterPopup" class="popup">
    <div class="popup-content">
        <span class="close" onclick="closeCurrencyConverterPopup()">&times;</span>
        <section class="money">
            <div class="balance">
                <div class="converter">
                     <div id="convertedAmount" style="background-color: #28a745;"></div>
                    <form id="currencyConverterForm" method="POST" action="{{ route('save-conversion') }}" onsubmit="return validateAmount()">
                        @csrf <!-- Ajoutez ceci pour protéger votre formulaire contre les attaques CSRF -->
                        <label for="currency1">Choose currency 1:</label>
                        <select name="currency1" id="currency1">
                            <option value="htg">HTG</option>
                            <option value="usd">USD</option>
                        </select>
                        <label for="currency2">Choose currency 2:</label>
                        <select name="currency2" id="currency2">
                            <option value="htg">HTG</option>
                            <option value="usd">USD</option>
                        </select>
                        <label for="amount">Enter amount:</label>
                        <input type="number" step="any" name="amount" id="amount" required>
                        <button type="button" onclick="convertCurrency()">Calculate</button>
                        <button type="submit">Convert</button>
                        
                    </form>
                    
                </div>
                
            </div>
        </section>
    </div>
</div>


<script>
    function showCurrencyConverterForm() {
    document.getElementById("currencyConverterPopup").style.display = "block";
}

function closeCurrencyConverterPopup() {
    document.getElementById("currencyConverterPopup").style.display = "none";
}


function convertCurrency() {
        var currency1 = document.getElementById("currency1").value;
        var currency2 = document.getElementById("currency2").value;
        var amount = parseFloat(document.getElementById("amount").value);
        var convertedAmount = 0;

        // Taux de conversion
        var usdToHtgRate = 130.904412; // 1 USD = 136.192950 HTG
        var htgToUsdRate = 0.007639; // 1 HTG = 0.007342 USD

        // Ensure different currencies are selected
        if (currency1 === currency2) {
            alert("Please choose different currencies for conversion.");
            return;
        }

        // Ensure valid conversion direction
        if ((currency1 === "usd" && currency2 === "htg") || (currency1 === "htg" && currency2 === "usd")) {
            if (currency1 === "usd") {
                // Conversion de USD en HTG
                convertedAmount = amount * usdToHtgRate;
            } else {
                // Conversion de HTG en USD
                convertedAmount = amount * htgToUsdRate;
            }

            // Mise à jour de l'affichage du montant converti
            document.getElementById("convertedAmount").innerText = "Converted Amount: " + convertedAmount.toFixed(2);
        } else {
            alert("Invalid conversion.");
            return;
        }
    }


</script>

{{-- sa se pati pou deposit la  --}}
        
<div id="depositForm" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: rgba(255, 255, 255, 0.9); padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2); z-index: 9999;">
    <form method="POST" action="{{ route('deposits.store') }}" enctype="multipart/form-data">
        <button type="button" id="closeBtn" class="btn btn-secondary">Fèmen</button>
        @csrf
        <div class="mb-3 automatic-form" style="display: none;">
            <label for="deposit_currency_auto">Currency</label>
            <select name="deposit_currency" id="deposit_currency_auto" class="form-control" required>
                <option value="HTG" selected>HTG</option>
            </select>
            <label for="payment_method_auto">Payment Method</label>
            <select name="payment_method" id="payment_method_auto" class="form-control" required>
                <option value="Moncash">Moncash</option>
                <option value="4poch">4poch</option>
            </select>
        </div>
        <div class="mb-3 manual-form" style="display: none;">
            <label for="deposit_currency_manual">Currency</label>
            <select name="deposit_currency" id="deposit_currency_manual" class="form-control" required>
                <option value="HTG" selected>HTG</option>
                <option value="USD">USD</option>
            </select>
            <label for="payment_method_manual">Payment Method</label>
            <select name="payment_method" id="payment_method_manual" class="form-control" required>
                <option value="cashapp">CashApp</option>
                <option value="paypal">PayPal</option>
                <option value="Moncash">Moncash</option>
                <option value="4poch">4poch</option>
                <option value="Natcash">Natcash</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="deposit_amount">Amount</label>
            <input type="number" name="deposit_amount" id="deposit_amount" class="form-control" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="deposit_type">Deposit Type</label>
            <select name="deposit_type" id="deposit_type" class="form-control" required>
                <option value="automatic" selected>Automatic</option>
                <option value="manual">Manual</option>
            </select>
        </div>
        <div id="manual-deposit" style="display: none;">
            <div class="mb-3">
                <label for="transaction_id">Transaction ID</label>
                <input type="text" name="transaction_id" id="transaction_id" class="form-control">
            </div>
            <div class="mb-3">
                <label for="proof_of_payment">Proof of Payment</label>
                <input type="file" name="proof_of_payment" id="proof_of_payment" class="form-control-file">
            </div>
            <div class="payment">
                <p> moncash_Number :36380706 </p>
                <p> paypal_email :youryjeanusa@gmail.com </p>
                <p> cashapp_tag :$youryjean </p>
                <p> natcash_Number :43876751 </p>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Deposit Now</button>
    </form>
</div>

<script>
    // Function to update payment method based on deposit type
    function updatePaymentMethod(depositType) {
        if (depositType === 'automatic') {
            document.getElementById('payment_method_auto').disabled = false;
            document.getElementById('payment_method_manual').disabled = true;
        } else {
            document.getElementById('payment_method_auto').disabled = true;
            document.getElementById('payment_method_manual').disabled = false;
        }
    }

    // Event listener for deposit type change
    document.getElementById('deposit_type').addEventListener('change', function() {
        var depositType = this.value;
        if (depositType === 'automatic') {
            document.querySelector('.automatic-form').style.display = 'block';
            document.querySelector('.manual-form').style.display = 'none';
        } else {
            document.querySelector('.automatic-form').style.display = 'none';
            document.querySelector('.manual-form').style.display = 'block';
        }
        // Update payment method when deposit type changes
        updatePaymentMethod(depositType);
    });

    // Event listener for payment method change in manual form
    document.getElementById('payment_method_manual').addEventListener('change', function() {
        document.getElementById('payment_method').value = this.value;
    });

    // Initialize form display and payment method
    document.querySelector('.automatic-form').style.display = 'block';
    document.querySelector('.manual-form').style.display = 'none';
    updatePaymentMethod('automatic'); // Set default payment method for automatic deposits

    // Function to close the popup
    function closePopup() {
        document.getElementById('depositForm').style.display = 'none';
    }

    // Event listener for close button click
    document.getElementById('closeBtn').addEventListener('click', function() {
        closePopup();
    });

</script>





<script>
    document.getElementById('depositBtn').addEventListener('click', function() {
        document.getElementById('depositForm').style.display = 'block';
    });
</script>

{{-- sa se pati pou retrea  --}}
                    
<div class="mb-3">

    <div id="withdrawForm" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: rgba(255, 255, 255, 0.9); padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2); z-index: 9999;">
        <form method="POST" action="{{ route('withdrawals.store') }}">
            <button id="closeWithdrawBtn" type="button" class="btn btn-secondary">Fèmen</button>
            @csrf
            <div class="mb-3">
                <label for="withdraw_amount">Amount</label>
                <input type="number" name="withdraw_amount" id="withdraw_amount" class="form-control" step="0.01" min="0.01" required>
            </div>
            <div class="mb-3">
                <label for="withdraw_currency">Currency</label>
                <select name="currency" id="withdraw_currency" class="form-control" required>
                    <option value="HTG">HTG</option>
                    <option value="USD">USD</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="withdraw_payment_method">Payment Method</label>
                <select name="withdrawal_method" id="withdraw_payment_method" class="form-control" required>
                    <option value="cashapp">CashApp</option>
                    <option value="paypal">PayPal</option>
                    <option value="zelle">Zelle</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="recipient_info">Recipient Information</label>
                <input type="text" name="recipient_info" id="recipient_info" class="form-control" required>
            </div>
            <button id="retre" type="submit" class="btn btn-danger">Withdraw Now</button>
            <!-- Bouton de fermeture -->
        </form>
    </div>
</div>


<script>
    document.getElementById('withdrawBtn').addEventListener('click', function() {
        document.getElementById('withdrawForm').style.display = 'block';
    });
    // Fonction pour fermer le popup
function closeWithdrawPopup() {
    document.getElementById('withdrawForm').style.display = 'none';
}

// Événement pour le clic sur le bouton de fermeture
document.getElementById('closeWithdrawBtn').addEventListener('click', function() {
    closeWithdrawPopup();
});

</script>   

</section>


<section class="history">
    <div class="alldepo">
    <h2>User Deposits</h2>
    <table>
        <thead>
            <tr>
                <th>Amount</th>
                <th>Currency</th>
                <th>Payment Method</th>
                <th>Deposit Type</th>
                <th>Transaction ID</th>
                <th>Status</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($userDeposits as $deposit)
            <tr>
                <td><span style="color: rgb(54, 227, 54); font-size: 20px;">+</span>{{ $deposit->amount }}</td>
                <td>{{ $deposit->currency }}</td>
                <td>{{ $deposit->payment_method }}</td>
                <td>{{ $deposit->deposit_type }}</td>
                <td>{{ $deposit->transaction_id }}</td>
                <td>{{ $deposit->status }}</td>
                <td>{{ $deposit->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="allwithdraws">
    <h2>Payout List</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Amount</th>
                <th>Currency</th>
                <th>Withdrawal Method</th>
                <th>Recipient Info</th>
                <th>Status</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($userWithdrawals as $withdrawal)
            <tr>
                <td><span style="color: rgb(230, 34, 34); font-size: 20px;">-</span>{{ $withdrawal->amount }}</td>
                <td>{{ $withdrawal->currency }}</td>
                <td>{{ $withdrawal->withdrawal_method }}</td>
                <td>{{ $withdrawal->recipient_info }}</td>
                <td>{{ $withdrawal->status }}</td>
                <td>{{ $withdrawal->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</section>

</div> 


@include('layouts.usermenu')
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    var depositType = document.getElementById('deposit_type');
    var manualDeposit = document.getElementById('manual-deposit');

    depositType.addEventListener('change', function() {
        if (depositType.value === 'manual') {
            manualDeposit.style.display = 'block';
        } else {
            manualDeposit.style.display = 'none';
        }
    });
});

</script>


<style>
    .convert {
    background-color: #4CAF50; /* Koulè fòn */
    color: white; /* Koulè tèks */
    padding: 14px 20px; /* Espasaj ant tèks la ak bord bouton an */
    margin: 8px 0; /* Espasaj anndan */
    border: none; /* Pa gen bordè */
    cursor: pointer; /* Kousòl pou montre li se yon elèman ki ka klike */
    border-radius: 4px; /* Bòtay yo gen bon fòm */
}

.convert:hover {
    background-color: #45a049; /* Chenn koulè lè kousòl la sou bouton an */
}

.convert:active {
    background-color: #3e8e41; /* Koulè bouton lè li pran yon klike */
}


.popup {
    display: none;
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.6);
}

.popup-content {
    background-color: #ffffff;
    margin: 10% auto;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.2);
    max-width: 400px;
    width: 90%;
    text-align: center;
    position: relative;
}

#closeBtn {
    background-color: #f91c1c8c;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 8px 16px;
    font-size: 16px;
    cursor: pointer;
}

#closeBtn:hover {
    background-color: #495057;
}


.popup-content h2 {
    color: #333;
    font-size: 24px;
    margin-bottom: 20px;
}

.popup-content label {
    display: block;
    margin-bottom: 10px;
}

.popup-content select, 
.popup-content input[type="number"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

.popup-content button {
    background-color: #4CAF50;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.popup-content button:hover {
    background-color: #45a049;
}
#convertedAmount {
    position: relative;
}


  /* CSS pou div .wc */
.wc {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* CSS pou div .dashboard-box */
.dashboard-box {
    background-color: #f0f0f0;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    margin-bottom: 20px;
    text-align: center;
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

/* Media query for smaller screens (mobile) */
@media screen and (max-width: 768px) {
   

    .bott {
        margin-top: 80px;
        margin-left: 0;
        font-size: 16px;
    }

    .amount{
        font-size: 20px;
   margin-top: 10px;
    font-weight: bold; 
 
       
    }

    .flag-icon {
    width: 60px;
    height: 60px;
    margin-left: -10%;
    border-radius: 50%;
    overflow: hidden;
}
.balance{
    width: 100%;
}
}

/* CSS pou div .mb-3 */
.mb-3 {
    margin-bottom: 20px;
}

/* CSS pou div .belbouton ak .belbouton2 */
.belbouton,
.belbouton2 {
    text-align: center;
}

/* CSS pou seksyon .history */
.history {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    margin-bottom: 20px;
}

/* CSS pou div .alldepo ak .allwithdraws */
.alldepo,
.allwithdraws {
    margin-bottom: 20px;
}

/* Kòd CSS pou div .alldepo ak .allwithdraws */
.alldepo,
.allwithdraws {
    margin-bottom: 20px;
    overflow-x: auto; /* Ajoute yon scrollbar orizontal si tab la depase lajè ekran an */
}

/* CSS pou tab */
table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: left;
    white-space: nowrap; /* Fè kontni yo pa tounen sou yon lòt liy si yo depase lajè tab la */
}

th {
    background-color: #f2f2f2;
}

/* CSS pou div span */
span {
    font-size: 20px;
    font-weight: bold;
}


/* CSS pou responsive */
@media only screen and (max-width: 768px) {
    .cardbox1,
    .cardbox2 {
        width: 100%;
    }
}


.master{
    background: #ffffffc3;
    height: 100%;
}/* Kòd CSS pou div .belbouton ak .belbouton2 */
.belbouton,
.belbouton2 {
    text-align: center;
}

/* Kòd CSS pou bouton yo */
.btn {
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

/* Kòd CSS pou bouton danger */
.btn-danger {
    background-color: #dc3545; /* Koulè dlo kay */
    color: #fff; /* Koulè tèks */
}

/* Kòd CSS pou bouton primary */
.btn-primary {
    background-color: #007bff; /* Koulè ble */
    color: #fff; /* Koulè tèks */
}

/* Kòd CSS pou efè hover sou bouton yo */
.btn:hover {
    opacity: 0.8;
}

.btngroup {
    display: grid;
    
    align-items: center;
}

.belbouton,
.belbouton2,
.convert {
    margin: 10px;
}

#depositForm {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: rgba(255, 255, 255, 0.9);
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    z-index: 9999;
    width: 90%;
    max-width: 400px;
}

#depositForm label {
    font-weight: bold;
}

#depositForm input[type="number"],
#depositForm input[type="text"],
#depositForm select {
    width: calc(100% - 20px); /* Kontwole siw lajè pou padding la an kalkile */
    padding: 10px;
    margin: 5px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

#depositForm button[type="submit"] {
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

#depositForm button[type="submit"]:hover {
    background-color: #0056b3;
}
 
/* Style du formulaire de retrait */
#withdrawForm {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: rgba(255, 255, 255, 0.9);
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    z-index: 9999;
    width: 300px; /* Largeur du formulaire */
}

/* Style des éléments du formulaire */
#withdrawForm label {
    display: block;
    margin-bottom: 5px;
    color: #333; /* Couleur du texte */
}

#withdrawForm input[type="number"],
#withdrawForm input[type="text"],
#withdrawForm select {
    width: 100%;
    padding: 8px;
    margin-bottom: 15px;
    border: 1px solid #ccc; /* Couleur de la bordure */
    border-radius: 5px;
    box-sizing: border-box;
}

/* Style du bouton de soumission */
#withdrawForm button {
    width: 100%;
    padding: 10px;
    background-color: #dc3545; /* Couleur de fond */
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

#withdrawForm button:hover {
    background-color: #c82333; /* Couleur de fond au survol */
}

#closeWithdrawBtn{
    max-width: 80px;
}
 
</style>

