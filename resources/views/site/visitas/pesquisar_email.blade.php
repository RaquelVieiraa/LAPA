@extends('layouts.app')

@section('titulo', 'Agendar visita')
@section('content')
        <div class="container col-12 col-md-10 col-lg-10 p-0">
            <h2>Visitas e Agenda</h2>

            @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible">
                    {!! Session::get('success') !!}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="d-flex flex-wrap-reverse">
                <div id="full-clndr" class="col-12 col-md-8 col-lg-9 mt-2 clearfix">
                </div>
                <form class="col-12 col-md-4 col-lg-3" id="form-busca" action="{{ route('site.visita.buscar.registro') }}" method="GET" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="email"><strong>Deseja marcar um visita?</strong> Digite o email abaixo para começar</label>
                        <input id="email" type="text" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{isset($user->email) ? $user->email: old('email')}}" required autocomplete="email" autofocus placeholder="exemplo@exemplo.com">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-btn">
                        <button form="form-busca" class="btn w-100">Iniciar solicitação</button>
                    </div>
                </form>
            </div>
        </div>
@endsection
@section('scripts')
    <script id="calendar-template" type="text/template">
            <div class="clndr-controls">
                <div class="clndr-previous-button">
                    <span class="fas fa-chevron-left"></span>
                </div>
                <div class="clndr-next-button">
                    <span class="fas fa-chevron-right"></span>
                </div>
                <div class="current-month">
                    <%= month %> <%= year %>
                </div>
            </div>
            <div class="calendar">
                <div class="clndr-grid">
                    <div class="days-of-the-week clearfix">
                        <% _.each(daysOfTheWeek, function(day) { %>
                        <div class="header-day">
                            <%= day %>
                        </div>
                        <% }); %>
                    </div>
                    <div class="days">
                        <% _.each(days, function(day) { %>
                        <div class="<%= day.classes %>" id="<%= day.id %>">
                            <span class="day-number"><%= day.day %></span>
                        </div>
                        <% }); %>
                    </div>
                </div>
                <div class="event-listing p-0">
                    <div class="event-listing-title d-flex text-center">
                        <div class="x-button pointer">
                            <span class="fas fa-times"></span>
                        </div>
                        <p class="w-100 m-0">Eventos deste mês</p>
                    </div>
                    <% _.each(eventsThisMonth, function(event) { %>
                    <div class="event-item">
                            <div class="event-item-name">
                                <p><%= moment(event.date).format('ddd, DD [de] MMMM, [das] h:mm [às] h:mm') %> <%= event.title %></p>
                            </div>
                            <div class="event-item-location">
                                <%= event.location %>
                            </div>
                    </div>
                    <% }); %>
                </div>
            </div>
        </div>
    </script>
    <script>
        var eventos = [
            {
                date: moment("2020-05-26"),
                title: "Vinicius",
                location: "Visita de estudantes da 4 serie."
            }, {
                date: moment("2020-05-04"),
                title: "Daniela",
                location: "Visita de professores."
            }, {
                date: moment("2020-05-04"),
                title: "Daniela",
                location: "Visita de professores."
            }, {
                date: moment("2020-05-04"),
                title: "Daniela",
                location: "Visita de professores."
            }, {
                date: moment("2020-05-04"),
                title: "Daniela",
                location: "Visita de professores."
            }, {
                date: moment("2020-05-04"),
                title: "Daniela",
                location: "Visita de professores."
            }, {
                date: moment("2020-05-04"),
                title: "Daniela",
                location: "Visita de professores."
            }
        ];
        $('#full-clndr').clndr({
            template: $('#calendar-template').html(),
            daysOfTheWeek: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
            events: eventos,
            clickEvents: {
            click: function(target) {
                if(target.events.length) {
                    var eventListing = $('#full-clndr').find('.calendar');
                    //var calendarDays = $('#full-clndr').find('.calendar-days');
                    eventListing.toggleClass('show-events', true);
                    //calendarDays.toggleClass('d-none', true);
                    $('#full-clndr').find('.x-button').click( function() {
                        eventListing.toggleClass('show-events', false);
                        //calendarDays.toggleClass('d-none', false);
                    });
                    }
                }
            },
        });
    </script>

@endsection