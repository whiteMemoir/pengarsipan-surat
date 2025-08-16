@extends('layouts.template')

@section('content-app')
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h4 class="mb-3"><i class="fa fa-list"></i> Surat Masuk</h4>
                </div>
                <div class="col-md-6 text-right">
                    <a href="javascript:void(0)" class="btn btn-info" id="add">
                        <i class="fa fa-plus"></i> Tambah Surat
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 table-responsive">
                    <table class="table table-hover table-bordered bg-light" id="datatable">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th class="text-center" width="5%">No</th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th width="8%" class="text-center">Action</th>
                            </tr>
                        </thead>
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
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" required autocomplete="off" />
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
        const baseUrl = "{{ url('master/dokter') }}";
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
