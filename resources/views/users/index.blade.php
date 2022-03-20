@extends('layouts.app')

@section('title', 'Listagem dos Usuários')

@section('content')
    <h1>Listagem dos Usuários</h1>

    <form action="{{ route('users.index') }}" method="get">
        <input type="text" name="search" placeholder="Pesquisar">
        <button>Pesquisar</button>
    </form>
    
    <h4><a href="{{ route('users.create') }}">Novo</a></h4>

    <ul>
        @foreach($users as $user)        
            <li>
                {{ $user->name }} - 
                {{ $user->email }}
                | <a href="{{ route('users.show', $user->id) }}">Detalhes</a>
                | <a href="{{ route('users.edit', $user->id) }}">Editar</a>
            </li>
        @endforeach
    </ul>
@endsection