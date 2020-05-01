@extends('layouts.default')
@section('title', '註冊')

@section('content')
<div class="offset-md-2 col-md-8">
    <div class="card">
        <div class="card-header">
            <h5>註冊</h5>
        </div>
        <div class="card-body">
            @include('shared._errors')
            <form action="">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">名稱：</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="email">e-mail：</label>
                    <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label for="password">密碼：</label>
                    <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                </div>
                <div class="form-group">
                    <label for="password_confirmation">確認密碼：</label>
                    <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
                </div>
                <button type="submit" class="btn btn-primary">註冊</button>
            </form>
        </div>
    </div>
</div>
@stop