<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- theme meta -->
    <meta name="theme-name" content="quixlab" />

    {{-- meta csrf token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SISTEM PENGARSIPAN SURAT</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo.png') }}">
    <!-- Pignose Calender -->
    <link href="{{ asset('theme') }}/plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="{{ asset('theme') }}/plugins/chartist/css/chartist.min.css">
    <link rel="stylesheet" href="{{ asset('theme') }}/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">

    <!-- Toastr CSS -->
    <link href="{{ asset('theme') }}/css/toastr.min.css" rel="stylesheet">

    <link href="{{ asset('theme') }}/css/select2.min.css" rel="stylesheet" />

    <!-- Datatable -->
    <link href="{{ asset('theme') }}/plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link href="{{ asset('theme') }}/css/style.css" rel="stylesheet">


    <style>
        * {
            font-weight: 500
        }

        .fs18 {
            font-size: 18px;
        }

        .form-control {
            min-height: 33px !important;
            height: 33px !important;
        }

        .footer {
            bottom: 0;
            position: fixed;
            right: 0;
            left: 0;
        }

        .content-body {
            min-height: 100% !important;
            padding-bottom: 80px !important;
        }

        .nav-header .brand-logo a {
            padding: 0.6135rem 1.8125rem;
            display: block;
        }

        input[type="checkbox"] {
            cursor: pointer;
        }

        select,
        .select2 {
            width: 100%;
        }

        .metismenu a {
            display: flex !important;
            align-items: middle !important;
        }

        .required-label::after {
            content: " *";
            color: red;
        }

        .optional-label::after {
            content: " ";
            color: #999;
            font-style: italic;
            font-weight: normal;
        }

        .action-icon-wrapper {
            display: flex;
            justify-content: center;
            gap: 5px;
            /* jarak antar ikon */
            align-items: center;
        }

        .action-icon-wrapper i {
            font-size: 2rem;
            /* ukuran ikon */
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .action-icon-wrapper i:hover {
            transform: scale(1.2);
            opacity: 0.8;
        }

        #datatable thead th {
            vertical-align: middle;
        }

        #datatable_wrapper {
            padding: 0px !important;
        }

        table {
            width: 100% !important;
            border-collapse: collapse !important;
        }

        table.dataTable.table-bordered {
            border-collapse: collapse !important;
        }

        table.dataTable th {
            font-weight: bold;
        }

        table.dataTable td {
            padding: 6px 10px;
        }

        .dataTables_filter input,
        .dataTables_filter input:focus,
        .dataTables_length select,
        .dataTables_length select:focus {
            border: 1px solid #888888;
            /* Atau warna lain */
            border-radius: 4px;
            padding: 4px 8px;
            outline: none;
        }

        .modal-fullscreen {
            width: 100vw;
            height: 100vh;
            margin: 0;
            padding: 0;
            max-width: none;
        }

        .modal-fullscreen .modal-content {
            height: 100vh;
            border-radius: 0;
        }

        [data-nav-headerbg="color_1"] .nav-header,
        .bg-primary {
            background-color: #017ab3 !important;
        }
    </style>

    @yield('css')
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3"
                    stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header text-center pb-2"
            style="background-image: url({{ asset('images/logo.png') }}); background-size: cover; background-repeat: no-repeat; background-position: center">
            <div class="brand-logo">
                {{-- <a href="{{ url('/') }}"> --}}
                {{-- <span class="brand-title">
                        &nbsp;
                    </span>
                </a> --}}
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->


        @include('layouts.navbar')

        @include('layouts.sidebar')


        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            {{-- <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        @if ($page != 'home')
                            <li class="breadcrumb-item active">
                                <a href="javascript:void(0)">{{ ucfirst($page) }}</a>
                            </li>
                        @endif
                    </ol>
                </div>
            </div> --}}

            <div class="container-fluid mt-3">
                @yield('content-app')
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->




        <!--**********************************
        Footer start
    ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; {{ date('Y') }} All rights reserved - Supported by PT. Anugrah Bintang Cendana
                </p>
            </div>
        </div>


        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="{{ asset('theme') }}/js/jquery-3.7.1.min.js"></script>

    {{-- Seet Alert --}}
    <script src="{{ asset('theme') }}/js/sweetalert.min.js"></script>

    <script src="{{ asset('theme') }}/plugins/common/common.min.js"></script>
    <script src="{{ asset('theme') }}/js/custom.min.js"></script>
    <script src="{{ asset('theme') }}/js/settings.js"></script>
    <script src="{{ asset('theme') }}/js/gleek.js"></script>
    <script src="{{ asset('theme') }}/js/styleSwitcher.js"></script>


    <script src="{{ asset('theme') }}/plugins/tables/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('theme') }}/plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>

    <script src="{{ asset('theme') }}/js/select2.min.js"></script>

    <script src="{{ asset('theme') }}/js/toastr.min.js"></script>

    <script type="text/javascript">
        toastr.options = {
            "closeButton": true, // tampilkan tombol close (X)
            "progressBar": true, // tampilkan progress bar
            "timeOut": "5000", // durasi tampil (ms)
            "extendedTimeOut": "1000", // waktu tambahan saat mouse hover
            "positionClass": "toast-bottom-center" // posisi notifikasi
        };

        @if (session()->has('success'))
            toastr.success("{{ session('success') }}", "Berhasil");
        @endif

        @if (session()->has('error'))
            toastr.error("{{ session('error') }}", "Gagal");
        @endif

        @if (session()->has('warning'))
            toastr.warning("{{ session('warning') }}", "Peringatan");
        @endif

        window.showToast = {
            success: function(message, title = 'Success', reload = false) {
                toastr.options = getBaseToastrOptions(reload);
                toastr.success(message, title);
            },
            warning: function(message, title = 'Warning', reload = false) {
                toastr.options = getBaseToastrOptions(reload);
                toastr.warning(message, title);
            },
            error: function(message, title = 'Error', reload = false) {
                toastr.options = getBaseToastrOptions(reload);
                toastr.error(message, title);
            }
        };

        function getBaseToastrOptions(reload) {
            return {
                timeOut: 5000,
                closeButton: true,
                debug: false,
                newestOnTop: true,
                progressBar: true,
                positionClass: "toast-bottom-right",
                preventDuplicates: true,
                onclick: null,
                showDuration: "300",
                hideDuration: "1000",
                extendedTimeOut: "1000",
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut",
                tapToDismiss: false,
                onHidden: reload ? function() {
                    location.reload();
                } : null
            };
        }

        function initDataTables() {
            if (!$.fn.DataTable.isDataTable('.datatable')) {
                $('.datatable').DataTable({
                    paging: true,
                    searching: true,
                    ordering: true,
                    info: true
                });
            }

            if (!$.fn.DataTable.isDataTable('.datatable2')) {
                $('.datatable2').DataTable({
                    paging: true,
                    searching: true,
                    ordering: true,
                    info: true
                })
            }
        }

        async function getData(url) {
            let res = await fetch(url)
                .then((res) => res.json())
                .catch((err) => console.log(err));

            return res;
        }

        $('.select2').select2()

        $('.hamburger').on('click', function() {
            // get from local storage
            let sidebarOpen = localStorage.getItem('sidebar-open');
            if (sidebarOpen === 'true') {
                localStorage.setItem('sidebar-open', 'false');
            } else {
                localStorage.setItem('sidebar-open', 'true');
            }
        });


        // add required and optional label
        $("label[for]").each(function() {
            const inputId = $(this).attr("for");
            const inputEl = $("#" + inputId);

            if (inputEl.prop("required")) {
                $(this).addClass("required-label");
            } else {
                $(this).addClass("optional-label");
            }
        });

        // autocomplete off
        $('input').attr('autocomplete', 'off');

        // onload function
        function onLoad() {
            let sidebarOpen = localStorage.getItem('sidebar-open');
            if (sidebarOpen === 'true') {
                $('#main-wrapper').addClass('menu-toggle');
            } else {
                $('#main-wrapper').removeClass('menu-toggle');
            }
        }

        onLoad();

        async function submitFormData(
            formData,
            url,
            method = "POST",
            redirectUrl = ""
        ) {
            $.ajax({
                url: url,
                type: method,
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                credentials: "include",
                beforeSend: function() {
                    swal({
                        title: "Loading",
                        text: "Please wait...",
                        showConfirmButton: false,
                        allowOutsideClick: false
                    })
                },
                success: function(res, textStatus, xhr) {
                    if (res.status == 'success') {
                        swal({
                            icon: "success",
                            title: "Berhasil",
                            text: res.message,
                            showConfirmButton: false,
                            timer: 1500
                        })

                        if (redirectUrl) {
                            setTimeout(() => {
                                window.location.href = redirectUrl;
                            }, 1500);
                        } else {
                            setTimeout(() => {
                                window.location.reload();
                            }, 1500);
                        }

                    } else {
                        swal({
                            icon: "error",
                            title: "Error",
                            text: res.message,
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON?.errors || {};

                        let errorMessages = "";
                        for (let field in errors) {
                            const fieldErrors = errors[field].join(" ");
                            errorMessages += `${fieldErrors}<br>`;
                        }

                        swal({
                            icon: "error",
                            title: "Validation Failed",
                            content: {
                                element: "div",
                                attributes: {
                                    innerHTML: errorMessages,
                                },
                            },
                        });
                    } else {
                        showToast.error("Error saving data!", "Error");
                    }
                },
            });
        }

        function logout() {
            swal({
                    title: "Apakah anda logout?",
                    text: "Keluar dari aplikasi",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((result) => {
                    if (result) {
                        $('#logout-form').submit();
                    }
                })
        }

        // jangan hapus karena masih dipakai
        function deleteData(url) {
            swal({
                title: "Apakah anda yakin?",
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((result) => {
                if (result) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            '_method': 'DELETE',
                            '_token': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            if (data.status == 'success') {
                                swal({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: data.message
                                    })
                                    .then(() => {
                                        window.location.reload();
                                    })
                            } else {
                                swal({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: data.message
                                })
                            }
                        },
                        error: function(data) {
                            console.log(data);
                            swal({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Terjadi kesalahan. Silahkan coba lagi.'
                            })
                        }
                    })
                }
            })
        }
    </script>

    @include('layouts.custom-js')

    @include('layouts.select2-js')

    <script>
        // datatogle untuk datatable
        $('#datatable').on('draw.dt', function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    @yield('js')

</body>

</html>
