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
                                <i class="ti-user bg-c-pink"></i>
                                <div class="d-inline">
                                    <h4>Users</h4>
                                    <span>Total User {{ count($users) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 text-right">
                            <a href="{{ url('/user-create') }}" type="button" class="btn btn-success">
                                Create User
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
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Address</th>
                                        <th>Role</th>
                                        <th>Create at</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->address }}</td>
                                            <td>{{ $user->roleName }}</td>
                                            <td>{{ $user->created_at }}</td>
                                            <td>
                                                <a href="{{ url('users/edit/'.Crypt::encrypt($user->id)) }}" class="btn btn-primary btn-sm">
                                                    <i class="ti-pencil"></i> 
                                                </a>
                                                <a href="{{ url('users/delete/'.Crypt::encrypt($user->id)) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?');">
                                                    <i class="ti-trash"></i> 
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <!-- Add more user data as needed -->
                                </tbody>
                            </table>
                        </div> 

                       <div class="pagination">
                        {{ $users->links('pagination::bootstrap-5') }}
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
