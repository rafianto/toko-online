<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta
            name="auhtor"
            content="Rahmatulah Sidik"
        />
        <meta
            name="description"
            content="This is dashboard admin ecommerce."
        />

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ env('APP_NAME') }} - @yield('title')</title>

        <!-- GOOGLE FONTS -->
        <link
            href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500"
            rel="stylesheet"
        />
        <link
            href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css"
            rel="stylesheet"
        />

        <!-- PLUGINS CSS STYLE -->
        <link href="{{ asset('assets/plugins/nprogress/nprogress.css') }}" rel="stylesheet" />

        <!-- No Extra plugin used -->

        <link
            href="{{ asset('assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css') }}"
            rel="stylesheet"
        />

        <link
            href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}"
            rel="stylesheet"
        />

        <link href="{{ asset('assets/plugins/toastr/toastr.min.css') }}" rel="stylesheet" />
        
        {{-- Toaster --}}
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

        {{-- select2 --}}
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        {{-- Data Table Responsive --}}
        <link href="{{ asset('assets/plugins/data-tables/responsive.datatables.min.css') }}" rel="stylesheet" />

        <!-- SLEEK CSS -->
        <link id="sleek-css" rel="stylesheet" href="{{ asset('assets/css/sleek.css') }}" />

        <!-- FAVICON -->
        <link href="{{ asset('assets/img/favicon.png') }}" rel="shortcut icon" />

        <!--
    HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
  -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="{{ asset('assets/plugins/nprogress/nprogress.js') }}"></script>
        <style>
            th{
                background: white;
                position: sticky;
                top: 0; /* Don't forget this, required for the stickiness */
                    box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.1);
            }
        </style>
        @yield('css')
    </head>
    <body
        class="header-fixed sidebar-fixed sidebar-dark header-light"
        id="body"
      >
      
      <script>
            NProgress.configure({ showSpinner: true });
            NProgress.start();
      </script>

      {{-- <div id="toaster"></div> --}}

      {{-- Wrapper --}}
            <div class="wrapper">
      {{-- End Of Wrapper --}}