<body class="xbr">
    <x-app-layout> <!-- pati antet page la  -->
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>
    <div class="myfok">
        <!-- Affichage du message de succès -->
        <div>
        @if(session('success'))
        <div class="alertxb">
            {{ session('success') }}
        </div>
    @endif
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>User Email</th>
            <th>Amount</th>
            <th>Currency</th>
            <th>Payment Method</th>
            <th>Deposit Type</th>
            <th>Transaction ID</th>
            <th>Proof of Payment</th>
            <th>status</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Actions</th> <!-- Kolòn pou bouton yo -->
        </tr>
    </thead>
    <tbody>
        @foreach ($deposits as $deposit)
            <tr>
                <td>{{ $deposit->id }}</td>
                <td>{{ $deposit->user_id }}</td>
                <td>{{ $deposit->user->email }}</td>
                <td>{{ $deposit->amount }}</td>
                <td>{{ $deposit->currency }}</td>
                <td>{{ $deposit->payment_method }}</td>
                <td>{{ $deposit->deposit_type }}</td>
                <td>{{ $deposit->transaction_id }}</td>
                <td><a href="{{ asset('payment_proof/' . $deposit->proof_of_payment) }}" target="_blank">{{ $deposit->proof_of_payment }}</a></td>
                <td>{{ $deposit->status }}</td>
                <td>{{ $deposit->created_at }}</td>
                <td>{{ $deposit->updated_at }}</td>
                <td>
                
                        <form id="changeStatusForm{{ $deposit->id }}" action="{{ route('admin.completeDeposit') }}" method="POST">
                            @csrf
                            <input type="hidden" name="deposit_id" value="{{ $deposit->id }}">
                            <select name="status" onchange="document.getElementById('changeStatusForm{{ $deposit->id }}').submit()">
                                <option value="pending" @if($deposit->status == 'pending') selected @endif>Pending</option>
                                <option value="complete" @if($deposit->status == 'complete') selected @endif>Complete</option>
                                <option value="rejected" @if($deposit->status == 'rejected') selected @endif>Rejected</option>
                            </select>
                        </form>

                    
                    
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@include('layouts.adminmenu') <!-- menu ki sou bo goch-->
</x-app-layout>

<style>
    table {
    font-family: Arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

thead th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #4CAF50;
    color: white;
}

tbody td, tbody th {
    border: 1px solid #ddd;
    padding: 8px;
}

tbody tr:nth-child(even) {
    background-color: #f2f2f2;
}

tbody tr:hover {
    background-color: #ddd;
}

select {
    padding: 5px;
    border-radius: 4px;
}

select:focus {
    outline: none;
}

</style>