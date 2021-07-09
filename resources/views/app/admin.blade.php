@extends('layouts.spa')

@section('head')
        <link rel="stylesheet" href="{{ mix('/css/admin-app.css') }}">
@endsection

@section('content')
    @if(config('app.env') === 'production')
        <script src="{{ mix('/js/ProdAdminApp.js') }}"></script>
    @else
        <script src="{{ mix('/js/AdminApp.js') }}"></script>
@endsection

