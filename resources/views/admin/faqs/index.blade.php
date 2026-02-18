@extends('admin.layouts.layoutMaster')

@section('title', 'Manajemen FAQ')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/animate-css/animate.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('admin/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
@endsection

@section('page-script')
    <script>
        $(function() {
            const offcanvasElement = document.getElementById('offcanvasFaq');
            const offcanvasFaq = new bootstrap.Offcanvas(offcanvasElement);
            const formFaq = $('#form-faq');

            // Datatable Initialization
            var dt_faq = $('.datatables-faq').DataTable({
                processing: true,
                ajax: "{{ route('admin.faq.index') }}",
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'question'
                    },
                    {
                        data: 'answer'
                    },
                    {
                        data: 'is_active'
                    },
                    {
                        data: ''
                    }
                ],
                dom: '<"card-header flex-column flex-md-row"<"head-label"><"dt-action-buttons text-end"B>><"row"<"col-md-6"l><"col-md-6"f>>t<"row"<"col-md-6"i><"col-md-6"p>>',
                buttons: [{
                    text: '<i class="ti ti-plus me-1"></i> Tambah FAQ',
                    className: 'btn btn-primary',
                    action: function() {
                        offcanvasFaq.show();
                    }
                }],
                columnDefs: [{
                        targets: 0,
                        render: (data, type, full, meta) => meta.row + 1
                    },
                    {
                        targets: 2, // Answer
                        render: (data) => data.length > 50 ? data.substr(0, 50) + '...' : data
                    },
                    {
                        targets: 3, // Status
                        render: (data) => {
                            return data ?
                                '<span class="badge bg-label-success">Aktif</span>' :
                                '<span class="badge bg-label-secondary">Non-Aktif</span>';
                        }
                    },
                    {
                        targets: -1, // Actions
                        render: (data, type, full) =>
                            `
                        <button class="btn btn-sm btn-icon edit-record" data-id="${full.id}"><i class="ti ti-edit"></i></button>
                        <button class="btn btn-sm btn-icon delete-record" data-id="${full.id}"><i class="ti ti-trash"></i></button>`
                    }
                ]
            });

            $('div.head-label').html('<h5 class="card-title mb-0">Daftar Pertanyaan Umum (FAQ)</h5>');

            // Create/Update Submit
            formFaq.on('submit', function(e) {
                e.preventDefault();
                let url = formFaq.attr('action');
                let data = $(this).serialize();

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: data,
                    success: function(res) {
                        offcanvasFaq.hide();
                        dt_faq.ajax.reload();
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: res.success,
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            }
                        });
                    },
                    error: function(err) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ups!',
                            text: 'Terjadi kesalahan input.',
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            }
                        });
                    }
                });
            });

            // Edit Record
            $(document).on('click', '.edit-record', function() {
                var id = $(this).data('id');
                $.get("{{ url('admin/faq/show') }}/" + id, function(data) {
                    $('#offcanvasFaqLabel').text('Edit FAQ');
                    formFaq.attr('action', "{{ url('admin/faq/update') }}/" + data.id);
                    $('#method-field').html('<input type="hidden" name="_method" value="PUT">');

                    $('#faq-question').val(data.question);
                    $('#faq-answer').val(data.answer);
                    $('#faq-status').val(data.is_active);
                    $('#faq-order').val(data.sort_order);

                    offcanvasFaq.show();
                });
            });

            // Delete Record
            $(document).on('click', '.delete-record', function() {
                var id = $(this).data('id');
                Swal.fire({
                    title: 'Yakin hapus FAQ?',
                    text: "Data tidak bisa dikembalikan!",
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
                            url: "{{ url('admin/faq/delete') }}/" + id,
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function() {
                                dt_faq.ajax.reload();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Terhapus!',
                                    text: 'FAQ berhasil dihapus.',
                                    customClass: {
                                        confirmButton: 'btn btn-primary'
                                    }
                                });
                            }
                        });
                    }
                });
            });

            // Reset Offcanvas on hide
            offcanvasElement.addEventListener('hidden.bs.offcanvas', function() {
                $('#offcanvasFaqLabel').text('Tambah FAQ');
                formFaq.attr('action', "{{ route('admin.faq.store') }}");
                $('#method-field').empty();
                formFaq[0].reset();
            });
        });
    </script>
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Manajemen /</span> FAQ</h4>

    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-faq table border-top">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pertanyaan</th>
                        <th>Jawaban</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasFaq" aria-labelledby="offcanvasFaqLabel">
        <div class="offcanvas-header border-bottom">
            <h5 id="offcanvasFaqLabel" class="offcanvas-title">Tambah FAQ</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100 mt-3">
            <form id="form-faq" action="{{ route('admin.faq.store') }}" method="POST">
                @csrf
                <div id="method-field"></div>

                <div class="mb-3">
                    <label class="form-label">Pertanyaan</label>
                    <input type="text" class="form-control" name="question" id="faq-question"
                        placeholder="Misal: Bagaimana cara mendaftar?" required />
                </div>

                <div class="mb-3">
                    <label class="form-label">Jawaban</label>
                    <textarea class="form-control" name="answer" id="faq-answer" rows="5"
                        placeholder="Tulis jawaban lengkap di sini..." required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Urutan Tampil</label>
                    <input type="number" class="form-control" name="sort_order" id="faq-order" value="0" />
                </div>

                <div class="mb-4">
                    <label class="form-label">Status</label>
                    <select name="is_active" id="faq-status" class="form-select">
                        <option value="1">Aktif</option>
                        <option value="0">Non-Aktif</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Simpan</button>
                <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Batal</button>
            </form>
        </div>
    </div>
@endsection
