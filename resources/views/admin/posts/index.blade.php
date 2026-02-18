@extends('admin.layouts.layoutMaster')

@section('title', 'Manajemen Informasi dan Berita')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/quill/editor.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection

@section('page-style')
    <style>
        .image-preview-wrapper {
            position: relative;
            display: inline-block;
        }

        .delete-checkbox {
            position: absolute;
            top: -5px;
            right: -5px;
            background: white;
            border-radius: 50%;
            padding: 2px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            z-index: 10;
        }

        .delete-checkbox input:checked+img {
            filter: grayscale(1) opacity(0.5);
            border: 2px solid red;
        }
    </style>
@endsection

@section('vendor-script')
    <script src="{{ asset('admin/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/quill/quill.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
@endsection

@section('page-script')
    <script>
        $(function() {
            var quill = new Quill('#editor-container', {
                theme: 'snow'
            });
            const offcanvasEl = document.getElementById('offcanvasInfo');
            const offcanvasInst = new bootstrap.Offcanvas(document.getElementById('offcanvasInfo'));
            const formInfo = $('#form-info');

            var dt_info = $('.datatables-info').DataTable({
                processing: true,
                ajax: "{{ route('admin.information.index') }}",
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'images'
                    },
                    {
                        data: 'title'
                    },
                    {
                        data: 'categories'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: ''
                    }
                ],
                // TAMBAHKAN BAGIAN INI:
                dom: '<"card-header flex-column flex-md-row"<"head-label"><"dt-action-buttons text-end"B>><"row"<"col-md-6"l><"col-md-6"f>>t<"row"<"col-md-6"i><"col-md-6"p>>',
                buttons: [{
                    text: '<i class="ti ti-plus me-1"></i> Tambah Informasi',
                    className: 'btn btn-primary',
                    action: function() {
                        offcanvasInst.show();
                    }
                }],
                columnDefs: [{
                        targets: 0,
                        render: (data, type, full, meta) => meta.row + 1
                    },
                    {
                        targets: 1,
                        render: (data) => data.length > 0 ?
                            `<img src="{{ asset('storage') }}/${data[0].path}" width="50" class="rounded">` :
                            '<span class="badge bg-label-secondary">No Image</span>'
                    },
                    {
                        targets: 3, // Render Multiple Badges
                        render: function(data) {
                            let badges = '';
                            const colors = {
                                'berita': 'info',
                                'pengumuman': 'danger',
                                'pelatihan': 'warning'
                            };
                            data.forEach(item => {
                                badges +=
                                    `<span class="badge bg-label-${colors[item.category]} me-1">${item.category.toUpperCase()}</span>`;
                            });
                            return badges || '-';
                        }
                    },
                    {
                        targets: 4,
                        render: (data) => {
                            const statusMap = {
                                'published': 'success',
                                'draft': 'secondary',
                                'archived': 'danger'
                            };
                            return `<span class="badge bg-label-${statusMap[data] || 'primary'}">${data.toUpperCase()}</span>`;
                        }
                    },
                    {
                        targets: -1,
                        render: (data, type, full) =>
                            `
                    <a href="{{ url('admin/information') }}/${full.slug}" target="_blank" class="btn btn-sm btn-icon"><i class="ti ti-eye"></i></a>
                    <button class="btn btn-sm btn-icon edit-record" data-id="${full.slug}"><i class="ti ti-edit"></i></button>
                    <button class="btn btn-sm btn-icon delete-record" data-id="${full.slug}"><i class="ti ti-trash"></i></button>`
                    }
                ]
            });

            $('div.head-label').html('<h5 class="card-title mb-0">Daftar Informasi dan Pengumuman</h5>');

            $(document).on('click', '.edit-record', function() {
                var slug = $(this).data('id');
                $.get("{{ url('admin/information/show') }}/" + slug, function(data) {
                    console.log(data);
                    $('#offcanvasInfoLabel').text('Edit Informasi');
                    formInfo.attr('action', "{{ url('admin/information/update') }}/" + data.slug);
                    $('#method-field').html('<input type="hidden" name="_method" value="PUT">');
                    $('#status-group').show();

                    $('#info-title').val(data.title);
                    $('#info-status').val(data.status);
                    quill.root.innerHTML = data.content;

                    // --- BAGIAN PREVIEW GAMBAR LAMA ---
                    $('#preview-image').empty();
                    if (data.images && data.images.length > 0) {
                        let htmlPreview =
                            '<label class="form-label d-block text-danger mb-2">Pilih gambar untuk dihapus:</label><div class="d-flex flex-wrap gap-3">';
                        $.each(data.images, function(index, img) {
                            // Gunakan path yang benar sesuai folder storage kamu
                            let fullPath = "{{ asset('storage') }}/" + img.path;

                            htmlPreview += `
                            <div class="image-preview-wrapper">
                                <div class="delete-checkbox">
                                    <input class="form-check-input border-danger" type="checkbox" name="delete_images[]" value="${img.id}">
                                </div>
                                <img src="${fullPath}" width="100" height="100" class="rounded object-fit-cover border" onerror="this.src='{{ asset('admin/assets/img/illustrations/page-misc-error.png') }}'">
                            </div>`;
                        });
                        htmlPreview += '</div><hr class="my-4">';
                        $('#preview-image').html(htmlPreview);
                    } else {
                        console.log("Tidak ada gambar ditemukan untuk post ini.");
                    }


                    // --- KATEGORI ---
                    $('input[name="categories[]"]').prop('checked', false);
                    if (data.categories) {
                        data.categories.forEach(item => {
                            $(`input[name="categories[]"][value="${item.category}"]`).prop(
                                'checked', true);
                        });
                    }

                    offcanvasInst.show();
                });
            });

            formInfo.on('submit', function() {
                $('#info-content').val(quill.root.innerHTML);
            });

            offcanvasEl.addEventListener('hidden.bs.offcanvas', function() {
                $('#offcanvasInfoLabel').text('Tambah Informasi');
                formInfo.attr('action', "{{ route('admin.information.store') }}");
                $('#method-field, #preview-image').empty();
                $('#status-group').hide();
                quill.setContents([]);
                $('input[name="categories[]"]').prop('checked', false);
                formInfo[0].reset();
            });

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
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: 'DELETE',
                            url: "{{ url('admin/information/delete') }}/" + slug,
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function() {
                                $('.datatables-info').DataTable().ajax
                                    .reload();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Terhapus!',
                                    text: 'Informasi telah dihapus.',
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

        @if (session('swal-success'))
            Swal.fire({
                title: 'Berhasil!',
                text: "{{ session('swal-success') }}",
                icon: 'success',
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });
        @endif

        @if (session('swal-error'))
            Swal.fire({
                title: 'Ups!',
                text: "{{ session('swal-error') }}",
                icon: 'error',
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });
        @endif
    </script>
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4">Manajemen Informasi</h4>

    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-info table border-top">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="offcanvas offcanvas-end" style="width: 50%" tabindex="-1" id="offcanvasInfo">
        <div class="offcanvas-header border-bottom">
            <h5 id="offcanvasInfoLabel" class="offcanvas-title">Tambah Informasi</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100 mt-3">
            <form id="form-info" action="{{ route('admin.information.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div id="method-field"></div>

                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" class="form-control" name="title" id="info-title" required />
                </div>

                <div class="mb-3">
                    <label class="form-label d-block">Kategori (Bisa pilih banyak)</label>
                    <div class="row g-2">
                        <div class="col-md-4">
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="catBerita">
                                    <input class="form-check-input" type="checkbox" name="categories[]" value="berita"
                                        id="catBerita" />
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">Berita</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="catPengumuman">
                                    <input class="form-check-input" type="checkbox" name="categories[]" value="pengumuman"
                                        id="catPengumuman" />
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">Pengumuman</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="catPelatihan">
                                    <input class="form-check-input" type="checkbox" name="categories[]" value="pelatihan"
                                        id="catPelatihan" />
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">Pelatihan</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Konten</label>
                    <div id="editor-container" style="height: 250px;"></div>
                    <input type="hidden" name="content" id="info-content">
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar Informasi</label>

                    <div id="preview-image"></div>

                    <div class="mt-2">
                        <label class="form-label small text-muted">Upload Gambar Baru (Bisa pilih banyak)</label>
                        <input type="file" class="form-control" name="images[]" multiple accept="image/*" />
                    </div>
                </div>

                <div class="mb-3" id="status-group" style="display: none;">
                    <label class="form-label">Status</label>
                    <select name="status" id="info-status" class="form-select">
                        <option value="published">Diterbitkan</option>
                        <option value="draft">Draft</option>
                        <option value="archived">Arsip</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Batal</button>
            </form>
        </div>
    </div>
@endsection
