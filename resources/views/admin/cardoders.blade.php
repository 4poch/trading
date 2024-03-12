
    <title>Card Orders</title>
    <style>
      /* Stilizasyon pou tab */
table {
  width: 100%;
  border-collapse: collapse;
}

table, th, td {
  border: 1px solid black;
  
}

th, td {
  padding: 8px;
  text-align: left;
  background: #c0d7c1;
}

/* Estilizasyon pou bouton */
button {
  background-color: #4CAF50;
  color: white;
  padding: 10px 20px;
  border: none;
  cursor: pointer;
  border-radius: 4px;
}

button:hover {
  background-color: #45a049;
}

/* Estilizasyon pou form input */
input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

/* Estilizasyon pou select */
select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

/* Estilizasyon pou form input lè sourit pase l 'sou yo */
input[type=text]:focus {
  border: 3px solid #555;
}
/* Responsivite pou tab sou mobil */
@media screen and (max-width: 600px) {
  table {
    width: 100%;
  }

  th, td {
    display: block;
  }

  th {
    text-align: center;
  }
}

    </style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <h2>Update Card Information</h2>
<form action="{{ route('update-card') }}" method="POST">
    @csrf
    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>User Email</th>
                <th>User Name</th>
                <th>Card Type</th>
                <th>Amount</th>
                <th>Created At</th>
                <th>Card Number</th>
                <th>Expiration Date</th>
                <th>CVV</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cardOrders as $cardOrder)
            <tr>
                <td>{{ $cardOrder->user_id }}</td>
                <td>{{ $cardOrder->user_email }}</td>
                <td>{{ $cardOrder->user_name }}</td>
                <td>{{ $cardOrder->card }}</td>
                <td>${{ $cardOrder->amount }}</td>
                <td>{{ $cardOrder->created_at }}</td>
                <td>
                    <form action="{{ route('update-card') }}" method="POST">
                        @csrf
                        <input type="hidden" name="card_id" value="{{ $cardOrder->id }}">
                        <input type="text" name="card_number" value="{{ $cardOrder->card_number }}" placeholder="Enter card number" required>
                </td>
                <td>
                    <input type="text" name="expiration_date" value="{{ $cardOrder->expiration_date }}" placeholder="Enter expiration date" required>
                </td>
                <td>
                    <input type="text" name="cvv" value="{{ $cardOrder->cvv }}" placeholder="Enter CVV" required>
                </td>
                <td>
                    <select name="status">
                        <option value="pending" {{ $cardOrder->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="rejected" {{ $cardOrder->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        <option value="complete" {{ $cardOrder->status == 'complete' ? 'selected' : '' }}>Complete</option>
                    </select>
                </td>
                <td>
                    <button type="submit">Update</button>
                </td>
                </form>
            </tr>
            @endforeach
        </tbody>
    </table>
    
</form>

@include('layouts.adminmenu')
    
</x-app-layout>
