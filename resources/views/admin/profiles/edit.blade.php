@extends('admin.layouts.layoutMaster')

@section('title', $pageTitle)

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/quill/typography.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/quill/katex.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/quill/editor.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('admin/assets/vendor/libs/quill/katex.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/quill/quill.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
@endsection

@section('page-script')
    <script>
        const key = "{{ $key }}";
        const formProfile = document.querySelector('#form-profile');

        // --- LOGIKA QUILL EDITOR (Untuk Profil Umum) ---
        const fullEditor = document.getElementById('full-editor');
        let quill;
        if (fullEditor) {
            quill = new Quill('#full-editor', {
                bounds: '#full-editor',
                placeholder: 'Ketik konten di sini...',
                modules: {
                    toolbar: [
                        [{
                            header: [1, 2, 3, false]
                        }],
                        ['bold', 'italic', 'underline'],
                        [{
                            list: 'ordered'
                        }, {
                            list: 'bullet'
                        }],
                        ['clean']
                    ]
                },
                theme: 'snow'
            });
            quill.root.innerHTML = {!! json_encode($profile->content) !!} || '';
        }

        // --- LOGIKA REPEATER HISTORY (Untuk Sejarah) ---
        let historyData = {!! $key == 'history' ? $profile->content ?? '[]' : '[]' !!};
        if (typeof historyData === 'string') historyData = JSON.parse(historyData);

        function renderHistory() {
            const container = $('#history-repeater-container');
            container.empty();
            historyData.forEach((item, index) => {
                container.append(`
                    <div class="card border shadow-none mb-3 history-item" data-index="${index}">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="mb-0 text-primary">Era #${index + 1}</h6>
                                <button type="button" class="btn btn-sm btn-label-danger btn-remove-history">Hapus</button>
                            </div>
                            <div class="row g-2">
                                <div class="col-md-4">
                                    <input type="text" class="form-control h-year" placeholder="Tahun" value="${item.year || ''}">
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control h-title" placeholder="Judul Era" value="${item.title || ''}">
                                </div>
                                <div class="col-12 mt-2">
                                    <textarea class="form-control h-desc" rows="2" placeholder="Deskripsi">${item.description || ''}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                `);
            });
        }

        if (key === 'history') {
            renderHistory();
            $('#add-history-item').on('click', function() {
                historyData.push({
                    year: '',
                    title: '',
                    description: ''
                });
                renderHistory();
            });
            $(document).on('click', '.btn-remove-history', function() {
                const index = $(this).closest('.history-item').data('index');
                if (confirm('Apakah Anda yakin ingin menghapus era ini dari daftar?')) {
                    historyData.splice(index, 1);
                    renderHistory();
                }
            });
        }

        // --- HANDLER SUBMIT ---
        if (formProfile) {
            formProfile.onsubmit = function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Simpan?',
                    text: "Pastikan data sudah benar",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Simpan!',
                    customClass: {
                        confirmButton: 'btn btn-primary me-3',
                        cancelButton: 'btn btn-label-secondary'
                    },
                    buttonsStyling: false
                }).then(function(result) {
                    if (result.value) {
                        if (fullEditor) document.querySelector('#content-input').value = quill.root.innerHTML;

                        if (key === 'history') {
                            let finalData = [];
                            $('.history-item').each(function() {
                                finalData.push({
                                    year: $(this).find('.h-year').val(),
                                    title: $(this).find('.h-title').val(),
                                    description: $(this).find('.h-desc').val()
                                });
                            });
                            document.querySelector('#history-json-input').value = JSON.stringify(finalData);
                        }
                        formProfile.submit();
                    }
                });
            };
        }
    </script>
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard / Profil /</span> {{ $pageTitle }}</h4>

    <div class="row">
        <div class="col-xl-4">
            <div class="card shadow-none border mb-4">
                <div class="card-header border-bottom">
                    <h5 class="mb-0">Konten Saat Ini</h5>
                </div>
                <div class="card-body mt-3">
                    @if ($key == 'structure' && $profile->image)
                        <img src="{{ $profile->image_url }}" class="img-fluid rounded border w-100"
                            alt="Struktur Organisasi">
                    @elseif($key == 'history')
                        <div class="alert alert-primary">Preview sejarah dapat dilihat langsung pada halaman Profil publik.
                        </div>
                    @else
                        <div class="p-3 bg-lighter rounded border" style="max-height: 500px; overflow-y: auto;">
                            {!! $profile->content ?? '<span class="text-muted italic">Konten masih kosong</span>' !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="card mb-4">
                <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Pembaruan {{ $pageTitle }}</h5>
                    @if ($key == 'history')
                        <button type="button" class="btn btn-sm btn-primary" id="add-history-item">
                            <i class="ti ti-plus me-1"></i> Tambah Era
                        </button>
                    @endif
                </div>
                <div class="card-body mt-3">
                    <form id="form-profile" action="{{ route('admin.profile.update', $key) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="title" value="{{ $pageTitle }}">

                        @if ($key == 'structure')
                            <div class="mb-3">
                                <label class="form-label">Upload Poster Struktur Baru</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                        @elseif ($key == 'history')
                            <input type="hidden" name="content" id="history-json-input">
                            <div id="history-repeater-container">
                            </div>
                        @else
                            <div class="mb-3">
                                <input type="hidden" name="content" id="content-input">
                                <div id="full-editor" style="height: 350px;"></div>
                            </div>
                        @endif

                        <button type="submit" class="btn btn-primary d-flex align-items-center">
                            <i class="ti ti-device-floppy me-2"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
