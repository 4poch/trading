<title>Marketing History</title>
<style>
  /* General Styles */

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    color: #333;
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

.container {
    width: 95%;
    margin: 2% auto;
}

h1 {
    color: var(--color4);
    text-align: center;
    margin-top: 2%;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table, th, td {
    border: none solid var(--color10);
}

th, td {
    padding: 15px;
    text-align: left;
}

thead {
    background-color: var(--color3);
    color: #ecf0f1;
}

tbody tr:nth-child(even) {
    background-color: var(--color10);
}
.td{
    background: var(--color10);
}

p {
    text-align: center;
    margin-top: 20px;
}

.pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.pagination ul {
    list-style: none;
    display: flex;
    gap: 10px;
}

.pagination ul li {
    padding: 10px 15px;
    background-color: #3498db;
    color: #ffffff;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.pagination ul li:hover {
    background-color: #2980b9;
}

.pagination ul .active {
    background-color: #2980b9;
}

/* Responsive Design */

@media only screen and (max-width: 768px) {
    table {
        width: 100%;
        max-width: 100%;
        overflow-x: auto;
        display: block;
    }

    th, td {
        padding: 10px;
        
    }

    .pagination ul li {
        padding: 8px;
    }

    body {
        margin: 5px;
    }
}



    .table-data td {
        background-color: #d03a3a;
        color: white;

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
<div class="cmx">
    <h1 id="bgg">Your Marketing Orders</h1>

        @if(count($marketingData) > 0)
        <table>
            <thead>
                <tr class="table-header">
                    <th>Platform</th>
                    <th>Service</th>
                    <th>Quantity</th>
                    <th>URL</th>
                    <th>Total Price</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($marketingData as $marketing)
                    <tr class="table-data">
                        <td>{{ $marketing->platform }}</td>
                        <td>{{ $marketing->service }}</td>
                        <td>{{ $marketing->quantity }}</td>
                        <td>{{ $marketing->url }}</td>
                        <td>{{ $marketing->total_price }}$</td>
                        <td>{{ $marketing->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
                    <!-- Ajoute sa nan paj ou a pou afiche bouton paginasyon an -->
                    <div class="pagination">
                        {{ $marketingData->links() }}
                    </div>
    </div>
    @else
        <p>No marketing orders available.</p>
    @endif

    @include('layouts.usermenu')
</x-app-layout>