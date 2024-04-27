@extends('layouts.auth')
@section('title')
    Login
@endsection
@section('content')
<center class="fw-bold fs-4 mb-3">Login</center>
    <form action="{{ route('login.proses') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control">
        </div>
        <div class="form-group mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
            <input type="password" name="password" id="password" class="form-control">
            <div class="input-group-text">
                <span class="fa fa-eye-slash" id="show" aria-hidden="true"></span>
            </div>
        </div>
        </div>
        <button type="submit" class="btn btn-sm bg-success w-100 text-white">Login</button>
    </form>
    <script>
        var password = document.getElementById('password');
        var show = document.getElementById('show');
        show.addEventListener('click', function(){
            if(password.type == 'password'){
                password.type = 'text';
                show.classList.remove('fa-eye-slash');
                show.classList.add('fa-eye');
            }
            else{
                password.type = 'password';
                show.classList.remove('fa-eye');
                show.classList.add('fa-eye-slash');
            }
        });
    </script>
@endsection