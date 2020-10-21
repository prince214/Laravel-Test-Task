@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h1>Book Tickets</h1>
    </div>
    <div class="row justify-content-center mt-5">
    <div class="ticket--grid">
        <div class="row">
            <div id="lvl_10" class="ticket_num">10</div>
            <div id="lvl_15" class="ticket_num">15</div>
            <div id="lvl_20" class="ticket_num">20</div>
        </div>
        <div class="row">
            <div id="lvl_25" class="ticket_num">25</div>
            <div id="lvl_30" class="ticket_num">30</div>
            <div id="lvl_35" class="ticket_num">35</div>
        </div>
        <div class="row">
            <div id="lvl_40" class="ticket_num">40</div>
            <div id="lvl_45" class="ticket_num">45</div>
            <div id="lvl_50" class="ticket_num">50</div>
        </div>
        <div class="row">
            <div id="lvl_55" class="ticket_num">55</div>
            <div id="lvl_60" class="ticket_num">60</div>
            <div id="lvl_65" class="ticket_num">65</div>
        </div>
        <div class="row">
            <div id="lvl_70" class="ticket_num">70</div>
            <div id="lvl_80" class="ticket_num">80</div>
        </div>
    </div>
    <div class="col-sm-2 ml-5">
        <span id="booked_ticket"></span>
        @foreach($tickets as $ticket)
        <span class="ticket--row" id="{{$ticket->clearance_lvl}}">{{ $ticket->ticket_name }}</span>
        @endforeach
    </div>
    </div>
</div>
@endsection
