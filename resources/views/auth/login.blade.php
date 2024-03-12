@extends('auth.layouts')

@section('content')

    <div class="row justify-content-center mt-5">

        <div class="col-md-8">

            <div class="card">
                <div class="card-header">Inloggen</div>
                <div class="card-body">
                    <form action="{{ route('authenticate') }}" method="post">
                        @if (session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                        @csrf
                        <div class="mb-3 row">
                            <label for="email" class="col-md-4 col-form-label text-md-end text-start">Emailadres</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-md-4 col-form-label text-md-end text-start">Wachtwoord</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-md-4"></div>
                            <div class="col-md-6">
                                <a href="/forget-password">Wachtwoord vergeten</a>
                                <input type="submit" class="btn btn-primary btn-login" value="Inloggen"/>
                            </div>

                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
