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
                                    <h4 class="sub-title">Create Menu</h4>
                                    <form id="formSubmit" method="POST" action="{{ route('menus.store') }}">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Menu Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="name" placeholder="Enter menu name">
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Menu URL</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="url" placeholder="Enter menu URL (optional)">
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10 offset-sm-2">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <a href="{{ url('menus') }}" class="btn btn-secondary">Close</a>
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

@endsection
