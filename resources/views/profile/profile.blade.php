@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Update Profil</h2>
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="{{ old('name', auth()->user()->name) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="{{ old('email', auth()->user()->email) }}" required>
            </div>

            <div class="form-group">
                <label for="password">Kata Sandi Baru</label>
                <input type="password" class="form-control" id="password" name="password">
                <span toggle="#password" class="fa fa-eye btn-show-pass"></span>
            </div>
    
            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                <span toggle="#password_confirmation" class="fa fa-eye btn-show-pass"></span>
            </div>

            <button type="submit" class="btn btn-primary">Perbarui</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.btn-show-pass').click(function() {
                $(this).toggleClass('fa-eye fa-eye-slash'); // toggle icon for FontAwesome
                let input = $($(this).attr('toggle'));
                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                } else {
                    input.attr('type', 'password');
                }
            });
        });
    </script>
@endsection
