<title>Services History</title>


<style>
  /* General Styles */

/* Reset some default styles */
body, h1, h2, p, table {
    margin: 0;
    padding: 0;
    background: var(--color1);
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

/* Apply a modern font and style to the body */

/* Center the content in the body */
.bd2x {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

/* Style the header */
.font-semibold {
    font-weight: 600;
}

.text-xl {
    font-size: 1.25rem; /* Adjust the font size as needed */
}

/* Style the table */
.table-wrapper {
    margin-top: 20px;
    overflow-x: auto;
}

.modern-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

.modern-table th, .modern-table td {
    padding: 12px;
    border: none solid var(--color6);
    text-align: left;
}

/* Add some styling for the table headers */
.modern-table th {
    background-color: var(--color2); /* Set your preferred header background color */
}

/* Style the user menu */
.user-menu {
    /* Add your styling for the user menu here */
}

/* Add more styling for other elements as needed */

</style>

  

<x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>
        <div class="sevish">
            <div class="table-wrapper">
              @if(isset($nouvopros) && $nouvopros->isNotEmpty())
                <table class="modern-table">
                  <thead>
                    <tr>
                      <th>Service</th>
                      <th>Website Link</th>
                      <th>Website Info</th>
                      <th>Quantity</th>
                      <th>Estimate Value</th>
                      <th>Order Description</th>
                      <th>Policy Accepted</th>
                      <th>Status</th>
                      <!-- Add more headers if needed -->
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($nouvopros as $nouvopro)
                      <tr>
                        <td>{{ $nouvopro->service }}</td>
                        <td>{{ $nouvopro->website_link }}</td>
                        <td>{{ $nouvopro->website_info }}</td>
                        <td>{{ $nouvopro->quantity }}</td>
                        <td>{{ $nouvopro->estimate_value }}</td>
                        <td>{{ $nouvopro->order_description }}</td>
                        <td>{{ $nouvopro->policy_accepted ? 'Yes' : 'No' }}</td>
                        <td>{{ $nouvopro->status }}</td>
                        <!-- Add more data columns if needed -->
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                {{ $nouvopros->links() }}
              @else
                <p>No data available.</p>
              @endif
            </div>
          </div>
          
    


    @include('layouts.usermenu')
</x-app-layout>
