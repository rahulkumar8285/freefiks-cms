@extends('layout.sidebar')
@section('content')

<div class="pcoded-content">

  <div class="pcoded-inner-content">
      <div class="main-body">
          <div class="page-wrapper">
              <!-- Page-body start -->
              <div class="page-body">
              <div class="row">
                    <!-- card1 start -->
                    <div class="col-md-6 col-xl-3">
                        <div class="card widget-card-1">
                            <div class="card-block-small">
                                <i class="icofont icofont-pie-chart bg-c-blue card1-icon"></i>
                                <span class="text-c-blue f-w-600">Users</span>
                                <h4>{{ $usersCount }}</h4>
                            </div>
                        </div>
                    </div>
                    <!-- card1 end -->
                    <!-- card1 start -->
                    <div class="col-md-6 col-xl-3">
                        <div class="card widget-card-1">
                            <div class="card-block-small">
                                <i class="icofont icofont-ui-home bg-c-pink card1-icon"></i>
                                <span class="text-c-pink f-w-600">Tickets</span>
                                <h4>{{ $ticketCount }}</h4>
                            </div>
                        </div>
                    </div>
                    <!-- card1 end -->
                    <!-- Project overview End -->
                </div>
              </div>
              <!-- Page-body end -->
          </div>
      </div>

  </div>
</div>
@endsection



