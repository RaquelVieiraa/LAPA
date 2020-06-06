@extends('layouts.app')

@section('titulo', 'Editar Informações de Contato do LAPA')
@section('content')
        <div class="container">
            <h2>Editar contato</h2>
            <form action="{{ route('auth.contato.atualizar', $registro->id) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="put">
                @include('auth.contato._form')
                <div class="input-btn">
                    <button class="btn">Salvar alterações</button>
                </div>
            </form>
        </div>
@endsection