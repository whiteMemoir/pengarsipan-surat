<!DOCTYPE html>
<html lang="id" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('sneat/') }}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name') }}</title>
    <meta name="description" content="" />
    <link rel="icon" type="image/x-icon" href="{{ asset('logo-black.png') }}" />

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('sneat/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('sneat/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('sneat/vendor/css/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset('sneat/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('sneat/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('sneat/vendor/libs/sweetalert2/sweetalert2.min.css') }}" />

    <link href="{{ asset('sneat/css/toastr.min.css') }}" rel="stylesheet">

    <link href="{{ asset('sneat/css/select2.min.css') }}" rel="stylesheet" />

    <!-- Datatable -->
    <link href="{{ asset('sneat/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    @yield('style')

    <script src="{{ asset('sneat/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('sneat/js/config.js') }}"></script>
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            {{-- SIDEBAR --}}
            @include('components.sidebar')
            {{-- END SIDEBAR --}}

            <div class="layout-page">
                {{-- Navbar --}}
                @include('components.navbar')
                {{-- END Navbar --}}

                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('content')
                    </div>
                    {{-- Footer --}}
                    @include('components.footer')
                    {{-- END Footer --}}
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    <!-- Core JS -->
    <script src="{{ asset('sneat/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('sneat/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('sneat/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('sneat/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('sneat/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('sneat/vendor/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('sneat/vendor/libs/masonry/masonry.js') }}"></script>
    <script src="{{ asset('sneat/js/main.js') }}"></script>


    <script src="{{ asset('sneat/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('sneat/js/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('sneat/js/select2.min.js') }}"></script>
    <script src="{{ asset('sneat/js/toastr.min.js') }}"></script>

    @include('js.custom-js')

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
    </script>

    @yield('js')
</body>
</html>
