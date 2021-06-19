<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Robust admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, robust admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>@yield('title', 'Dashboard') | {{ env('APP_NAME') }}</title>
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('admin-assets/app-assets/images/ico/apple-icon-60.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('admin-assets/app-assets/images/ico/apple-icon-76.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('admin-assets/app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('admin-assets/app-assets/images/ico/apple-icon-152.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('admin-assets/app-assets/images/ico/favicon.ico')}}">
    <link rel="shortcut icon" type="image/png" href="{{asset('admin-assets/app-assets/images/ico/favicon-32.png')}}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin-assets/app-assets/css/bootstrap.css')}}">
    
    <!-- font icons-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin-assets/app-assets/fonts/icomoon.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin-assets/app-assets/fonts/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin-assets/app-assets/vendors/css/extensions/pace.css')}}">
    <!-- END VENDOR CSS-->
  
    <link rel="stylesheet" type="text/css" href="{{asset('admin-assets/app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin-assets/app-assets/css/app.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin-assets/app-assets/css/colors.css')}}">
    <!-- END ROBUST CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin-assets/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin-assets/app-assets/css/core/menu/menu-types/vertical-overlay-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin-assets/app-assets/css/core/colors/palette-gradient.css')}}">
    <!-- END Page Level CSS-->
    
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin-assets/assets/css/style.css')}}">
    <!-- END Custom CSS-->
    @yield('css')
    <link rel="stylesheet" type="text/css" href="{{asset('sweetprompt/lib/sweetalert2.css')}}">
  </head>