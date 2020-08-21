@extends('layout')

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-6">
            <form class="form-signin" method="POST">

                @include('partials.csrf_field')

                <div class="form-group">
                    <input type="text" name="login" id="inputEmail" class="form-control" placeholder="Логин" value="{{ $old->get('login') }}">
                    @if($errors->has('login'))
                        <span class="text-danger">Обязательное поле</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="inputPassword" class="sr-only">Password</label>
                    <input type="password" name="password" id="inputPassword" class="form-control"
                           placeholder="Пароль">
                    @if($errors->has('password'))
                        <span class="text-danger">Обязательное поле</span>
                    @endif
                </div>

                @if($errors->has('authentication'))
                    <span class="text-danger">Неверные двнные</span>
                @endif

                <button class="btn btn-lg btn-primary btn-block" type="submit">Вход</button>
            </form>
        </div>
    </div>

@endsection