<title>Netflix Data</title>
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

/* Table Styles */
.datainfo {
    overflow-x: auto;
}

/* Table Styles with Color */
.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.table th, .table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid var(--color2);
}

/* Color Styles */
.table th {
    background-color: var(--color2); /* Koulè pou tèt tab la */
}

.table td {
    background-color: var(--color1); /* Koulè pou chak linè nan tab la */
}

/* Responsive Table Styles */
@media only screen and (max-width: 600px) {
    .table th, .table td {
        font-size: 14px;
    }
}


/* Include User Menu Styles */


</style>



<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


<div class="datainfo">
        <!-- Reste nan kòd la -->
    
        <table class="table">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Netflix Login</th>
                    <th>netflixPasscode</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($newVariableName as $data) <!-- Modifye non variab la -->
                    <tr>
                        <td>{{ $data->userId }}</td>
                        <td>{{ $data->netflixLogin }}</td>
                        <td>{{ $data->netflixPasscode }}</td>
                        <td>{{ $data->startDate }}</td>
                        <td>{{ $data->endDate }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


 @include('layouts.usermenu') 
</x-app-layout>