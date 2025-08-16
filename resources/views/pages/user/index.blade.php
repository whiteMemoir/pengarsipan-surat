@extends('layouts.template')

@section('content-app')
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h4 class="mb-3"><i class="fa fa-list"></i> List User</h4>
                </div>
                <div class="col-md-6 text-right">
                    <a href="javascript:void(0)" class="btn btn-info" id="add">
                        <i class="fa fa-plus"></i> Tambah User
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
                                <th>Username</th>
                                <th>Bagian</th>
                                <th>Level</th>
                                <th>Status</th>
                                <th width="8%" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->nama }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->bagian->nama_bagian ?? '' }}</td>
                                    <td>{{ $user->level_user == 'kepala_bagian' ? 'Kepala Bagian' : 'Karyawan' }}</td>
                                    <td>{{ $user->status }}</td>
                                    <td align="center">
                                        <a href="javascript:void(0)" class="btn btn-primary btn-sm edit-btn"
                                            data-id="{{ $user->id }}" data-nama="{{ $user->nama }}"
                                            data-username="{{ $user->username }}" data-bagian="{{ $user->id_bagian }}"
                                            data-level="{{ $user->level_user }}" data-status="{{ $user->status }}"
                                            data-email="{{ $user->email }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm delete-btn"
                                            data-id="{{ $user->id }}">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
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
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" required autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" required autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <label for="level_user">Level User</label>
                            <select name="level_user" id="level_user" id="level_user" class="form-control" style="width: 100%">
                                <option value="admin">Admin</option>
                                <option value="kepala_bagian">Kepala Bagian</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" id="status" class="form-control" style="width: 100%">
                                <option value="aktif">Aktif</option>
                                <option value="tidak_aktif">Tidak Aktif</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="bagian">Bagian</label>
                            <select name="bagian" id="bagian" id="bagian" class="form-control" style="width: 100%">
                                <option value="">Pilih Bagian</option>
                                @foreach ($bagians as $bagian)
                                    <option value="{{ $bagian->id }}">{{ $bagian->nama_bagian }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" required autocomplete="off" />
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
        const baseUrl = "{{ url('users') }}";
        $('#datatable').DataTable({
            processing: true,
        });

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
            $('#name').val($(this).data("nama"));
            $('#username').val($(this).data("username"));
            $('#level_user').val($(this).data("level")).trigger('change');
            $('#bagian').val($(this).data("bagian")).trigger('change');
            $('#status').val($(this).data("status")).trigger('change');
            $('#email').val($(this).data("email"));
            $('#password').val($(this).data("password"));

            // remove required password attribute
            $('#password').removeAttr('required');

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
                username: $("#username").val(),
                level_user: $('#level_user').val(),
                email: $('#email').val(),
                status: $('#status').val(),
                bagian: $('#bagian').val(),
                password: $('#password').val()
            }),
            onSaved: () => {
                datatable.ajax.reload(null, false);
            },
        });
    </script>
@endsection
