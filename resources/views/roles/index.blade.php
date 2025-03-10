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
                                <i class="ti-id-badge bg-c-pink"></i>
                                <div class="d-inline">
                                    <h4>Roles</h4>
                                    <span>Total Role {{ count($roles) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 text-right">
                            <a href="{{ url('/roles/create') }}" type="button" class="btn btn-success">
                                Create Role
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
                                        <th>Name</th>
                                        <th>Create at</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->created_at }}</td>
                                            <td>
                                                <a href="{{ url('roles/edit/'.Crypt::encrypt($user->id)) }}" class="btn btn-primary btn-sm">
                                                    <i class="ti-pencil"></i> 
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <!-- Add more user data as needed -->
                                </tbody>
                            </table>
                        </div> 

                       <div class="pagination">
                        {{ $roles->links('pagination::bootstrap-5') }}
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
