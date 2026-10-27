@extends('admin.layouts.layoutMaster')

@section('title', 'Pelatihan')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('admin/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('admin/assets/js/workshop-index.js') }}"></script>
    <script>
        (function() {
            const successMsg = "{{ session('swal-success') }}";
            const errorMsg = "{{ session('swal-error') }}";

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

            function populateEditExtraFields(data) {
                if (!data) return;

                $('#editRegistrationLink').val(data.registration_link || '');
                $('.edit-benefit-checkbox').prop('checked', false);

                let benefits = data.benefits;
                if (typeof benefits === 'string') {
                    try {
                        benefits = JSON.parse(benefits);
                    } catch (e) {
                        benefits = [];
                    }
                }

                if (Array.isArray(benefits)) {
                    $('.edit-benefit-checkbox').each(function() {
                        if (benefits.includes($(this).val())) {
                            $(this).prop('checked', true);
                        }
                    });
                }
            }

            $(document).ajaxSuccess(function(event, xhr, settings) {
                if (settings.url && settings.url.includes('/edit') && xhr.responseJSON) {
                    populateEditExtraFields(xhr.responseJSON);
                }
            });

            $(document).on('click', '.datatables-workshops tbody tr a, .datatables-workshops tbody tr button', function() {
                const tableEl = $('.datatables-workshops');
                if ($.fn.DataTable.isDataTable(tableEl)) {
                    const tr = $(this).closest('tr');
                    const rowData = tableEl.DataTable().row(tr).data();
                    if (rowData) {
                        setTimeout(function() {
                            populateEditExtraFields(rowData);
                        }, 100);
                    }
                }
            });
        })();
    </script>
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Manajemen Data /</span> Pelatihan
    </h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table class="datatables-workshops table">
                <thead>
                    <tr>
                        <th></th>
                        <th>No</th>
                        <th>Nama Pelatihan</th>
                        <th>Kejuruan</th>
                        <th>Link Proglat Kemnaker</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="offcanvas offcanvas-end" id="add-new-record">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title">Tambah Pelatihan Baru</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
            <form class="pt-0 row g-2" id="form-add-new-record" method="POST" action="{{ route('admin.workshop.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="col-sm-12">
                    <label class="form-label">Nama Pelatihan</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="ti ti-school"></i></span>
                        <input type="text" name="name" class="form-control"
                            placeholder="Contoh: Desainer Multimedia Muda" required />
                    </div>
                </div>

                <div class="col-sm-12">
                    <label class="form-label">Nama Kejuruan</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="ti ti-bookmarks"></i></span>
                        <select name="department_id" class="form-select" required>
                            <option value="" disabled selected>Pilih Kejuruan</option>
                            @foreach ($departments as $dept)
                                <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-sm-12">
                    <label class="form-label">Link Proglat Kemnaker</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="ti ti-link"></i></span>
                        <input type="url" name="external_link" class="form-control"
                            placeholder="https://proglat.kemnaker.go.id/..." required />
                    </div>
                </div>

                <div class="col-sm-12">
                    <label class="form-label">Link SIAPkerja</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="ti ti-external-link"></i></span>
                        <input type="url" name="registration_link" class="form-control"
                            placeholder="https://pelatihan.kemnaker.go.id/..." />
                    </div>
                </div>

                <div class="col-sm-12 mt-2">
                    <label class="form-label d-block mb-2">Benefit Pelatihan</label>
                    <div class="border rounded p-3 bg-lighter">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="benefits[]" value="Biaya pelatihan GRATIS!" id="addBenefit1" checked>
                            <label class="form-check-label" for="addBenefit1">Biaya pelatihan GRATIS!</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="benefits[]" value="Uang saku" id="addBenefit2" checked>
                            <label class="form-check-label" for="addBenefit2">Uang saku</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="benefits[]" value="Makan siang selama pelatihan" id="addBenefit3" checked>
                            <label class="form-check-label" for="addBenefit3">Makan siang selama pelatihan</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="benefits[]" value="Seragam lengkap" id="addBenefit4" checked>
                            <label class="form-check-label" for="addBenefit4">Seragam lengkap</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="benefits[]" value="Sertifikasi BNSP" id="addBenefit5" checked>
                            <label class="form-check-label" for="addBenefit5">Sertifikasi BNSP</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="benefits[]" value="Sertifikat pelatihan" id="addBenefit6" checked>
                            <label class="form-check-label" for="addBenefit6">Sertifikat pelatihan</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="benefits[]" value="Pengalaman kerja melalui On the Job Training (OJT)" id="addBenefit7">
                            <label class="form-check-label" for="addBenefit7">Pengalaman kerja melalui On the Job Training (OJT)</label>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <label class="form-label">Foto Pelatihan</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="ti ti-image"></i></span>
                        <input type="file" name="image" class="form-control" accept="image/png, image/jpeg, image/jpg, image/webp" />
                    </div>
                </div>

                <div class="col-sm-12 mt-4">
                    <button type="submit" class="btn btn-primary me-sm-3 me-1">Simpan</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <div class="offcanvas offcanvas-end" id="edit-record">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title">Edit Pelatihan</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
            <form class="pt-0 row g-2" id="form-edit-record" method="POST" action="" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="col-sm-12">
                    <label class="form-label">Nama Pelatihan</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="ti ti-school"></i></span>
                        <input type="text" id="editName" name="name" class="form-control" />
                    </div>
                </div>

                <div class="col-sm-12">
                    <label class="form-label">Nama Kejuruan</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="ti ti-bookmarks"></i></span>
                        <select name="department_id" id="editDepartment" class="form-select">
                            @foreach ($departments as $dept)
                                <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-sm-12">
                    <label class="form-label">Link Proglat Kemnaker</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="ti ti-link"></i></span>
                        <input type="url" id="editLink" name="external_link" class="form-control" />
                    </div>
                </div>

                <div class="col-sm-12">
                    <label class="form-label">Link SIAPkerja</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="ti ti-external-link"></i></span>
                        <input type="url" id="editRegistrationLink" name="registration_link" class="form-control"
                            placeholder="https://pelatihan.kemnaker.go.id/..." />
                    </div>
                </div>

                <div class="col-sm-12 mt-2">
                    <label class="form-label d-block mb-2">Benefit Pelatihan</label>
                    <div class="border rounded p-3 bg-lighter">
                        <div class="form-check mb-2">
                            <input class="form-check-input edit-benefit-checkbox" type="checkbox" name="benefits[]" value="Biaya pelatihan GRATIS!" id="editBenefit1">
                            <label class="form-check-label" for="editBenefit1">Biaya pelatihan GRATIS!</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input edit-benefit-checkbox" type="checkbox" name="benefits[]" value="Uang saku" id="editBenefit2">
                            <label class="form-check-label" for="editBenefit2">Uang saku</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input edit-benefit-checkbox" type="checkbox" name="benefits[]" value="Makan siang selama pelatihan" id="editBenefit3">
                            <label class="form-check-label" for="editBenefit3">Makan siang selama pelatihan</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input edit-benefit-checkbox" type="checkbox" name="benefits[]" value="Seragam lengkap" id="editBenefit4">
                            <label class="form-check-label" for="editBenefit4">Seragam lengkap</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input edit-benefit-checkbox" type="checkbox" name="benefits[]" value="Sertifikasi BNSP" id="editBenefit5">
                            <label class="form-check-label" for="editBenefit5">Sertifikasi BNSP</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input edit-benefit-checkbox" type="checkbox" name="benefits[]" value="Sertifikat pelatihan" id="editBenefit6">
                            <label class="form-check-label" for="editBenefit6">Sertifikat pelatihan</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input edit-benefit-checkbox" type="checkbox" name="benefits[]" value="Pengalaman kerja melalui On the Job Training (OJT)" id="editBenefit7">
                            <label class="form-check-label" for="editBenefit7">Pengalaman kerja melalui On the Job Training (OJT)</label>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 text-center" id="preview-container">
                </div>

                <div class="col-sm-12">
                    <label class="form-label">Ganti Foto (Opsional)</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="ti ti-image"></i></span>
                        <input type="file" name="image" class="form-control" accept="image/*" />
                    </div>
                </div>

                <div class="col-sm-12">
                    <label class="form-label">Status</label>
                    <select name="status" id="editStatus" class="form-select">
                        <option value="1">Aktif</option>
                        <option value="0">Nonaktif</option>
                    </select>
                </div>

                <div class="col-sm-12 mt-4">
                    <button type="submit" class="btn btn-primary me-sm-3 me-1">Perbarui</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <form id="delete-form" action="" method="POST" class="d-none">
        @csrf
        @method('DELETE')
    </form>
@endsection
