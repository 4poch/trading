<style>
    
/* Reset CSS */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    background-color: #f0f0f0;
}



/* Header Styling */
font-semibold {
    font-weight: 600;
}

.text-xl {
    font-size: 1.25rem;
}

.text-gray-800 {
    color: #333;
}

.dark:text-gray-200 {
    color: #ddd;
}

.leading-tight {
    line-height: 1.4;
}

/* Alert Styling */
.aletoderadmin {
    margin-top: 20px;
}

.alertadmin1 {
    background-color: #4CAF50;
    color: white;
    padding: 10px;
    border-radius: 8px;
}

/* Netflix Orders Styling */
.netflixadm {
    margin-top: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

table {
    width: 80%;
    border-collapse: collapse;
    margin-top: 20px;
    margin: 0 auto; /* Centre la table horizontalement */
}


th, td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

.no-user {
    color: #f00; /* Red color for no user */
}

/* Pagination Styling */
.pagination {
    margin-top: 20px;
}

/* Share Netflix Data Styling */
.sharenetflix {
    margin-top: 20px;
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    width: 80%;
    margin: auto;
}

h2 {
    font-size: 1.5rem;
    color: #333;
}

.snd {
    margin-top: 20px;
    display: flex;
    flex-direction: column;
}

label {
    margin-bottom: 5px;
}

input, select {
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

button {
    cursor: pointer;
    background-color: #3498db;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 4px;
}

/* Mobile Responsiveness */
@media only screen and (max-width: 768px) {
    .netflixadm, .sharenetflix {
        
    }

    table {
        font-size: 14px;
    }

    .buy-now-button {
        margin-top: 10px;
        width: 100%;
    }
}


</style>


<head>
    <link rel="stylesheet" href="{{ asset('cssfile/user.css') }}">
</head>

    

    

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="aletoderadmin">
        @if (session('success'))
            <div class="alertadmin1">
                {{ session('success') }}
            </div>
        @endif

    </div>
<div class="netflixadm">
<h1>Netflix Orders</h1>
<table>
    <thead>
        <tr>
            <th>Plan ID </th>
            <th>User ID</th>
            <th>Subscription Type</th>
            <th>Status</th>
            <th>User Name</th>
            <th>Action</th> <!-- Nou ajoute kolòn Action pou bouton yo -->
        </tr>
    </thead>
    <tbody>
        @foreach($subscriptions as $subscription)
            <tr>
                <td>{{ $subscription->id }}</td>
                <td>{{ $subscription->user_id }}</td>
                <td>{{ $subscription->subscription_type }}</td>
                <td>{{ $subscription->status }}</td>
                <td class="{{ $subscription->user ? '' : 'no-user' }}">
                    @if ($subscription->user)
                        {{ $subscription->user->name }}
                    @else
                        Kèk mesaj pou itilizatè pa jwenn
                    @endif
                </td>
                <td>
                    <form action="{{ route('subscription.update', $subscription->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <select name="status">
                            <option value="pending" {{ $subscription->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="success" {{ $subscription->status == 'success' ? 'selected' : '' }}>Success</option>
                            <option value="rejected" {{ $subscription->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                        <button type="submit">Update</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="pagination">
    {{ $subscriptions->links() }}
</div>
</div>

<div class="sharenetflix">
    <h2>share Netflix data</h2>

    <form class="snd" action="{{ route('send.data') }}" method="post">
        @csrf

        <label for="userId">User ID:</label>
        <input type="text" id="userId" name="userId" required>

        <label for="netflixLogin">Netflix Login:</label>
        <input type="text" id="netflixLogin" name="netflixLogin" required>

        <label for="netflixPasscode">Netflix Passcode:</label>
        <input type="text" id="netflixPasscode" name="netflixPasscode" required>

        <label for="startDate">Start Date:</label>
        <input type="date" id="startDate" name="startDate" required>

        <label for="endDate">End Date:</label>
        <input type="date" id="endDate" name="endDate" required>

        <label for="action">Action:</label>
        <select id="action" name="action" required>
            <option value="enable">Enable</option>
            <option value="delete">Delete</option>
        </select>

        <button type="submit">Send Data</button>
    </form>
</div>


@include('layouts.adminmenu')
</x-app-layout>
