@extends('layout.sidebar')
@section('content')

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-header card">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <i class="ti-ticket bg-c-pink"></i>
                                <div class="d-inline">
                                    <h4>Tickets</h4>
                                    <span>Create New Ticket</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            
                <!-- Page body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Basic Form Inputs card start -->
                            <div class="card">
                                <div class="card-block">
                                    <h4 class="sub-title">Client information</h4>
                                    <form id="formSubmit" method="POST" action="{{ route('tickets.store') }}" enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Client Type</label>
                                            <div class="col-sm-10">
                                               <select class="form-control" name="client_type">
                                                    <option value="">Select Type</option>
                                                    <option value="membership">Membership</option>
                                                    <option value="non-membership">Non-membership</option>
                                                </select>
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        
                                        <div style="display: none;" id="non-membership">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Full Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="client_name" placeholder="Enter client name">
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Company Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="company_name" placeholder="Enter company name">
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Client Contact Email</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="client_contact_info" placeholder="Enter client contact Email">
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Client Contact Number</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="client_contact_number" placeholder="Enter client contact number">
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
                                                                <option data-currency="{{$country->currency_code}}"  value="{{ $country->id }}">{{ $country->country_name }} ({{ $country->currency_code  }})</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div style="display: none;" id="membership">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Select Client</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" name="client_id">
                                                        <option value="">Select Client</option>
                                                        @if($memberships)
                                                            @foreach($memberships as $membership)
                                                                <option value="{{ $membership->id }}">{{ $membership->name }} {{ $membership->company_name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                            </div>

                                        </div>

                                        <h4 class="sub-title">Project information</h4>
                                        <div class="form-group">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Project Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="project_name" placeholder="Enter project name">
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Project Type</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" name="project_type">
                                                        <option value="">Select Type</option>
                                                        <option value="new development">New Development</option>
                                                        <option value="re-development">Re-development</option>
                                                        <option value="maintenance">Maintenance</option>
                                                        <option value="support">Support</option>
                                                        <option value="consulting">Consulting</option>
                                                        <option value="other">Other</option>
                                                    </select>
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Project Description</label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control" style="height: 200px;" name="project_description" placeholder="Enter project description"></textarea>
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Web URL</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="web_url" placeholder="Enter web URL">
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
                                                            <option value="{{ $status->id }}">{{ $status->status_name }}</option>
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
                                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Work Expectation Days</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="work_expectation_days" placeholder="Enter work expectation days">
                                                    <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Images</label>
                                            <div class="col-sm-10">
                                                <input type="file" class="form-control" id="document" name="images[]" multiple>
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        </div>

                                        <h4 class="sub-title">Payment information</h4>
                                        <div class="form-group">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Project Cost in ( <span class="currencyIcon"></span>)</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="project_cost" placeholder="Enter project cost">
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                            </div>
                                           

                                        
                                        <!-- Repeat similar form fields for other ticket attributes -->
                                        <!-- ...existing code... -->
                                        <div class="form-group row">
                                            <div class="col-sm-10 offset-sm-2">
                                                <button type="submit" class="btn btn-primary">Submit</button>
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
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('country').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var currency = selectedOption.getAttribute('data-currency');
            var currencyIcons = document.querySelectorAll('.currencyIcon');
            currencyIcons.forEach(function(icon) {
                icon.textContent = currency;
            });
        });
    });
</script>

<script>
    document.getElementsByName('client_type')[0].addEventListener('change', function() {
        var membershipSection = document.getElementById('membership');
        var nonMembershipSection = document.getElementById('non-membership');
        if (this.value === 'membership') {
            membershipSection.style.display = 'block';
            nonMembershipSection.style.display = 'none';
        } else if (this.value === 'non-membership') {
            membershipSection.style.display = 'none';
            nonMembershipSection.style.display = 'block';
        } else {
            membershipSection.style.display = 'none';
            nonMembershipSection.style.display = 'none';
        }
        
    });
</script>



@endsection
