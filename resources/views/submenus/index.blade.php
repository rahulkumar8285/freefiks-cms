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
                                    <h4>Sub Menus</h4>
                                    <span>Total Sub Menus {{ count($subMenus) }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 text-right">
                            <a href="{{ url('/submenus/create') }}" type="button" class="btn btn-success">
                                Create Sub Menu
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
                                        <th>Sub Menu Name</th>
                                        <th>Sub Menu URL</th>
                                        <th>Parent Menu</th>
                                        <th>Created at</th>
                                        <th>Updated at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subMenus as $subMenu)
                                        <tr>
                                            <td>{{ $subMenu->name }}</td>
                                            <td>{{ $subMenu->url }}</td>
                                            <td>{{ $subMenu->name }}</td>
                                            <td>{{ $subMenu->created_at }}</td>
                                            <td>{{ $subMenu->updated_at }}</td>
                                            <td>
                                                <a href="{{ url('submenus/view/'.Crypt::encrypt($subMenu->id)) }}" class="btn btn-info btn-sm">
                                                    <i class="ti-eye"></i> 
                                                </a>
                                                <a href="{{ url('submenus/edit/'.Crypt::encrypt($subMenu->id)) }}" class="btn btn-primary btn-sm">
                                                    <i class="ti-pencil"></i> 
                                                </a>
                                                <a href="{{ url('submenus/delete/'.Crypt::encrypt($subMenu->id)) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this sub menu?');">
                                                    <i class="ti-trash"></i> 
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> 

                       <div class="pagination">
                        {{ $subMenus->links('pagination::bootstrap-5') }}
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
