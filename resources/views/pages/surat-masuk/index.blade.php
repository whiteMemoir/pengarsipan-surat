@extends('layouts.template')

@section('content-app')
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h4 class="mb-3"><i class="fa fa-envelope"></i> Surat Masuk</h4>
                </div>
                @if (auth()->user()->level_user != 'kepala_bagian')
                    <div class="col-md-6 text-right">
                        <a href="javascript:void(0)" class="btn btn-info" id="add">
                            <i class="fa fa-plus"></i> Buat Surat
                        </a>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-12 table-responsive">
                    <table class="table table-hover table-bordered bg-light" id="datatable">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th class="text-center" width="5%">No</th>
                                <th>Tanggal</th>
                                <th>No Surat</th>
                                <th>Pengirim</th>
                                <th>Kepada</th>
                                <th>Perihal</th>
                                <th>Status</th>
                                <th width="8%" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suratMasuk as $surat)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $surat->tanggal }}</td>
                                    <td>{{ $surat->no_surat }}</td>
                                    <td>{{ $surat->pengirim }}</td>
                                    <td>{{ $surat->toUser->nama }}</td>
                                    <td>{{ $surat->perihal }}</td>
                                    <td>{{ strtoupper($surat->status) }}</td>
                                    <td align="center">
                                        @if ($surat->status == 'baru' && auth()->user()->level_user != 'kepala_bagian')
                                            <a href="javascript:void(0)" class="btn btn-danger btn-sm delete-btn"
                                                data-id="{{ $surat->id }}" title="Batal">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        @endif
                                        @if (in_array($surat->status, ['baru', 'dibaca']) && auth()->user()->level_user == 'kepala_bagian')
                                            <a href="{{ url('surat-masuk/disposisi') . '/' . $surat->id }}" class="btn btn-success text-white btn-sm" title="Disposisi">
                                                <i class="fa fa-paper-plane"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- modal detail --}}
    <div class="modal fade" id="formModalBaca" tabindex="-1" role="dialog" aria-labelledby="formModalBacaLabel"
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
                    <form id="dataFormDetail" method="POST" enctype="multipart/form-data" action="">
                        @method('PUT')
                        @csrf
                        <input type="hidden" id="dataIdDetail" />
                        <table class="table">
                            <tr>
                                <td width="40%">Tanggal</td>
                                <td align="right" id="tanggalDetail"></td>
                            </tr>
                            <tr>
                                <td width="40%">Pengirim</td>
                                <td align="right" id="pengirimDetail"></td>
                            </tr>
                            <tr>
                                <td width="40%">Kepada</td>
                                <td align="right" id="kepadaDetail"></td>
                            </tr>
                            <tr>
                                <td width="40%">Perihal</td>
                                <td align="right" id="perihalDetail"></td>
                            </tr>
                            <tr>
                                <td width="40%">Status</td>
                                <td align="right" id="statusDetail"></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">
                                    <a href="" id="fileDetail" target="_blank">Lihat File Lampiran</a>
                                </td>
                            </tr>
                        </table>
                    </form>
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
                    <form id="dataForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="dataId" />
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" id="tanggal" required
                                autocomplete="off" max="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}" />
                        </div>
                        <div class="form-group">
                            <label for="pengirim">Pengirim</label>
                            <input type="text" class="form-control" name="pengirim" id="pengirim" required
                                autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <label for="alamat_pengirim">Alamat Pengirim</label>
                            <input type="text" class="form-control" name="alamat_pengirim" id="alamat_pengirim"
                                required autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <label for="kepada">Kepada</label>
                            <select name="kepada" name="kepada" id="kepada" class="form-control"
                                style="width: 100%">
                                <option value="">Pilih Tujuan</option>
                                @foreach ($users->where('level_user', 'kepala_bagian') as $user)
                                    <option value="{{ $user->id }}">{{ $user->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="perihal">Perihal</label>
                            <input type="perihal" class="form-control" name="perihal" id="perihal" required
                                autocomplete="off" />
                        </div>

                        <div class="form-group">
                            <label for="file_surat">File Lampiran</label>
                            <input type="file" class="form-control" name="file_surat" id="file_surat"
                                autocomplete="off" required />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btnSubmit" form="dataForm">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        const baseUrl = "{{ url('surat-masuk') }}";
        $('#datatable').DataTable({
            processing: true,
        });

        // Add
        $("#add").click(function() {
            CrudUtils.resetForm("dataForm", "formTitle", "Simpan Data", "dataId");
            $('#formModal').modal('show');
        });

        $(document).on("submit", "#dataForm", function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('surat-masuk.store') }}", // sesuaikan route
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {

                    if (res.status == 'success') {
                        swal({
                            icon: "success",
                            title: "Berhasil",
                            text: 'Data berhasil disimpan',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.reload();
                        })
                    }

                    $("#dataForm")[0].reset();
                    $("#formModal").modal("hide");
                },
                error: function(err) {
                    console.log(err);
                    alert("Gagal menyimpan data!");
                }
            });
        });


        // Edit
        $(document).on("click", ".edit-btn", function() {
            const id = $(this).data("id");

            $("#formTitle").text("Edit Data");
            $("#dataId").val(id);
            $('#tanggal').val($(this).data("tanggal"));
            $('#pengirim').val($(this).data("pengirim"));
            $('#kepada').val($(this).data("kepada")).trigger('change');
            $('#alamat_pengirim').val($(this).data("alamat_pengirim"));
            $('#perihal').val($(this).data("perihal"));
            // $('#status').val($(this).data("status")).trigger('change');

            // remove required password attribute
            $('#password').removeAttr('required');

            $('#formModal').modal('show');
        });

        // Delete
        $(document).on("click", ".delete-btn", function() {
            CrudUtils.deleteItem({
                url: `${baseUrl}/delete`,
                id: $(this).data("id"),
                onDeleted: () => setTimeout(() => window.location.reload(), 1000)
            });
        });
    </script>
@endsection
