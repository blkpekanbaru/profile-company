@extends('admin/layouts/layoutMaster')

@section('title', 'Dashboard')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('admin/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('admin/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />

@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/pages/cards-advance.css') }}">

@endsection

@section('vendor-script')
    <script src="{{ asset('admin/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>

@endsection

@section('page-script')
    <script src="{{ asset('admin/assets/js/cards-statistics.js') }}"></script>
    <script src="{{ asset('admin/assets/js/dashboards-crm.js') }}"></script>
    <script src="{{asset('admin/assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-3 col-sm-6 mb-4">
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="card-title mb-0">
                        <h5 class="mb-0 me-2">{{ $totalDepartment }}</h5>
                        <small>Total Kejuruan Aktif</small>
                    </div>
                    <div class="card-icon">
                        <span class="badge bg-label-primary rounded-pill p-2">
                            <i class='ti ti-tool ti-sm'></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 mb-4">
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="card-title mb-0">
                        <h5 class="mb-0 me-2">{{ $totalTraining }}</h5>
                        <small>Total Pelatihan Aktif</small>
                    </div>
                    <div class="card-icon">
                        <span class="badge bg-label-success rounded-pill p-2">
                            <i class='ti ti-school ti-sm'></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 mb-4">
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="card-title mb-0">
                        <h5 class="mb-0 me-2">{{ $totalParticipants }}</h5>
                        <small>Total Peserta Pelatihan Aktif</small>
                    </div>
                    <div class="card-icon">
                        <span class="badge bg-label-danger rounded-pill p-2">
                            <i class='ti ti-users ti-sm'></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 mb-4">
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="card-title mb-0">
                        <h5 class="mb-0 me-2">{{ $totalComplaint }}</h5>
                        <small>Pengaduan Masuk</small>
                    </div>
                    <div class="card-icon">
                        <span class="badge bg-label-warning rounded-pill p-2">
                            <i class='ti ti-message-report ti-sm'></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="col-12 col-xl-12 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="card-title mb-0">
                        <h5 class="mb-0">Total Peserta Pelatihan Aktif</h5>
                        <small class="text-muted"></small>
                    </div>
                    <div class="dropdown">
                        <button class="btn p-0" type="button" id="earningReportsTabsId" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="ti ti-dots-vertical ti-sm text-muted"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="earningReportsTabsId">
                            <a class="dropdown-item" href="javascript:void(0);">View More</a>
                            <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs widget-nav-tabs pb-3 gap-4 mx-1 d-flex flex-nowrap" role="tablist">
                        <li class="nav-item">
                            <a href="javascript:void(0);"
                                class="nav-link btn active d-flex flex-column align-items-center justify-content-center"
                                role="tab" data-bs-toggle="tab" data-bs-target="#navs-orders-id"
                                aria-controls="navs-orders-id" aria-selected="true">
                                <div class="badge bg-label-secondary rounded p-2"><i class="ti ti-coffee ti-sm"></i>
                                </div>
                                <h6 class="tab-widget-title mb-0 mt-2">Pariwisata</h6>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0);"
                                class="nav-link btn d-flex flex-column align-items-center justify-content-center"
                                role="tab" data-bs-toggle="tab" data-bs-target="#navs-sales-id"
                                aria-controls="navs-sales-id" aria-selected="false">
                                <div class="badge bg-label-secondary rounded p-2"><i class="ti ti-bolt ti-sm"></i></div>
                                <h6 class="tab-widget-title mb-0 mt-2">Listrik</h6>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0);"
                                class="nav-link btn d-flex flex-column align-items-center justify-content-center"
                                role="tab" data-bs-toggle="tab" data-bs-target="#navs-profit-id"
                                aria-controls="navs-profit-id" aria-selected="false">
                                <div class="badge bg-label-secondary rounded p-2"><i class="ti ti-snowflake ti-sm"></i>
                                </div>
                                <h6 class="tab-widget-title mb-0 mt-2">T.Pendingin</h6>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0);"
                                class="nav-link btn d-flex flex-column align-items-center justify-content-center"
                                role="tab" data-bs-toggle="tab" data-bs-target="#navs-income-id"
                                aria-controls="navs-income-id" aria-selected="false">
                                <div class="badge bg-label-secondary rounded p-2"><i class="ti ti-building ti-sm"></i>
                                </div>
                                <h6 class="tab-widget-title mb-0 mt-2">Bangunan</h6>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0);"
                                class="nav-link btn d-flex flex-column align-items-center justify-content-center"
                                role="tab" data-bs-toggle="tab" data-bs-target="#navs-income-id"
                                aria-controls="navs-income-id" aria-selected="false">
                                <div class="badge bg-label-secondary rounded p-2"><i class="ti ti-tool ti-sm"></i></div>
                                <h6 class="tab-widget-title mb-0 mt-2">Otomotif</h6>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0);"
                                class="nav-link btn d-flex flex-column align-items-center justify-content-center"
                                role="tab" data-bs-toggle="tab" data-bs-target="#navs-income-id"
                                aria-controls="navs-income-id" aria-selected="false">
                                <div class="badge bg-label-secondary rounded p-2"><i class="ti ti-flame ti-sm"></i></div>
                                <h6 class="tab-widget-title mb-0 mt-2">Las</h6>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0);"
                                class="nav-link btn d-flex flex-column align-items-center justify-content-center"
                                role="tab" data-bs-toggle="tab" data-bs-target="#navs-income-id"
                                aria-controls="navs-income-id" aria-selected="false">
                                <div class="badge bg-label-secondary rounded p-2"><i
                                        class="ti ti-device-desktop ti-sm"></i>
                                </div>
                                <h6 class="tab-widget-title mb-0 mt-2">TIK</h6>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content p-0 ms-0 ms-sm-2">
                        <div class="tab-pane fade show active" id="navs-orders-id" role="tabpanel">
                            <div id="earningReportsTabsOrders"></div>
                        </div>
                        <div class="tab-pane fade" id="navs-sales-id" role="tabpanel">
                            <div id="earningReportsTabsSales"></div>
                        </div>
                        <div class="tab-pane fade" id="navs-profit-id" role="tabpanel">
                            <div id="earningReportsTabsProfit"></div>
                        </div>
                        <div class="tab-pane fade" id="navs-income-id" role="tabpanel">
                            <div id="earningReportsTabsIncome"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-8 col-sm-12 order-1 order-lg-2 mb-4 mb-lg-0">
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="datatables-projects table border-top">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Name</th>
                                <th>Leader</th>
                                <th>Team</th>
                                <th class="w-px-200">Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div> --}}
    </div>

@endsection
