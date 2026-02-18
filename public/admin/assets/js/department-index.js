/**
 * DataTables Basic
 */

'use strict';

let fv, offCanvasEl, editOffCanvasEl;
document.addEventListener('DOMContentLoaded', function (e) {
    (function () {
        const formAddNewRecord = document.getElementById('form-add-new-record');
        const formEditRecord = document.getElementById('form-edit-record');
        const offCanvasElement = document.querySelector('#add-new-record');
        const editOffCanvasElement = document.querySelector('#edit-record');

        if (offCanvasElement) {
            offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
        }

        if (editOffCanvasElement) {
            editOffCanvasEl = new bootstrap.Offcanvas(editOffCanvasElement);
        }

        // Buka offcanvas saat tombol diklik
        $(document).on('click', '.create-new', function () {
            formAddNewRecord.reset(); // Kosongkan form
            offCanvasEl.show();
        });

        $(document).on('click', '.btn-edit', function () {
            const slug = $(this).data('id');

            $.get("/admin/department/" + slug + "/edit", function (data) {
                // 1. Set URL Action Form
                formEditRecord.action = "/admin/department/" + slug;

                // 2. Isi data ke field
                document.getElementById('editName').value = data.name;
                document.getElementById('editDescription').value = data.description || '';
                document.getElementById('editStatus').value = data.status;

                // 3. Preview Gambar
                const previewContainer = document.getElementById('preview-container');
                if (data.image) {
                    let imageSrc;

                    // Cek jika path mengandung 'assets/', berarti itu data dari seeder
                    if (data.image.includes('assets/')) {
                        imageSrc = `/${data.image}`; // Langsung ambil dari folder public
                    } else {
                        // Jika tidak, berarti hasil upload manual ke storage
                        imageSrc = `/storage/${data.image}`;
                    }

                    previewContainer.innerHTML = `
                        <div class="mb-3 text-center">
                            <label class="form-label d-block text-start">Gambar Saat Ini:</label>
                            <img src="${imageSrc}" class="rounded shadow-sm border"
                                style="width:150px; height:150px; object-fit:cover;"
                                onerror="this.src='{{ asset('assets/img/placeholder.png') }}'">
                        </div>`;
                } else {
                    previewContainer.innerHTML = '<p class="text-muted small">Tidak ada gambar.</p>';
                }

                // 4. Tampilkan Offcanvas
                editOffCanvasEl.show();
            });
        });

        // Form validation
        if (formAddNewRecord) {
            fv = FormValidation.formValidation(formAddNewRecord, {
                fields: {
                    name: {
                        validators: {
                            notEmpty: {
                                message: 'Nama kejuruan wajib diisi'
                            }
                        }
                    },
                    status: {
                        validators: {
                            notEmpty: {
                                message: 'Silakan pilih status kejuruan'
                            }
                        }
                    },
                    image: {
                        validators: {
                            file: {
                                extension: 'jpeg,jpg,png,webp',
                                type: 'image/jpeg,image/png,image/webp',
                                maxSize: 10485760, //(10MB)
                                message: 'File harus berupa gambar (jpeg, jpg, png, webp) dan maksimal 10MB'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap5: new FormValidation.plugins.Bootstrap5({
                        eleValidClass: '',
                        rowSelector: '.col-sm-12'
                    }),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Form dikirim secara normal
                    autoFocus: new FormValidation.plugins.AutoFocus()
                },
                init: instance => {
                    instance.on('plugins.message.placed', function (e) {
                        // KUNCI: Pindahkan pesan error ke luar input-group agar UI tetap rapi
                        if (e.element.parentElement.classList.contains('input-group')) {
                            e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
                        }
                    });
                }
            });
        }

        if (formEditRecord) {
            fv = FormValidation.formValidation(formEditRecord, {
                fields: {
                    name: {
                        validators: {
                            notEmpty: {
                                message: 'Nama kejuruan wajib diisi'
                            }
                        }
                    },
                    status: {
                        validators: {
                            notEmpty: {
                                message: 'Silakan pilih status kejuruan'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap5: new FormValidation.plugins.Bootstrap5({
                        eleValidClass: '',
                        rowSelector: '.col-sm-12'
                    }),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Form dikirim secara normal
                    autoFocus: new FormValidation.plugins.AutoFocus()
                },
                init: instance => {
                    instance.on('plugins.message.placed', function (e) {
                        // KUNCI: Pindahkan pesan error ke luar input-group agar UI tetap rapi
                        if (e.element.parentElement.classList.contains('input-group')) {
                            e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
                        }
                    });
                }
            });
        }
    })();
});

// datatable (jquery)
$(function () {
    var dt_basic_table = $('.datatables-basic'),
        dt_complex_header_table = $('.dt-complex-header'),
        dt_row_grouping_table = $('.dt-row-grouping'),
        dt_multilingual_table = $('.dt-multilingual'),
        dt_basic;

    // DataTable with buttons
    // --------------------------------------------------------------------

    if (dt_basic_table.length) {
        dt_basic = dt_basic_table.DataTable({
            ajax: '/admin/department/',
            columns: [{
                    data: ''
                },
                {
                    data: 'id'
                },
                {
                    data: 'name'
                },
                {
                    data: 'status'
                },
                {
                    data: 'total_workshops'
                },
                {
                    data: ''
                }
            ],
            columnDefs: [{
                    // For Responsive
                    className: 'control',
                    orderable: false,
                    searchable: false,
                    responsivePriority: 2,
                    targets: 0,
                    render: function (data, type, full, meta) {
                        return '';
                    }
                },
                {
                    targets: 1,
                    title: 'No',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, full, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    // Label
                    targets: 3,
                    render: function (data, type, full) {
                        var status = {
                            0: {
                                title: 'Nonaktif',
                                class: 'bg-label-secondary'
                            },
                            1: {
                                title: 'Aktif',
                                class: 'bg-label-success'
                            }
                        };
                        return typeof status[data] === 'undefined' ? data :
                            '<span class="badge ' + status[data].class + '">' + status[data].title + '</span>';
                    }
                },
                {
                    // Actions
                    targets: -1,
                    title: 'Aksi',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, full, meta) {
                        return (
                            '<div class="d-flex align-items-center gap-2">' +

                            '<a href="/admin/department/' + full.slug + '" ' +
                            'class="btn btn-sm btn-icon" ' +
                            'title="Detail">' +
                            '<i class="ti ti-eye text-primary"></i>' +
                            '</a>' +

                            '<button type="button" ' +
                            'class="btn btn-sm btn-icon btn-edit" ' +
                            'data-id="' + full.slug + '" ' +
                            'title="Edit">' +
                            '<i class="ti ti-pencil text-primary"></i>' +
                            '</button>' +

                            '<button class="btn btn-sm btn-icon btn-delete" ' +
                            'data-id="' + full.slug + '" ' +
                            'title="Hapus">' +
                            '<i class="ti ti-trash text-danger"></i>' +
                            '</button>' +

                            '</div>'
                        );
                    }
                }
            ],
            order: [
                [2, 'asc']
            ],
            dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            displayLength: 10,
            lengthMenu: [10, 25, 50, 75, 100],
            buttons: [{
                    extend: 'collection',
                    className: 'btn btn-label-primary dropdown-toggle me-2',
                    text: '<i class="ti ti-file-export me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
                    buttons: [{
                            extend: 'print',
                            text: '<i class="ti ti-printer me-1" ></i>Print',
                            className: 'dropdown-item',
                            exportOptions: {
                                columns: [1, 2, 3] // Sesuaikan indeks kolom Anda
                            }
                        },
                        {
                            extend: 'csv',
                            text: '<i class="ti ti-file-text me-1" ></i>Csv',
                            className: 'dropdown-item',
                            exportOptions: {
                                columns: [1, 2, 3]
                            }
                        },
                        {
                            extend: 'excel',
                            text: '<i class="ti ti-file-spreadsheet me-1"></i>Excel',
                            className: 'dropdown-item',
                            exportOptions: {
                                columns: [1, 2, 3]
                            }
                        },
                        {
                            extend: 'pdf',
                            text: '<i class="ti ti-file-description me-1"></i>Pdf',
                            className: 'dropdown-item',
                            exportOptions: {
                                columns: [1, 2, 3]
                            }
                        },
                        {
                            extend: 'copy',
                            text: '<i class="ti ti-copy me-1" ></i>Copy',
                            className: 'dropdown-item',
                            exportOptions: {
                                columns: [1, 2, 3]
                            }
                        }
                    ]
                },
                {
                    text: '<i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Tambah Kejuruan Baru</span>',
                    className: 'create-new btn btn-primary'
                }
            ],
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (row) {
                            var data = row.data();
                            return 'Details of ' + data['name'];
                        }
                    }),
                    type: 'column',
                    renderer: function (api, rowIdx, columns) {
                        var data = $.map(columns, function (col, i) {
                            return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                                ?
                                '<tr data-dt-row="' +
                                col.rowIndex +
                                '" data-dt-column="' +
                                col.columnIndex +
                                '">' +
                                '<td>' +
                                col.title +
                                ':' +
                                '</td> ' +
                                '<td>' +
                                col.data +
                                '</td>' +
                                '</tr>' :
                                '';
                        }).join('');

                        return data ? $('<table class="table"/><tbody />').append(data) : false;
                    }
                }
            }
        });
        $('div.head-label').html('<h5 class="card-title mb-0">Kejuruan</h5>');
    }

    $(document).on('click', '.btn-delete', function () {
        var slug = $(this).data('id'); // Mengambil slug dari data-id
        var url = "/admin/department/" + slug; // Sesuaikan dengan prefix route Anda

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data kejuruan dan file terkait akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            customClass: {
                confirmButton: 'btn btn-primary me-3',
                cancelButton: 'btn btn-label-secondary'
            },
            buttonsStyling: false
        }).then(function (result) {
            if (result.value) {
                // Cari form, ganti action-nya, lalu submit
                var form = document.getElementById('delete-form');
                form.action = url;
                form.submit();
            }
        });
    });

    // Filter form control to default size
    // ? setTimeout used for multilingual table initialization
    setTimeout(() => {
        $('.dataTables_filter .form-control').removeClass('form-control-sm');
        $('.dataTables_length .form-select').removeClass('form-select-sm');
    }, 300);
});
