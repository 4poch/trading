
<head>
    <link rel="stylesheet" href="{{ asset('cssfile/user.css') }}">
</head>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <form action="{{ route('groups.store') }}" method="POST">
        @csrf
        <label for="group_link">Link Group WhatsApp:</label>
        <input type="text" name="group_link" id="group_link">
        @if ($errors->has('group_link'))
        <p class="text-danger">{{ $errors->first('group_link') }}</p>
        @endif
        <label for="category">Choose Categorie:</label>
        <select name="category" id="category">
            <option value="Enjoy">Enjoy</option>
            <option value="Family">Family</option>
            <option value="Friends">Friends</option>
            <option value="Work">Work</option>
            <option value="Business">Business</option>
            <option value="Promotion">Promotion</option>
            <option value="Trader">Trader</option>
            <option value="Gamers">Gamers</option>
            <option value="Youtubers">Youtubers</option>
            <option value="Social">Social</option>
            <option value="+18">+18</option>
            <option value="Woman">Woman</option>
            <option value="Man">Man/option>
            <!-- Ajoute lòt opsyon kategori si w bezwen -->
        </select>
        
        <label for="user_amount">Add User Amount:</label>
        <input type="number" name="user_amount" id="user_amount">
        
        <label for="country">Choose Country:</label>
        <select name="country" id="country">
            <option value="Haiti">Haiti</option>
            <option value="USA">USA</option>
            <option value="Canada">Canada</option>
            <option value="Republic Dminican">Republic Dminican</option>
            <option value="Africa">Africa</option>
            <option value="Mexico">Mexico</option>
            <option value="Spain">Spain</option>
            <option value="France">France</option>
            <option value="Brasil">Frasil</option>
            <option value="Russia">Russia</option>
            <!-- Ajoute lòt peyi si w bezwen -->
        </select>
        
        <button type="submit">Ajoute Group</button>
    </form>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    @include('layouts.usermenu')
</x-app-layout>