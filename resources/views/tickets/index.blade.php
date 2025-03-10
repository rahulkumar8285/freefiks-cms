@extends('layout.sidebar')
@section('content')

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page body start -->

                <div class="page-header card">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <i class="ti-ticket bg-c-pink"></i>
                                <div class="d-inline">
                                    <h4>Tickets</h4>
                                    <span>Total Tickets {{ count($tickets) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 text-right">
                            <a href="{{ url('/tickets/create') }}" type="button" class="btn btn-success">
                                Create Ticket
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Page body start -->

                <div class="page-body card">
                    <div class="container">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Ticket Number</th>
                                        <th>Project Status</th>
                                        <th>Client Name</th>
                                        <th>Company Name</th>
                                        <th>Contact Info</th>
                                        <th>Contact Number</th>
                                        <th>Project Name</th>
                                        <th>Project Type</th>
                                        <th>Project Description</th>
                                        <th>Web URL</th>
                                        <th>Project Cost</th>
                                        <th>Advance Payment</th>
                                        <th>Payment Method</th>
                                        <th>Created by</th>
                                        <th>Assigned User</th>
                                        <th>Create at</th>
                                        <th>Update at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tickets as $ticket)
                                        <tr>
                                            <td>{{ $ticket->ticket_number }}</td>
                                            <td>{{ $ticket->project_status_name }}</td>
                                            <td>{{ $ticket->client_name }}</td>
                                            <td>{{ $ticket->company_name }}</td>
                                            <td>{{ $ticket->client_contact_info }}</td>
                                            <td>{{ $ticket->client_contact_number }}</td>
                                            <td>{{ $ticket->project_name }}</td>
                                            <td>{{ $ticket->project_type }}</td>
                                            <td>{{ $ticket->project_description }}</td>
                                            <td>{{ $ticket->web_url }}</td>
                                            <td>{{ $ticket->project_cost }}</td>
                                            <td>{{ $ticket->advance_payment_received_amount }}</td>
                                            <td>{{ $ticket->payment_method }}</td>
                                            <td>{{ $ticket->created_by_user_name }}</td>
                                            <td>{{ $ticket->assigned_user_name }}</td>
                                            <td>{{ $ticket->created_at }}</td>
                                            <td>{{ $ticket->updated_at }}</td>
                                            <td>
                                                <a href="{{ url('tickets/view/'.Crypt::encrypt($ticket->id)) }}" class="btn btn-info btn-sm">
                                                    <i class="ti-eye"></i> 
                                                </a>
                                                <a href="{{ url('tickets/edit/'.Crypt::encrypt($ticket->id)) }}" class="btn btn-primary btn-sm">
                                                    <i class="ti-pencil"></i> 
                                                </a>
                                                <a href="{{ url('tickets/delete/'.Crypt::encrypt($ticket->id)) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this ticket?');">
                                                    <i class="ti-trash"></i> 
                                                </a>
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> 

                       <div class="pagination">
                        {{ $tickets->links('pagination::bootstrap-5') }}
                       </div>

                    </div>
                </div>
                <!-- Page body end -->
            </div>
        </div>
        <!-- Main-body end -->
    </div>
</div>

@endsection
