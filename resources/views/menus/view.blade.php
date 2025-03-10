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
                                    <h4 class="sub-title">View Menu</h4>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Menu Name</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $menu->name }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Menu URL</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $menu->url }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Created at</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $menu->created_at }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Updated at</label>
                                        <div class="col-sm-10">
                                            <p class="form-control-static">{{ $menu->updated_at }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-10 offset-sm-2">
                                            <a href="{{ url('menus') }}" class="btn btn-secondary">Back</a>
                                        </div>
                                    </div>
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
