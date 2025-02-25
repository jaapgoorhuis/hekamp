@extends('livewire.frontend.components.header')

@section('page')
    @livewire('frontend.projectDetail.projectDetail',['slug' => Route::current()->parameter('slug'),'id' => Route::current()->parameter('id')])

@endsection
