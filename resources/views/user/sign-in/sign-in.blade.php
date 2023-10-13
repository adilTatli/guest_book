@extends('layouts.layout')

@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-5 mx-auto my-auto">
                <h3 class="mb-3">Авторизация</h3>
                <form method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input value="{{ old('email') }}" name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Пароль</label>
                        <input name="password" type="password" class="form-control" id="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Авторизация</button>

                </form>
            </div>
        </div>
    </div>

@endsection
