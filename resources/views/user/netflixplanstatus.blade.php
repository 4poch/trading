<title>Netflix History</title>
<style>
    /* General Styles */
body {
    font-family: Arial, sans-serif;
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
/* Layout Styles */
.x-app-layout {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

/* Header Styles */
.x-slot[name="header"] {
    text-align: center;
    margin-bottom: 20px;
}

/* Plan Status Styles */
.planstatus {
    text-align: center;
}

/* Table Styles */
.tables {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.tables th, .tables td {
    padding: 12px;
    text-align: left;
    border-bottom: none solid var(--color5);
}

/* Color Styles for Table */
.tables th {
    background-color: var(--color7); /* Header background color */
}

.tables td {
    background-color: var(--color1); /* Row background color */
}

/* Pagination Styles */
.pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

h1{
    background: var(--color1)
}
</style>

@include('layouts.usermenu')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

<div class="planstatus">
    <h1>Your Subscriptions Sharing </h1>

    <table class="tables">
        <thead>
            <tr>
                <th>User</th>
                <th>Subscription Type</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($userSubscriptions as $subscription)
                <tr>
                    <td>{{ $subscription->user->name }}</td>
                    <td>{{ $subscription->subscription_type }}</td>
                    <td>{{ $subscription->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $userSubscriptions->links() }}
</div>


</x-app-layout>