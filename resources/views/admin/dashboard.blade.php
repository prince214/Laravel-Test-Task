@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tickets</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <table id="ticket_table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Ticket Name</th>
                                    <th>Clearance Level</th>
                                    <th>Booked Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets as $ticket)
                                    <tr>
                                        <td>{{ $ticket->id }}</td>
                                        <td>{{ $ticket->ticket_name }}</td>
                                        <td>{{ $ticket->clearance_lvl }}</td>
                                        <td>{{ $ticket->booked == '0' ? 'Not Booked' : 'Booked' }}</td>
                                        <td>
                                            <a class="btn btn-primary inline-box" data-toggle="modal"
                                                data-target="#edit_ticket_modal_{{ $ticket->id }}">Edit</a>
                                            <form class="inline-box" method="POST" action="{{ route('delete-ticket') }}">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="ticket" class="form-control"
                                                    value="{{ $ticket->id }}">
                                                <button type="submit" name="delete-btn"
                                                    class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="edit_ticket_modal_{{ $ticket->id }}" tabindex="-1"
                                        role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Ticket</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{ route('update-ticket') }}">
                                                        {{ csrf_field() }}
                                                        <div class="form-group">
                                                            <input type="hidden" name="ticket" class="form-control"
                                                                value="{{ $ticket->id }}">
                                                            <input type="text" name="ticket_name" class="form-control"
                                                                value="{{ $ticket->ticket_name }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" name="clearance_lvl" class="form-control"
                                                                value="{{ $ticket->clearance_lvl }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <select class="form-control" id="type" name="booked">
                                                                <option value="0"
                                                                    {{ $ticket->booked == 0 ? 'selected' : '' }}>Not Booked
                                                                </option>
                                                                <option value="1"
                                                                    {{ $ticket->booked == 1 ? 'selected' : '' }}>Booked
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
@endsection
