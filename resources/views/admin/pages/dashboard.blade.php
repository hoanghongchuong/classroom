@extends('admin.layouts.main')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page title')
@section('content')
    <div class="">content</div>
@endsection

@push('push')
    <link href="{{ asset('frontend/style.css') }}" rel="stylesheet" type="text/css" />
@endpush
