<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('global_assets/css/icons/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('js/fontawesome-free-6.0.0-web/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="{{ asset('global_assets/js/main/jquery.min.js') }}"></script>
    <script src="{{ asset('global_assets/js/main/bootstrap.bundle.min.js') }}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <!-- /theme JS files -->

    {{-- extras --}}
    {{-- confirm --}}
    <link rel="stylesheet" href="{{ asset('js/jquery-confirm-v3.3.4/dist/jquery-confirm.min.css') }}">
    <script src="{{ asset('js/jquery-confirm-v3.3.4/dist/jquery-confirm.min.js') }}"></script>

    {{-- datatable --}}
    <script src="{{ asset('global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>

    @stack('scripts')
	@stack('linksCabeza')
</head>

<body>

    <!-- Main navbar -->
    @include('layouts.header')
    <!-- /main navbar -->


    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->
        @auth
            @include('layouts.menu')
        @endauth

        <!-- /main sidebar -->


        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Inner content -->
            <div class="content-inner">

                <!-- Page header -->
                <div class="page-header page-header-light">
                    {{-- <div class="page-header-content header-elements-lg-inline">
						<div class="page-title d-flex">
							<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Components</span> - Alerts</h4>
							<a href="#" class="header-elements-toggle text-body d-lg-none"><i class="icon-more"></i></a>
						</div>

						<div class="header-elements d-none">
							<div class="d-flex justify-content-center">
								<a href="#" class="btn btn-link btn-float text-body"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
								<a href="#" class="btn btn-link btn-float text-body"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
								<a href="#" class="btn btn-link btn-float text-body"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
							</div>
						</div>
					</div> --}}

                    <div class="breadcrumb-line breadcrumb-line-light header-elements-lg-inline">
                        <div class="d-flex">
                            <div class="breadcrumb">
                                @yield('breadcrumbs')
                            </div>


                            {{-- si existe barra laterla se muestra --}}
                            @hasSection('barraLateral')
                                <a href="#" class="header-elements-toggle text-body d-lg-none"><i
                                        class="icon-more"></i></a>
                            @endif
                        </div>

                        <div class="header-elements d-none">
                            @yield('barraLateral')
                            {{-- este para añadir barra lateral en breadcrums --}}
                            {{-- <div class="breadcrumb justify-content-center">
								<a href="#" class="breadcrumb-elements-item">
									<i class="icon-comment-discussion mr-2"></i>
									Support
								</a>

								<div class="breadcrumb-elements-item dropdown p-0">
									<a href="#" class="breadcrumb-elements-item dropdown-toggle" data-toggle="dropdown">
										<i class="icon-gear mr-2"></i>
										Settings
									</a>

									<div class="dropdown-menu dropdown-menu-right">
										<a href="#" class="dropdown-item"><i class="icon-user-lock"></i> Account security</a>
										<a href="#" class="dropdown-item"><i class="icon-statistics"></i> Analytics</a>
										<a href="#" class="dropdown-item"><i class="icon-accessibility"></i> Accessibility</a>
										<div class="dropdown-divider"></div>
										<a href="#" class="dropdown-item"><i class="icon-gear"></i> All settings</a>
									</div>
								</div>
							</div> --}}
                        </div>
                    </div>
                </div>
                <!-- /page header -->


                <!-- Content area -->
                <div class="content">
                    @if ($errors->any())
                        <div class="alert alert-danger border-0 alert-dismissible">
                            <button type="button" class="close"
                                data-dismiss="alert"><span>&times;</span></button>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>
                                        <span class="font-weight-semibold">
                                            {{ $error }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>

                        </div>
                    @endif

                    @foreach (['success', 'warning', 'info', 'error', 'default'] as $msg)
                        @if (Session::has($msg))
                            @include('layouts.alert', ['type' => $msg, 'msg' => Session::get($msg)])
                        @endif
                    @endforeach

                    @yield('content')
                </div>
                <!-- /content area -->


                <!-- Footer -->
                @include('layouts.footer')
                <!-- /footer -->

            </div>
            <!-- /inner content -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->
    <script>
        function eliminar(arg) {

            var url = $(arg).data('url');
            var id = $(arg).data('id');
            var msg = $(arg).data('msg');

            $.confirm({
                theme: 'Modern',
                type: 'red',
                closeIcon: true,
                icon: 'fa-regular fa-face-sad-tear fa-beat',
                title: 'Confirmar!',
                content: msg,
                buttons: {
                    confirmar: function() {
                        var form = document.createElement("form");
                        var element1 = document.createElement("input");
                        var element2 = document.createElement("input");
                        form.method = "POST";
                        form.action = url;
                        element1.value = "{{ csrf_token() }}";
                        element1.name = "_token";
                        form.appendChild(element1);
                        element2.value = id;
                        element2.name = "id";
                        form.appendChild(element2);
                        document.body.appendChild(form);
                        form.submit();
                    },
                    cancelar: function() {

                    }
                }
            });

        }
    </script>
@stack('linksPie')
</body>

</html>
