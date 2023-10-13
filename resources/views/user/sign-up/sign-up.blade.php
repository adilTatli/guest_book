@extends('layouts.layout')

@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-5 mx-auto my-auto">
                <h3 class="mb-3">Регистрация</h3>
                <form method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Ваше имя</label>
                        <input value="{{ old('name') }}" name="name" type="text" class="form-control" id="name">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input value="{{ old('email') }}" name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">Мы никогда никому не передадим вашу электронную почту.</div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Пароль</label>
                        <input name="password" type="password" class="form-control" id="password">
                    </div>
                    <div class="mb-3">
                        <label for="repeatPassword" class="form-label">Повторите пароль</label>
                        <input name="password_confirmation" type="password" class="form-control" id="repeatPassword">
                    </div>
                    <button type="submit" class="btn btn-primary">Регистрация</button>

                </form>
            </div>
        </div>
    </div>

@endsection
