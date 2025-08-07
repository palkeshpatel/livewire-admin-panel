@extends('layouts.admin')

@section('title', 'Livewire Test')
@section('page-title', 'Livewire Test')

@section('content')
    <div class="space-y-6">
        @livewire('admin.simple-test')
        @livewire('admin.ultra-simple-test')
    </div>
@endsection 