@extends('admin.layouts.layoutMaster')

@section('title', 'Detail Kejuruan - ' . $department->name)

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('admin/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
@endsection

@section('page-script')
    <script>
        // Script simpel untuk inisialisasi datatable khusus pelatihan di kejuruan ini
        $(function() {
            var dt_table = $('.datatable-workshops');
            if (dt_table.length) {
                dt_table.DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.department.show', $department->slug) }}",
                    columns: [{
                            data: 'id'
                        },
                        {
                            data: 'name'
                        },
                        {
                            data: 'external_link',
                            className: 'text-center'
                        },
                        {
                            data: 'status'
                        }
                    ],
                    columnDefs: [{
                            targets: 0,
                            render: function(data, type, full, meta) {
                                return meta.row + 1;
                            }
                        },
                        {
                            targets: 2,
                            render: function(data, type, full) {
                                return '<a href="' + data +
                                    '" target="_blank" class="btn btn-sm btn-icon btn-label-primary"><i class="ti ti-link"></i></a>';
                            }
                        },
                        {
                            targets: 3,
                            render: function(data, type, full) {
                                var status = {
                                    1: {
                                        title: 'Aktif',
                                        class: 'bg-label-success'
                                    },
                                    0: {
                                        title: 'Nonaktif',
                                        class: 'bg-label-secondary'
                                    }
                                };
                                return '<span class="badge ' + status[data].class + '">' + status[
                                    data].title + '</span>';
                            }
                        }
                    ],
                    // Pengaturan tampilan agar pagination rapi
                    displayLength: 10,
                    lengthMenu: [10, 10, 25, 50],
                    dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                    language: {
                        sLengthMenu: '_MENU_',
                        search: '',
                        searchPlaceholder: 'Cari Program..',
                        // Ini akan menghilangkan pagination berlebih jika data kosong
                        emptyTable: "Tidak ada program pelatihan di kejuruan ini"
                    }
                });
            }
        });
    </script>
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard / Kejuruan /</span> Detail Kejuruan
    </h4>
    <div class="row">
        <div class="col-xl-4 col-lg-5 col-md-5">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="user-avatar-section">
                        <div class="d-flex align-items-center flex-column">
                            <img class="img-fluid rounded mb-3 pt-1 mt-4"
                                src="{{ $department->image ? $department->image_url : asset('admin/assets/img/illustrations/page-pricing-enterprise.png') }}"
                                height="120" width="120" alt="Department image" />
                            <div class="user-info text-center">
                                <h4 class="mb-2">{{ $department->name }}</h4>
                                <span class="badge bg-label-primary mt-1">Kejuruan</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-around flex-wrap mt-3 pt-3 pb-4 border-bottom">
                        <div class="d-flex align-items-start me-4 mt-3 gap-2">
                            <span class="badge bg-label-primary p-2 rounded"><i class='ti ti-school ti-sm'></i></span>
                            <div>
                                <p class="mb-0 fw-semibold">{{ $department->total_workshops }}</p>
                                <small>Total Pelatihan</small>
                            </div>
                        </div>
                    </div>
                    <p class="mt-4 small text-uppercase text-muted">Deskripsi</p>
                    <div class="info-container">
                        <p class="mb-3" style="text-align: justify;">
                            {{ $department->description ?? 'Belum ada deskripsi untuk kejuruan ini.' }}
                        </p>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <span class="fw-semibold me-1">Status:</span>
                                <span class="badge {{ $department->status ? 'bg-label-success' : 'bg-label-secondary' }}">
                                    {{ $department->status ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </li>
                        </ul>
                        <div class="d-flex justify-content-center mt-4">
                            <a href="{{ route('admin.department.index') }}" class="btn btn-label-primary w-100">
                                Kembali ke Daftar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-lg-7 col-md-7">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Daftar Program Pelatihan</h5>
                </div>
                <div class="card-datatable table-responsive">
                    <table class="datatable-workshops table border-top">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Program</th>
                                <th class="text-center">Link</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
