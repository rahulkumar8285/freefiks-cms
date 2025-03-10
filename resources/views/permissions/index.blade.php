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
                                <i class="ti-lock bg-c-pink"></i>
                                <div class="d-inline">
                                    <h4>Permissions</h4>
                                    <span>Total Permissions {{ count($permissions) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 text-right">
                            <a href="{{ url('/permissions/create') }}" type="button" class="btn btn-success">
                                Create Permission
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
                                        <th>Role ID</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $permission)
                                        <tr>
                                            <td>{{ $permission->role_name }}</td>
                                            <td>
                                                <a href="{{ url('permissions/edit/'.Crypt::encrypt($permission->role_id)) }}" class="btn btn-primary btn-sm">
                                                    <i class="ti-pencil"></i> 
                                                </a>
                                                <a href="{{ url('permissions/delete/'.Crypt::encrypt($permission->role_id)) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this permission?');">
                                                    <i class="ti-trash"></i> 
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> 

                       <div class="pagination">
                        {{ $permissions->links('pagination::bootstrap-5') }}
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
