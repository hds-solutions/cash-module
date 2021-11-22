@extends('backend::layouts.master')

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset(mix('cash-module/assets/css/app.css')) }}">
@endpush
@push('pre-scripts')
    <script src="{{ asset(mix('cash-module/assets/js/app.js')) }}"></script>
@endpush
