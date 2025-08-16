@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="mb-3"><i class="fa fa-list"></i> Surat Masuk</h4>
                </div>
                <div class="col-md-6 float-end">
                    <a href="javascript:void(0)" class="btn btn-primary" id="add">
                        <i class="fa fa-plus"></i> Surat
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 table-responsive">
                    <table class="table table-hover table-bordered bg-light" id="datatable">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">No</th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th width="8%" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Anton</td>
                                <td>2022-01-01</td>
                                <td class="text-center">
                                    <a href="javascript:void(0)" class="btn btn-primary">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            {{-- @foreach ($suratMasuk as $surat)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $surat->nomor_surat }}</td>
                                    <td>{{ $surat->tanggal_surat }}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="javascript:void(0)" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-white bg-primary">
                    <h5 class="modal-title text-white" id="formTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="dataForm">
                        <input type="hidden" id="dataId" />
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" id="name" required autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <label for="jenis_dokter">Jenis dokter</label>
                            <select name="jenis_dokter" id="jenis_dokter" class="form-control" required>
                                <option value="">Pilih Jenis Dokter</option>
                                <option value="pengirim">Pengirim</option>
                                <option value="penanggung_jawab">Penanggung Jawab</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="code">Kode dokter</label>
                            <input type="text" name="code" id="code" class="form-control" placeholder="Masukkan Code dokter">
                        </div>

                        <div class="form-group">
                            <label for="nip">NIP dokter</label>
                            <input type="text" name="nip" id="nip" class="form-control" placeholder="Masukkan NIP dokter">
                        </div>

                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <input type="text" name="description" id="description" class="form-control" placeholder="Masukkan Deskripsi">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="dataForm">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        // const baseUrl = "{{ url('master/dokter') }}";
        // let datatable;

        // datatable = CrudUtils.initDataTable({
        //     tableId: "datatable",
        //     ajaxUrl: `${baseUrl}/data`,
        //     searchableFields: ['name', 'code'],
        //     orders: [
        //         [1, "asc"]
        //     ],
        //     columns: [{
        //             render: function(data, type, row, meta) {
        //                 return meta.row + meta.settings._iDisplayStart + 1;
        //             },
        //             className: "text-center no-sort",
        //             orderable: false
        //         },
        //         {
        //             data: 'name'
        //         },
        //         {
        //             data: 'jenis_dokter',
        //             render: function(data, type, row) {
        //                 if (data == 'pengirim') {
        //                     return '<span class="badge badge-success text-white">Pengirim</span>';
        //                 } else {
        //                     return '<span class="badge badge-info text-white">Penanggung Jawab</span>';
        //                 }
        //             },
        //         },
        //         {
        //             data: 'code',
        //             orderable: false
        //         },
        //         {
        //             data: 'nip',
        //             orderable: false
        //         },
        //         {
        //             data: 'description',
        //             orderable: false
        //         },
        //         {
        //             data: 'uid',
        //             render: function(data, type, row) {
        //                 return `
        //                     <div class="action-icon-wrapper">
        //                         <i class="fa fa-pencil-square text-primary edit-btn"
        //                             data-id="${data}"
        //                             data-code="${row.code}"
        //                             data-name="${row.name}"
        //                             data-jenisdokter="${row.jenis_dokter}"
        //                             data-nip="${row.nip}"
        //                             data-description="${row.description}"
        //                             data-toggle="tooltip" data-placement="top"
        //                             title="Edit">
        //                         </i>
        //                         <i class="fa fa-times-circle text-danger delete-btn"
        //                             data-id="${data}"
        //                             data-toggle="tooltip" data-placement="top"
        //                             title="Delete"></i>
        //                     </div>`
        //             },
        //             orderable: false,
        //             searchable: false,
        //             className: "text-center"
        //         }
        //     ]
        // });

        // Add
        $("#add").click(function() {
            CrudUtils.resetForm("dataForm", "formTitle", "Simpan Data", "dataId");
            $('#formModal').modal('show');
        });

        // Edit
        $(document).on("click", ".edit-btn", function() {
            const id = $(this).data("id");

            $("#formTitle").text("Edit Data");
            $("#dataId").val(id);
            $('#code').val($(this).data("code"));
            $("#name").val($(this).data("name"));
            $('#nip').val($(this).data('nip'));
            $('#jenis_dokter').val($(this).data('jenisdokter')).trigger('change');
            $('#description').val($(this).data('description'));

            $('#formModal').modal('show');
        });

        // Delete
        $(document).on("click", ".delete-btn", function() {
            CrudUtils.deleteItem({
                url: `${baseUrl}/delete`,
                id: $(this).data("id"),
                onDeleted: () => datatable.ajax.reload(null, false)
            });
        });

        // Submit Create/Update
        CrudUtils.submitForm({
            formId: "dataForm",
            modalId: "formModal",
            createUrl: `${baseUrl}/store`,
            updateUrl: `${baseUrl}/update`,
            idFieldId: "dataId",
            getPayload: () => ({
                name: $("#name").val(),
                code: $("#code").val(),
                jenis_dokter: $('#jenis_dokter').val(),
                nip: $('#nip').val(),
                description: $('#description').val()
            }),
            onSaved: () => {
                datatable.ajax.reload(null, false);
            },
        });
    </script>
@endsection
