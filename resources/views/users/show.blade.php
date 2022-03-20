@extends('layouts.app')

@section('title', 'Informações do Usuário')

@section('content')
    <h1>Informações do Usuário {{ $user->name }}</h1>

    <ul>
        <li>{{  $user->name }}</li>
        <li>{{  $user->email }}</li>
    </ul>
    <form action="{{ route('users.delete', $user->id) }}" method="POST">
        @method('DELETE')
        @csrf
        <button type="submit">Excluir</button>
    </form>
@endsection