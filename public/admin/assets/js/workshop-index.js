/**
 * Workshop DataTables & Offcanvas
 */

'use strict';

let fv, offCanvasEl, editOffCanvasEl;

$(function () {
    var dt_workshop_table = $('.datatables-workshops'),
        dt_workshop;

    // DataTable
    if (dt_workshop_table.length) {
        dt_workshop = dt_workshop_table.DataTable({
            ajax: '/admin/workshop', // Endpoint Controller
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
                    data: 'department.name'
                },
                {
                    data: 'external_link'
                },
                {
                    data: 'status'
                },
                {
                    data: ''
                }
            ],
            columnDefs: [{
                    // Untuk Responsive
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
                    // Kolom No
                    targets: 1,
                    render: function (data, type, full, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    // Nama Pelatihan + Image
                    targets: 2,
                    render: function (data, type, full, meta) {
                        var $name = full['name'],
                            $image = full['image'];
                        var $src = '';

                        if ($image) {
                            if ($image.substring(0, 7) === 'assets/') {
                                $src = window.location.origin + '/' + $image;
                            } else {
                                $src = window.location.origin + '/storage/' + $image;
                            }

                            var $output = '<img src="' + $src + '" alt="Workshop" class="rounded me-2" width="32" height="32" style="object-fit: cover;">';
                        } else {
                            var $output = '<div class="avatar-wrapper"><div class="avatar me-2"><span class="avatar-initial rounded bg-label-secondary"><i class="ti ti-school"></i></span></div></div>';
                        }

                        return '<div class="d-flex justify-content-start align-items-center">' + $output + '<span class="fw-normal">' + $name + '</span></div>';
                    }
                },
                {
                    // Link Kemnaker (Truncate agar rapi)
                    targets: 4,
                    render: function (data, type, full, meta) {
                        return '<a href="' + data + '" target="_blank" class="text-primary text-truncate d-inline-block" style="max-width: 150px;" title="' + data + '">' +
                            '<i class="ti ti-link me-1"></i>Buka Link</a>';
                    }
                },
                {
                    // Status Badge
                    targets: 5,
                    render: function (data, type, full) {
                        var $status = {
                            0: {
                                title: 'Nonaktif',
                                class: 'bg-label-secondary'
                            },
                            1: {
                                title: 'Aktif',
                                class: 'bg-label-success'
                            }
                        };
                        return '<span class="badge ' + $status[data].class + '">' + $status[data].title + '</span>';
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
                            '<button class="btn btn-sm btn-icon btn-edit" data-id="' + full.slug + '" title="Edit"><i class="ti ti-pencil text-primary"></i></button>' +
                            '<button class="btn btn-sm btn-icon btn-delete" data-id="' + full.slug + '" title="Hapus"><i class="ti ti-trash text-danger"></i></button>' +
                            '</div>'
                        );
                    }
                }
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
                                columns: [1, 2, 3, 4, 5] // Sesuaikan indeks kolom Anda
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
                    text: '<i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Tambah Pelatihan</span>',
                    className: 'create-new btn btn-primary'
                }
            ]
        });
        $('div.head-label').html('<h5 class="card-title mb-0">Daftar Pelatihan</h5>');
    }

    // --- LOGIKA OFF-CANVAS & AJAX ---

    const formAdd = document.getElementById('form-add-new-record');
    const formAddNewRecord = document.getElementById('form-add-new-record');
    const formEdit = document.getElementById('form-edit-record');
    const formEditRecord = document.getElementById('form-edit-record');

    if (document.getElementById('add-new-record')) {
        offCanvasEl = new bootstrap.Offcanvas(document.getElementById('add-new-record'));
    }
    if (document.getElementById('edit-record')) {
        editOffCanvasEl = new bootstrap.Offcanvas(document.getElementById('edit-record'));
    }

    // Klik Tambah
    $(document).on('click', '.create-new', function () {
        formAdd.reset();
        offCanvasEl.show();
    });

    // Klik Edit (AJAX)
    $(document).on('click', '.btn-edit', function () {
        var slug = $(this).data('id');
        $.get("/admin/workshop/" + slug + "/edit", function (data) {
            formEdit.action = "/admin/workshop/" + slug;
            $('#editName').val(data.name);
            $('#editDepartment').val(data.department_id);
            $('#editLink').val(data.external_link);
            $('#editStatus').val(data.status);

            // Preview Image
            if (data.image) {
                $('#preview-container').html('<img src="/storage/' + data.image + '" class="rounded my-2 shadow-sm" width="100">');
            } else {
                $('#preview-container').html('');
            }

            editOffCanvasEl.show();
        });
    });

    if (formAddNewRecord) {
        fv = FormValidation.formValidation(formAddNewRecord, {
            fields: {
                name: {
                    validators: {
                        notEmpty: {
                            message: 'Nama pelatihan wajib diisi'
                        }
                    }
                },
                department_id: {
                    validators: {
                        notEmpty: {
                            message: 'Silakan pilih kejuruan'
                        }
                    }
                },
                external_link: {
                    validators: {
                        notEmpty: {
                            message: 'Link pendaftaran wajib diisi'
                        },
                        uri: {
                            message: 'Format link tidak valid (gunakan http:// atau https://)'
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
                defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                autoFocus: new FormValidation.plugins.AutoFocus()
            },
            init: instance => {
                instance.on('plugins.message.placed', function (e) {
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
                            message: 'Nama pelatihan wajib diisi'
                        }
                    }
                },
                department_id: {
                    validators: {
                        notEmpty: {
                            message: 'Silakan pilih kejuruan'
                        }
                    }
                },
                external_link: {
                    validators: {
                        notEmpty: {
                            message: 'Link pendaftaran wajib diisi'
                        },
                        uri: {
                            message: 'Format link tidak valid'
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
                defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                autoFocus: new FormValidation.plugins.AutoFocus()
            },
            init: instance => {
                instance.on('plugins.message.placed', function (e) {
                    if (e.element.parentElement.classList.contains('input-group')) {
                        e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
                    }
                });
            }
        });

        $(document).on('click', '.btn-edit', function () {
            fvEdit.resetForm();
        });
    }

    // Klik Hapus (SweetAlert)
    $(document).on('click', '.btn-delete', function () {
        var slug = $(this).data('id');
        Swal.fire({
            title: 'Hapus Pelatihan?',
            text: "Data tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!',
            customClass: {
                confirmButton: 'btn btn-primary me-3',
                cancelButton: 'btn btn-label-secondary'
            },
            buttonsStyling: false
        }).then(function (result) {
            if (result.value) {
                var form = document.getElementById('delete-form');
                form.action = "/admin/workshop/" + slug;
                form.submit();
            }
        });
    });
});
