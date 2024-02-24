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


    <h1>Marketing Orders</h1>

    <table class="zoa">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Platform</th>
                <th>Service</th>
                <th>Quantity</th>
                <th>URL</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="xray">
            @foreach($marketingData as $marketing)
            <tr>
                <td>{{ $marketing->user_id }}</td>
                <td>{{ $marketing->platform }}</td>
                <td>{{ $marketing->service }}</td>
                <td>{{ $marketing->quantity }}</td>
                <td>{{ $marketing->url }}</td>
                <td>{{ $marketing->total_price }}</td>
                <td>{{ $marketing->status }}</td>
                <td>
                    <form action="{{ route('updateMarketingStatus') }}" method="POST" class="frx">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="marketing_id" value="{{ $marketing->id }}">
                        <select name="status">
                            <option value="pending" {{ $marketing->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="In-Progress" {{ $marketing->status === 'In-Progress' ? 'selected' : '' }}>In-Progress</option>
                            <option value="completed" {{ $marketing->status === 'completed' ? 'selected' : '' }}>Completed</option>
                            <!-- Ajoute lòt opsyon pou estati si nesesè -->
                        </select>
                        <button type="submit">Update Status</button>
                    </form>
                    
                    
                </td>
            </tr>
        @endforeach
        
        </tbody>
    </table>
    {{ $marketingData->links() }}

</div>
@include('layouts.adminmenu') <!-- menu ki sou bo goch-->
</x-app-layout>
</body>

<style>
    /* Kòd CSS global pou tout paj la */
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
}
h1{
    margin-left:70px; 
}
/* Kòd pou div avèk klas "myfok" */
.myfok {
    padding: 2px;
    background-color:#d9e4ff;
    border: 1px solid #fffcfc;
    border-radius: 5px;
    margin-bottom: 20px;
    overflow: auto; /* Ajoute overflow: auto */
}

/* Kòd pou tablo avèk klas "zoa" */
.zoa {
    width: 95%;
    border-collapse: collapse;
    margin-top: 10px;
    overflow: auto; /* Ajoute overflow: auto */
    margin-left: 60px;
}

.zoa th, .zoa td {
    border: 1px solid #000000;
    padding: 8px;
    text-align: left;
}

.zoa th {
    background-color: #faaf90;
    color: white;
}

/* Kòd pou tablo avèk klas "xray" */
.xray {
    font-size: 14px;
}

/* Kòd pou form avèk klas "frx" */
.frx {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    background-color: #fcc9b5;
}

.frx select, .frx button {
    margin-top: 5px;
}

/* Kòd pou mesaj siksè */
/* Kòd CSS pou div avèk klas "alertxb" */
.alertxb {
    position: absolute
    padding: 10px;
    background-color: #dff0d8;
    border: 1px solid #d6e9c6;
    color: #3c763d;
    margin-bottom: 20px;
    border-radius: 5px;
    max-width: 20%;
    margin-left: 5%;
}



</style>