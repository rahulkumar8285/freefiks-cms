@extends('layout.sidebar')
@section('content')

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Basic Form Inputs card start -->
                            <div class="card">
                                <div class="card-block">
                                    <h4 class="sub-title">Client information</h4>
                                    <form id="formSubmit" method="POST" action="{{ route('tickets.update', $ticket->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Ticket Number</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" readonly name="ticket_number" value="{{ $ticket->ticket_number }}" placeholder="Enter ticket number">
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Client Type</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" readonly name="client_type" value="{{ $ticket->client_type }}" placeholder="Enter client type">
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>

                                        @if(!empty($ticket->client_id))
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Client Id</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="client_id" value="{{ $ticket->client_id }}" placeholder="Enter client name">
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                            </div>
                                        @endif


                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Client Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="client_name" value="{{ $ticket->client_name }}" placeholder="Enter client name">
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Company Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="company_name" value="{{ $ticket->company_name }}" placeholder="Enter company name">
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Client Contact Email</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="client_contact_info" value="{{ $ticket->client_contact_info }}" placeholder="Enter client contact Email">
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Client Contact Number</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="client_contact_number" value="{{ $ticket->client_contact_number }}" placeholder="Enter client contact number">
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Select Country</label>
                                            <div class="col-sm-10">
                                               <select class="form-control" name="country" id="country">
                                                    <option value="">Select Country</option>
                                                     @if($countries)
                                                        @foreach($countries as $country)
                                                            <option data-currency="{{$country->currency_code}}" 
                                                            @if($ticket->country == $country->id) selected @endif
                                                            value="{{ $country->id }}">{{ $country->country_name }} ({{ $country->currency_code  }})</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>

                                        <h4 class="sub-title">Project Information</h4>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Project Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="project_name" value="{{ $ticket->project_name }}" placeholder="Enter project name">
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Project Type</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="project_type" value="{{ $ticket->project_type }}" placeholder="Enter project type">
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Project Description</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" style="height: 200px;"  name="project_description" placeholder="Enter project description">{{ $ticket->project_description }}</textarea>
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Web URL</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="web_url" value="{{ $ticket->web_url }}" placeholder="Enter web URL">
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        
                                        <h4 class="sub-title">Payment Information</h4>


                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Project Cost in ( <span class="currencyIcon"></span>)</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="project_cost" value="{{ $ticket->project_cost }}" placeholder="Enter project cost">
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Work Expectation Days</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" value="{{ $ticket->work_expectation_days }}" name="work_expectation_days" placeholder="Enter work expectation days">
                                                    <span class="invalid-feedback"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Project Status</label>
                                            <div class="col-sm-10">

                                                <select class="form-control" name="project_status">
                                                    @if($projectStatuses)
                                                        <option value="">Select Status</option>
                                                        @foreach($projectStatuses as $status)
                                                            <option value="{{ $status->id }}"  
                                                                @if($ticket->project_status == $status->id) selected @endif
                                                            >{{ $status->status_name }}</option>
                                                        @endforeach
                                                    @endif
                                                    
                                                </select> 

                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Assigned User</label>
                                            <div class="col-sm-10">
                                                @if($users)
                                                    <select class="form-control" name="assigned_user">
                                                        <option value="">Select User</option>
                                                        @foreach($users as $user)
                                                            <option value="{{ $user->id }}" {{ $ticket->assigned_user == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Images</label>
                                            <div class="col-sm-10">
                                                <input type="file" id="document" class="form-control" name="images[]" multiple>
                                                <input type="hidden" name="deleteImages"   value="">
                                                @php
                                                    if(isset($ticket->images) && !empty($ticket->images) && $ticket->images!=null){ 
                                                        echo "<br>Existing Images:<br>";
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

                                              


                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <!-- Repeat similar form fields for other ticket attributes -->
                                        <!-- ...existing code... -->
                                        <div class="form-group row">
                                            <div class="col-sm-10 offset-sm-2">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                                <a href="{{ url('tickets') }}" class="btn btn-secondary">Close</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Input Alignment card end -->
                        </div>
                    </div>
                </div>
                <!-- Page body end -->
            </div>
        </div>
        <!-- Main-body end -->
    </div>
</div>


<script>

    let deleteImages = [];
  
    function deleteImage(deleId){

        if(confirm('Are you sure you want to delete this Document?')){          
            $('#image_'+deleId).remove();
            deleteImages.push(deleId);
            $('input[name="deleteImages"]').val(deleteImages);
        }

    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var countrySelect = document.getElementById('country');
        var selectedOption = countrySelect.options[countrySelect.selectedIndex];
        var currency = selectedOption.getAttribute('data-currency');
        var currencyIcons = document.querySelectorAll('.currencyIcon');
        currencyIcons.forEach(function(icon) {
            icon.textContent = currency;
        });

        countrySelect.addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var currency = selectedOption.getAttribute('data-currency');
            currencyIcons.forEach(function(icon) {
                icon.textContent = currency;
            });
        });
    });
</script>


@endsection
