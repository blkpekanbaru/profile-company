@extends('admin.layouts.layoutMaster')

@section('title', 'Kejuruan')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <!-- Form Validation -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('admin/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <!-- Form Validation -->
    <script src="{{ asset('admin/assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>

    <script src="{{ asset('admin/assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('admin/assets/js/department-index.js') }}"></script>
    <script>
        (function() {
            const successMsg = "{{ session('swal-success') }}";
            const errorMsg = "{{ session('swal-error') }}";

            @if ($errors->any())
                let validationErrors = "";
                @foreach ($errors->all() as $error)
                    validationErrors += "{{ $error }}\n";
                @endforeach

                Swal.fire({
                    title: 'Validasi Gagal!',
                    text: validationErrors,
                    icon: 'error',
                    customClass: {
                        confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false
                });
            @endif

            if (successMsg) {
                Swal.fire({
                    title: 'Berhasil!',
                    text: successMsg,
                    icon: 'success',
                    customClass: {
                        confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false
                });
            }

            if (errorMsg) {
                Swal.fire({
                    title: 'Error!',
                    text: errorMsg,
                    icon: 'error',
                    customClass: {
                        confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false
                });
            }
        })();
    </script>
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard /</span> Kejuruan
    </h4>

    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table class="datatables-basic table">
                <thead>
                    <tr>
                        <th></th>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Total Pelatihan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <form id="delete-form" action="" method="POST" class="d-none">
        @csrf
        @method('DELETE')
    </form>
    <!-- Modal to add new record -->
    <div class="offcanvas offcanvas-end" id="add-new-record">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title" id="exampleModalLabel">Tambah Kejuruan Baru</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
            <form class="add-new-record pt-0 row g-2" id="form-add-new-record" method="POST"
                action="{{ route('admin.department.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="col-sm-12">
                    <label class="form-label" for="basicFullname">Nama Kejuruan</label>
                    <div class="input-group input-group-merge">
                        <span id="basicFullname2" class="input-group-text"><i class="ti ti-bookmarks"></i></span>
                        <input type="text" id="basicFullname" class="form-control dt-full-name" name="name"
                            placeholder="Contoh: TIK" aria-label="Nama Kejuruan" aria-describedby="basicFullname2" />
                    </div>
                </div>

                <div class="col-sm-12">
                    <label class="form-label" for="basicPost">Deskripsi</label>
                    <div class="input-group input-group-merge">
                        <span id="basicPost2" class="input-group-text"><i class='ti ti-notes'></i></span>
                        <textarea id="basicPost" name="description" class="form-control dt-post" placeholder="Deskripsi singkat kejuruan..."
                            aria-label="Deskripsi" aria-describedby="basicPost2"></textarea>
                    </div>
                </div>

                <div class="col-sm-12">
                    <label class="form-label" for="basicEmail">Foto Kejuruan</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="ti ti-image"></i></span>
                        <input type="file" id="basicEmail" name="image" class="form-control dt-email"
                            accept="image/*" />
                    </div>
                    <div class="form-text">
                        Gunakan format JPEG/JPG/PNG/WEBP, ukuran maksimal 10MB.
                    </div>
                </div>

                <div class="col-sm-12">
                    <label class="form-label" for="basicSalary">Status</label>
                    <div class="input-group input-group-merge">
                        <span id="basicSalary2" class="input-group-text"><i class='ti ti-toggle-left'></i></span>
                        <select id="basicSalary" name="status" class="form-select dt-salary">
                            <option value="" selected disabled>Pilih Status</option>
                            <option value="1">Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-12 mt-3">
                    <button type="submit" class="btn btn-primary data-submit me-sm-3 me-1">Simpan</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Batal</button>
                </div>
            </form>
        </div>
    </div>
    <!--/ Modal to add new record -->

    {{-- Modal for Edit --}}
    <div class="offcanvas offcanvas-end" id="edit-record">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title">Edit Kejuruan</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
            <form class="pt-0 row g-2" id="form-edit-record" method="POST" action=""
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="col-sm-12">
                    <label class="form-label" for="editName">Nama Kejuruan</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="ti ti-bookmarks"></i></span>
                        <input type="text" id="editName" class="form-control" name="name"
                            placeholder="Contoh: TIK" />
                    </div>
                </div>

                <div class="col-sm-12">
                    <label class="form-label" for="editDescription">Deskripsi</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class='ti ti-notes'></i></span>
                        <textarea id="editDescription" name="description" class="form-control" placeholder="Deskripsi..."></textarea>
                    </div>
                </div>

                <div class="col-sm-12 text-center" id="preview-container">
                </div>

                <div class="col-sm-12">
                    <label class="form-label" for="editImage">Foto Baru (Opsional)</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="ti ti-image"></i></span>
                        <input type="file" id="editImage" name="image" class="form-control" accept="image/*" />
                    </div>
                    <div class="form-text">
                        Gunakan format JPEG/JPG/PNG/WEBP, ukuran maksimal 10MB.
                    </div>
                </div>

                <div class="col-sm-12">
                    <label class="form-label" for="editStatus">Status</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class='ti ti-toggle-left'></i></span>
                        <select id="editStatus" name="status" class="form-select">
                            <option value="1">Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-12 mt-3">
                    <button type="submit" class="btn btn-primary me-sm-3 me-1">Perbarui</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Batal</button>
                </div>
            </form>
        </div>
    </div>
    {{-- / Modal for Edit --}}
    <hr class="my-5">
@endsection
