@extends('auth.layouts')


@section('content')
    <main class="login-form">
        <div class="cotainer">
            <div class="row justify-content-center mt-5">
                <div class="col-md-8">

                <div class="card">
                        <div class="card-header">Wachtwoord herstellen</div>
                        <div class="card-body">

                            @if (Session::has('message'))
                                <div class="alert alert-success" role="alert">
                                    {{ Session::get('message') }}
                                </div>
                            @endif

                            <form action="{{ route('forget.password.post') }}" method="POST">
                                @csrf
                                <div class="mb-3 row">
                                    <label for="email" class="col-md-4 col-form-label text-md-end text-start">Emailadres</label>
                                    <div class="col-md-6">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email_address" name="email" required autofocus>
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Verstuur herstel link
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
