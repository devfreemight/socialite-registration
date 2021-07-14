@extends('layouts.spa')

@section('head')
    @if(config('app.env') === 'production')
        <link rel="stylesheet" href="{{ mix('/dist/admin-app.css') }}">
    @else
        <link rel="stylesheet" href="{{ mix('/css/admin-app.css') }}">
    @endif
@endsection

@section('content')
    @if(config('app.env') === 'production')
        <script src="{{ mix('/dist/ProdAdminApp.js') }}"></script>
    @else
        <script src="{{ mix('/js/AdminApp.js') }}"></script>
    @endif
@endsection

