@extends('layouts.admin')

@section('title', 'Products')
@section('page-title', 'Products')

@section('content')
    <div>
        @livewire('admin.product-manager')
    </div>
@endsection
