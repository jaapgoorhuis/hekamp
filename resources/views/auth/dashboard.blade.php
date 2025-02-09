@extends('livewire.auth.dashboardLayout')

@section('content')

    <div class="row justify-content-center mt-5">
        <div class="col-md-12 admin-page-container">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if ($errors->has('no_access'))
                        <span class="text-danger">{{ $errors->first('no_access') }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
