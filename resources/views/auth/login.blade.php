@extends('layouts.app')

@section('content')
    <navbar-component></navbar-component>

    <login-form-component></login-form-component>
    <a href="/login/github">Github</a>
    <footer-component></footer-component>

@endsection
