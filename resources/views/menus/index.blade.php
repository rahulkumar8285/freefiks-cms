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
                                <i class="ti-menu bg-c-pink"></i>
                                <div class="d-inline">
                                    <h4>Menus</h4>
                                    <span>Total Menus {{ count($menus) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 text-right">
                            <a href="{{ url('/menus/create') }}" type="button" class="btn btn-success">
                                Create Menu
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
                                        <th>Menu Name</th>
                                        <th>Menu URL</th>
                                        <th>Created at</th>
                                        <th>Updated at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($menus as $menu)
                                        <tr>
                                            <td>{{ $menu->name }}</td>
                                            <td>{{ $menu->url }}</td>
                                            <td>{{ $menu->created_at }}</td>
                                            <td>{{ $menu->updated_at }}</td>
                                            <td>
                                                <a href="{{ url('menus/view/'.Crypt::encrypt($menu->id)) }}" class="btn btn-info btn-sm">
                                                    <i class="ti-eye"></i> 
                                                </a>
                                                <a href="{{ url('menus/edit/'.Crypt::encrypt($menu->id)) }}" class="btn btn-primary btn-sm">
                                                    <i class="ti-pencil"></i> 
                                                </a>
                                                <a href="{{ url('menus/delete/'.Crypt::encrypt($menu->id)) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this menu?');">
                                                    <i class="ti-trash"></i> 
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> 

                       <div class="pagination">
                        {{ $menus->links('pagination::bootstrap-5') }}
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
