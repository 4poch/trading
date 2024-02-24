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
    <title>Withdrawal Requests</title>

    <h1>Withdrawal Requests</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Amount</th>
                <th>Currency</th>
                <th>Withdrawal Method</th>
                <th>Recipient Info</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Action</th> <!-- Ajout de la colonne Action -->
            </tr>
        </thead>
        <tbody>
            @foreach ($withdrawals as $withdrawal)
            <tr>
                <td>{{ $withdrawal->id }}</td>
                <td>{{ $withdrawal->user_id }}</td>
                <td>{{ $withdrawal->amount }}</td>
                <td>{{ $withdrawal->currency }}</td>
                <td>{{ $withdrawal->withdrawal_method }}</td>
                <td>{{ $withdrawal->recipient_info }}</td>
                <td>{{ $withdrawal->status }}</td>
                <td>{{ $withdrawal->created_at }}</td>
                <td>
                    <form action="{{ route('withdrawals.update-status', $withdrawal->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <select name="status">
                            <option value="pending" {{ $withdrawal->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ $withdrawal->status == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ $withdrawal->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                        <button type="submit">Update</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @include('layouts.adminmenu') <!-- menu ki sou bo goch-->
</x-app-layout>

<style>
    /* Style pour le titre */
h1 {
    font-size: 24px;
    margin-bottom: 20px;
}

/* Style pour le tableau */
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

/* Style pour les cellules de l'en-tête */
th {
    background-color: #f2f2f2;
    border: 1px solid #ddd;
    padding: 12px;
    text-align: left;
}

/* Style pour les cellules des données */
td {
    border: 1px solid #ddd;
    padding: 12px;
}

/* Style pour les lignes impaires */
tr:nth-child(even) {
    background-color: #f9f9f9;
}

/* Style pour les options du select */
select {
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

/* Style pour le bouton de mise à jour */
button[type="submit"] {
    padding: 8px 12px;
    background-color: #4caf50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #45a049;
}

</style>