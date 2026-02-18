@extends('admin.layouts.layoutMaster')

@section('title', 'Manajemen Fasilitas')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('admin/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
@endsection

@section('page-script')
    <script>
        $(function() {
            var dt_facility_table = $('.datatables-facilities');

            if (dt_facility_table.length) {
                var dt_facility = dt_facility_table.DataTable({
                    processing: true,
                    ajax: "{{ route('admin.facility.index') }}",
                    columns: [{
                            data: 'id'
                        },
                        {
                            data: 'image'
                        },
                        {
                            data: 'name'
                        },
                        {
                            data: 'status'
                        },
                        {
                            data: ''
                        }
                    ],
                    columnDefs: [{
                            targets: 0,
                            render: function(data, type, full, meta) {
                                return meta.row + 1;
                            }
                        },
                        {
                            targets: 1,
                            render: function(data, type, full) {
                                var $image = full['image'];
                                if ($image) {
                                    return '<img src="{{ asset('storage') }}/' + $image +
                                        '" class="rounded" width="100" height="100" style="object-fit: cover">';
                                } else {
                                    return '<span class="badge bg-label-secondary">No Image</span>';
                                }
                            }
                        },
                        {
                            targets: 3,
                            render: function(data, type, full) {
                                return data ? '<span class="badge bg-label-success">Aktif</span>' :
                                    '<span class="badge bg-label-danger">Nonaktif</span>';
                            }
                        },
                        {
                            targets: -1,
                            title: 'Aksi',
                            orderable: false,
                            render: function(data, type, full) {
                                return (
                                    '<div class="d-inline-block text-nowrap">' +
                                    '<button class="btn btn-sm btn-icon edit-record" data-id="' +
                                    full['slug'] + '"><i class="ti ti-edit"></i></button>' +
                                    '<button class="btn btn-sm btn-icon delete-record" data-id="' +
                                    full['slug'] + '"><i class="ti ti-trash"></i></button>' +
                                    '</div>'
                                );
                            }
                        }
                    ],
                    dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                    buttons: [{
                        text: '<i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Tambah Fasilitas</span>',
                        className: 'create-new btn btn-primary',
                        attr: {
                            'data-bs-toggle': 'offcanvas',
                            'data-bs-target': '#offcanvasAddFacility'
                        }
                    }]
                });
                $('div.head-label').html('<h5 class="card-title mb-0">Daftar Fasilitas</h5>');
            }
        });

        $(function() {
            const offcanvasElement = document.getElementById('offcanvasAddFacility');
            const offcanvasInstance = new bootstrap.Offcanvas(offcanvasElement);
            const formFacility = $('#form-facility');

            // 1. Logic untuk Tombol EDIT
            $(document).on('click', '.edit-record', function() {
                var slug = $(this).data('id');

                // Ambil data via AJAX
                $.get("{{ url('admin/facility') }}/" + slug, function(data) {
                    $('#offcanvasAddFacilityLabel').html('Edit Fasilitas');
                    formFacility.attr('action', "{{ url('admin/facility') }}/" + data
                        .slug);
                    $('#method-field').html('<input type="hidden" name="_method" value="PUT">');

                    // Isi form
                    $('#facility-name').val(data.name);

                    // Tampilkan preview gambar jika ada
                    if (data.image) {
                        $('#preview-image').html('<img src="{{ asset('storage') }}/' +
                            data.image +
                            '" class="img-fluid rounded border mb-2" style="max-height: 100px;">'
                        );
                    } else {
                        $('#preview-image').empty();
                    }

                    offcanvasInstance.show();
                });
            });

            // 2. Reset Form saat Offcanvas ditutup (agar kembali ke mode "Tambah")
            offcanvasElement.addEventListener('hidden.bs.offcanvas', function() {
                $('#offcanvasAddFacilityLabel').html('Tambah Fasilitas');
                formFacility.attr('action', "{{ route('admin.facility.store') }}");
                $('#method-field').empty();
                $('#preview-image').empty();
                formFacility[0].reset();
            });

            // 3. Logic untuk Tombol DELETE (SweetAlert)
            $(document).on('click', '.delete-record', function() {
                var slug = $(this).data('id');

                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus!',
                    customClass: {
                        confirmButton: 'btn btn-primary me-3',
                        cancelButton: 'btn btn-label-secondary'
                    },
                    buttonsStyling: false
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            type: 'DELETE',
                            url: "{{ url('admin/facility') }}/" + slug,
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function() {
                                $('.datatables-facilities').DataTable().ajax
                                    .reload();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Terhapus!',
                                    text: 'Fasilitas telah dihapus.',
                                    customClass: {
                                        confirmButton: 'btn btn-primary'
                                    }
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Sarana & Prasarana /</span> Fasilitas</h4>

    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-facilities table border-top">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Nama Fasilitas</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddFacility"
        aria-labelledby="offcanvasAddFacilityLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasAddFacilityLabel" class="offcanvas-title">Tambah Fasilitas</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
            <form class="add-new-facility pt-0" id="form-facility" action="{{ route('admin.facility.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                <div id="method-field"></div>

                <div class="mb-3">
                    <label class="form-label">Nama Fasilitas</label>
                    <input type="text" class="form-control" name="name" id="facility-name"
                        placeholder="Contoh: Gedung Serbaguna" required />
                </div>
                <div class="mb-3">
                    <label class="form-label">Foto Fasilitas</label>
                    <div id="preview-image" class="mb-2"></div>
                    <input type="file" class="form-control" name="image" accept="image/*" />
                    <small class="text-muted">Maksimal 10MB (jpg, png, webp)</small>
                </div>
                <button type="submit" class="btn btn-primary me-sm-3 me-1">Simpan</button>
                <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Batal</button>
            </form>
        </div>
    </div>
@endsection
