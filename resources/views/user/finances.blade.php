<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
<div class="wc">
    @if(Auth::check())
        <div class="dashboard-box">
            Welcome, {{ Auth::user()->name }}!
            <h2>Here is your finance dashboard</h2>
        </div>
    @endif
</div>

    

    
<section class="money">
    <div class="balance">
        <div class="cardbox1">
            <p>HTG Balance: {{ $balance->htg_balance ?? 0.00 }} G</p>
        </div>
        <div class="cardbox2">
            <p>USD Balance: {{ $balance->usd_balance ?? 0.00 }} $</p>
        </div>
    </div>
</section>

        


<div class="mb-3">
    <div class="belbouton"><button type="button" class="btn btn-primary" id="depositBtn">Deposit</button></div>
    <div id="depositForm" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: rgba(255, 255, 255, 0.9); padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2); z-index: 9999;">
        <form method="POST" action="{{ route('deposits.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="deposit_amount">Amount</label>
                <input type="number" name="deposit_amount" id="deposit_amount" class="form-control" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="deposit_currency">Currency</label>
                <select name="deposit_currency" id="deposit_currency" class="form-control" required>
                    <option value="HTG">HTG</option>
                    <option value="USD">USD</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="payment_method">Payment Method</label>
                <select name="payment_method" id="payment_method" class="form-control" required>
                    <option value="cashapp">CashApp</option>
                    <option value="paypal">PayPal</option>
                    <option value="zelle">Zelle</option>
                    <option value="Moncash">Moncash</option>
                    <option value="4poch">4poch</option>
                    <option value="Natcash">Natcash</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="deposit_type">Deposit Type</label>
                <select name="deposit_type" id="deposit_type" class="form-control" required>
                    <option value="automatic">Automatic</option>
                    <option value="manual" selected>Manual</option>
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
            </div>
            <button type="submit" class="btn btn-primary">Deposit Now</button>
        </form>
    </div>
</div>

<script>
    document.getElementById('depositBtn').addEventListener('click', function() {
        document.getElementById('depositForm').style.display = 'block';
    });
</script>
                    
<div class="mb-3">
   <div class="belbouton2"><button type="button" class="btn btn-danger" id="withdrawBtn">Withdraw</button></div>
    <div id="withdrawForm" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: rgba(255, 255, 255, 0.9); padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2); z-index: 9999;">
        <form method="POST" action="{{ route('withdrawals.store') }}">
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
        </form>
    </div>
</div>

<script>
    document.getElementById('withdrawBtn').addEventListener('click', function() {
        document.getElementById('withdrawForm').style.display = 'block';
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
   
/* Estil pou div la */
.wc {
    background-color: #f4f4f4; /* Koulè fon div la */
    border-radius: 30px; /* Rond bòt la kòm sa li pa gen angle kant */
    box-shadow: 0 4px 6px rgba(167, 229, 193, 0.1); /* Ombraj pou bay yon efè tridimansyon */
    padding: 15px; /* Espasaj pou kontni div la */
    max-width: 80%; /* Lajè maksimòm div la */
    height: 200px;
    margin: 0 auto; /* Pòzisyon div la nan mitan paj la */
    background: transparent;
}

/* Estil pou tèks lè yon itilizatè konekte */
.dashboard-box {
    background-color: #ffffff; /* Koulè fon bòt la */
    padding: 20px; /* Espasaj pou kontni bòt la */
    border-radius: 8px; /* Rond bòt la kòm sa li pa gen angle kant */
    max-width: 100%;
}

/* Estil pou non itilizatè a */
.dashboard-box h2 {
    color: #333; /* Koulè tèks la */
    font-size: 24px; /* Dimansyon tèks la */
    margin-bottom: 10px; /* Espas anba tèks la */
}

/* Estil pou mesaj bonjou */
.dashboard-box p {
    color: #666; /* Koulè tèks la */
    font-size: 16px; /* Dimansyon tèks la */
}


.money {
    background-color: #24b82b;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

.money .balance {
    display: flex;
    justify-content: space-between;
}

.money .balance .cardbox1,
.money .balance .cardbox2 {
    background-color: #cf3232;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
}

.money .balance .cardbox1 p,
.money .balance .cardbox2 p {
    margin: 0;
    font-size: 16px;
    color: #333;
}
/* css pou form deposit  la  */
.belbouton {
    /* Stil div la isit la */
    /* Egzanp: */
    background-color: #f0f0f0;
    padding: 10px;
    border-radius: 5px;
}

.belbouton button {
    /* Stil bouton an isit la */
    /* Egzanp: */
    color: white;
    background-color: blue;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
}

/* Stil bouton an lè li ap fè klik */
.belbouton button:hover {
    background-color: darkblue;
}


/* Estilize div la */
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
    width: 300px; /* Ou ka chanje lajè div la selon bezwen ou */
}

/* Estilize bouton "Deposit" */
#depositBtn {
    margin-bottom: 15px; /* Espas anba bouton "Deposit" la */
}

/* Estilize bouton "Deposit Now" nan fòm nan */
#depositForm .btn-primary {
    width: 100%; /* Fòse bouton an gen lajè 100% */
    margin-top: 15px; /* Espas anwo bouton "Deposit Now" la */
    background: #24b82b;
}

/* Estilize div ak select yo nan fòm nan */
#depositForm .mb-3 {
    margin-bottom: 15px; /* Espas ant chak div mb-3 */
}

/* Estilize bouton "Close" */
#depositForm .close {
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
    background: none;
    border: none;
    padding: 0;
    font-size: 1.5rem;
    color: #333;
    outline: none;
}
/*  scs pou pati withdraw la  */
.belbouton2 {
    /* Stil div la isit la */
    /* Egzanp: */
    padding: 10px;
    border-radius: 5px;
    float: right;
    margin-top: -80px;
}

.belbouton2 button {
    /* Stil bouton an isit la */
    /* Egzanp: */
    color: white;
    background-color: red;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
}

/* Stil bouton an lè li ap fè klik */
.belbouton2 button:hover {
    background-color: darkred;
}

#retre {
    background-color: #dc3545; /* Couleur de fond */
    color: #fff; /* Couleur du texte */
    border: none; /* Supprimer les bordures */
    border-radius: 5px; /* Arrondir les coins */
    padding: 10px 20px; /* Ajouter un padding */
    font-size: 16px; /* Taille de la police */
    cursor: pointer; /* Curseur pointer */
    transition: background-color 0.3s ease; /* Transition fluide pour le changement de couleur de fond */
}

#retre:hover {
    background-color: #c82333; /* Couleur de fond au survol */
}


.history {
    overflow: hidden; /* Pour éviter que les éléments flottants dépassent */
}

.alldepo,
.allwithdraws {
    float: left;
    width: 50%;
    box-sizing: border-box; /* Pour inclure les bordures et le padding dans la largeur spécifiée */
    padding: 10px; /* Ajoutez un espace autour du contenu */
}

.allwithdraws {
    float: right;
}

/* Style pour la première table (User Deposits) */
.alldepo table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px; /* Espacement entre les tables */
}

.alldepo th {
    background-color: #48d720; /* Couleur d'arrière-plan de l'en-tête */
    border: 1px solid #dddddd;
    padding: 8px;
    text-align: left;
}

.alldepo tr:nth-child(odd) {
    background-color: #f9f9f9; /* Couleur d'arrière-plan pour les lignes impaires */
}

.alldepo td {
    border: 1px solid #ddd;
    padding: 8px;
}

/* Style pour la deuxième table (Payout List) */
.allwithdraws table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px; /* Espacement entre les tables */
}

.allwithdraws th {
    background-color: #c91e1e; /* Couleur d'arrière-plan de l'en-tête */
    border: 1px solid #bbb;
    padding: 8px;
    text-align: left;
}

.allwithdraws tr:nth-child(odd) {
    background-color: #e8e8e8; /* Couleur d'arrière-plan pour les lignes impaires */
}

.allwithdraws td {
    border: 1px solid #bbb;
    padding: 8px;
}
/* Media query pour les petits écrans (par exemple, les appareils mobiles) */
@media screen and (max-width: 768px) {
    /* Réinitialiser la largeur des tables et activer le défilement horizontal si nécessaire */
    .alldepo table,
    .allwithdraws table {
        width: 100%;
        overflow-x: auto;
    }

    /* Annuler le flottement et réinitialiser la largeur et le padding */
    .alldepo,
    .allwithdraws {
        float: none;
        width: auto;
        padding: 0;
    }

    /* Annuler les flottements précédents */
    .alldepo {
        clear: both;
    }

    /* Ajouter un espacement entre les tables */
    .allwithdraws {
        margin-top: 20px;
    }
}

</style>