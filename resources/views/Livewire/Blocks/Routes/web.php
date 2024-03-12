<?php
use Illuminate\Support\Facades\Route;

Route::get('{id}/text_block/create', \App\Livewire\Blocks\Pagetext\Backend\Create::class);
Route::get('{id}/projects/create', \App\Livewire\Blocks\Projects\Backend\Create::class);
Route::get('text_block/{id}/edit', \App\Livewire\Blocks\Pagetext\Backend\Edit::class);
Route::get('image_block/{id}/edit', \App\Livewire\Blocks\PageImages\Backend\Edit::class);

Route::get('{id}/image_block/create', \App\Livewire\Blocks\PageImages\Backend\Create::class);
