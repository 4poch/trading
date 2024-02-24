
<head>
    <link rel="stylesheet" href="{{ asset('cssfile/user.css') }}">
</head>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
<div class="grouplist">
    <table class="table">
        <thead>
            <tr>
                <th>Group Link</th>
                <th>Category</th>
                <th>User Amount</th>
                <th>Country</th>
                <th>Action</th> <!-- Nou ajoute yon nouvo kòlòn pou bouton an -->
            </tr>
        </thead>
        <div class="sectiong">
        <tbody>
            @foreach ($groups as $group)
                <tr>
                    <td>{{ $group->group_link }}</td>
                    <td>{{ $group->category }}</td>
                    <td>{{ $group->user_amount }}</td>
                    <td>{{ $group->country }}</td>
                    <td><a href="{{ $group->group_link }}" class="btn btn-primary" target="_blank">Vizite Gwoup La</a></td>
                </tr>
            @endforeach
        </tbody>
        </div>
    </table>
    <div class="pagination">
        {{ $groups->links() }}
    </div>
    
</div>
@include('layouts.usermenu')
</x-app-layout>