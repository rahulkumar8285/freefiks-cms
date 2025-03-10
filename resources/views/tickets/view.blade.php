@extends('layout.sidebar')
@section('content')

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">

                <!-- page header -->
                <div class="page-header card">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <i class="icofont icofont-ttasks-alt bg-c-pink"></i>
                                <div class="d-inline">
                                    <h4>Ticket ID</h4>
                                    <h5>{{ $ticket->ticket_number }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-9">
                            <!-- Basic Form Inputs card start -->
                            <div class="card">
                                <div class="card-block">
                                    <h4 class="sub-title">View Ticket</h4>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Ticket Number</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $ticket->ticket_number }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Client Name</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $ticket->client_name }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Company Name</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $ticket->company_name }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Country</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $ticket->country_name }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Client Contact Email</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $ticket->client_contact_info }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Client Contact Number</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $ticket->client_contact_number }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Project Name</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $ticket->project_name }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Project Type</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $ticket->project_type }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Project Description</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $ticket->project_description }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Web URL</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $ticket->web_url }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Project Cost</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $ticket->project_cost }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Advance Payment Received Amount</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $ticket->advance_payment_received_amount }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Payment Method</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $ticket->payment_method }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Project Status</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $ticket->project_status_name }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Assigned User</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $ticket->assigned_user_name }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Created by</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $ticket->created_by_user_name }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Created at</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $ticket->created_at }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Updated at</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $ticket->updated_at }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Images</label>
                                        <div class="col-sm-10">
                                        @php
                                            if(isset($ticket->images) && !empty($ticket->images) && $ticket->images!=null){ 
                                                $imagesList = json_decode($ticket->images); @endphp

                                                <div class="row">
                                                    @foreach($imagesList as $key=>$image)
                                                            <div class="col-3" id="image_{{ $key }}">
                                                                <div class="DocumentBody">
                                                                    <a class="btn btn-info" href="{{ asset('uploads/'.$image) }}" target="_blank">View</a>
                                                                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteImage({{ $key }}, '{{ $image }}')">Delete</button>
                                                                </div>
                                                            </div>
                                                    @endforeach

                                                </div>
                                        @php } @endphp
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-10 offset-sm-2">
                                            <a href="{{ url('tickets') }}" class="btn btn-secondary">Back</a>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#statusChangeModal">Change Status</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Input Alignment card end -->
                        </div>

                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-header-left">
                                        <h5>Activites</h5>
                                    </div>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="icofont icofont-simple-left "></i></li>
                                            <li><i class="icofont icofont-maximize full-card"></i></li>
                                            <li><i class="icofont icofont-minus minimize-card"></i></li>
                                            <li><i class="icofont icofont-refresh reload-card"></i></li>
                                            <li><i class="icofont icofont-error close-card"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block">
                                    @if(isset($ticketLogs) && !empty($ticketLogs) && $ticketLogs != null)
                                        @foreach($ticketLogs as $log)
                                            <div class="card-notification">
                                                <div class="card-noti-conatin">
                                                    <p class="text-muted m-b-0">{{ $log->remarks }}</p>
                                                    <small>{{ \App\Models\User::find($log->session_id)->name }} ({{ date('d-m-Y H:i:s', strtotime($log->created_at)) }}) </small>
                                                    <p class="text-muted m-b-0">
                                                        @if($log->status != null)
                                                            @foreach($projectStatuses as $status)
                                                                @if($status->id == $log->status)
                                                                    <span class="badge badge-primary">{{ $status->status_name }}</span>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Page body end -->
            </div>
        </div>
        <!-- Main-body end -->
    </div>
</div>

<!-- Status Change Modal -->
<div class="modal fade" id="statusChangeModal" tabindex="-1" role="dialog" aria-labelledby="statusChangeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusChangeModalLabel">Change Ticket Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('tickets.changeStatus', $ticket->id) }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="project_status">Project Status</label>
                        <select class="form-control" name="project_status" id="project_status">
                            @foreach($projectStatuses as $status)
                                <option value="{{ $status->id }}" {{ $ticket->project_status == $status->id ? 'selected' : '' }}>{{ $status->status_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="remarks">Remarks</label>
                        <textarea class="form-control" name="remarks" id="remarks" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
