@extends('layouts.app')

@section('titulo', 'Agendar visita')
@section('content')
        <div class="container col-11 col-md-7 col-lg-5">
            <h2>Agendar visita</h2>

            @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible">
                    {{ Session::get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <form id="form-visita" action="{{ route('site.visita.salvar') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                @include('auth.visitas._form')
                <div class="input-btn">
                    <button form="form-visita" type="submit" class="btn">Agendar</button>
                </div>
            </form>
        </div>
        <div id="full-clndr" class="clearfix"></div>
@endsection