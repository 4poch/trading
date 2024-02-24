<style>
    .admindigi {
    padding: 20px;
}

.digitaloders table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.digitaloders th, .digitaloders td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: left;
}

.digitaloders th {
    background-color: #f2f2f2;
}

.digitaloders select {
    padding: 8px;
    border-radius: 4px;
}

.digitaloders button {
    padding: 8px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.digitaloders #digitaloders {
    font-size: 18px;
    font-weight: bold;
    color: #3498db;
    text-align: center;
    margin-top: 20px;
}

@media only screen and (max-width: 600px) {
    .digitaloders th, .digitaloders td {
        font-size: 12px;
        padding: 8px;
    }

    .digitaloders select, .digitaloders button {
        font-size: 10px;
        padding: 6px;
    }
}


</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="admindigi">
        <div class="digitaloders">
            @if(isset($nouvopros) && $nouvopros->isNotEmpty())
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Service</th>
                            <th>Website Link</th>
                            <th>Quantity</th>
                            <th>Estimate Value</th>
                            <th>Order Description</th>
                            <th>Policy Accepted</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Status</th>
                            <th>Update Status</th> <!-- Nouvo kòlòn pou bouton an -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($nouvopros as $nouvopro)
                            <tr>
                                <td>{{ $nouvopro->id }}</td>
                                <td>{{ $nouvopro->service }}</td>
                                <td>{{ $nouvopro->website_link }}</td>
                                <td>{{ $nouvopro->quantity }}</td>
                                <td>{{ $nouvopro->estimate_value }}</td>
                                <td>{{ $nouvopro->order_description }}</td>
                                <td>{{ $nouvopro->policy_accepted ? 'Yes' : 'No' }}</td>
                                <td>{{ $nouvopro->created_at }}</td>
                                <td>{{ $nouvopro->updated_at }}</td>
                                <td>{{ $nouvopro->status }}</td>
                                <td>
                                    <form action="{{ route('updateStatus', $nouvopro->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select name="status">
                                            <option value="Pending" {{ $nouvopro->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="Rejected" {{ $nouvopro->status === 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                            <option value="Complete" {{ $nouvopro->status === 'Complete' ? 'selected' : '' }}>Complete</option>
                                        </select>
                                        <button type="submit">Update</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Pagination links -->
                {{ $nouvopros->links() }}
            @else
                <p id="digitaloders">No data available.</p>
            @endif
        </div>
    </div>

@include('layouts.adminmenu')
</x-app-layout>