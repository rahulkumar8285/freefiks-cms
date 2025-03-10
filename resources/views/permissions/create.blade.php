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
                                    <h4 class="sub-title">Create Permission</h4>
                                    <form id="formSubmit" method="POST" action="{{ route('permissions.store') }}">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Role ID</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="role_id">
                                                    <option value="">Select Role ID</option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                    @endforeach
                                                </select>

                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        
                                        @foreach ($menus as $menu)
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">{{ $menu->name }}</label>
                                                <div class="col-sm-10">
                                                    @if($menu->submenus->count() > 0)
                                                        @foreach ($menu->submenus as $submenu)
                                                            <div class="form-check form-check-inline p-2">
                                                                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $submenu->url }}">
                                                                <label class="form-check
                                                                -label">{{ $submenu->name }}</label>
                                                            </div>
                                                        @endforeach
                                                    @endif


                                                    <span class="invalid-feedback"></span>
                                                </div>
                                            </div>

                                        @endforeach


                                        <div class="form-group row">
                                            <div class="col-sm-10 offset-sm-2">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <a href="{{ url('permissions') }}" class="btn btn-secondary">Close</a>
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
