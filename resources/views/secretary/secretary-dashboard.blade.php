@extends('components.layout_secretary')



@section('titleSecretary','dachbord')


@section('contentSecretary')


@if (Session::has('error'))
    <div style="display: flex; align-items: center; justify-content: center; color: red ">
        <div class="alert alert-danger">{{Session::get('error')}}</div>
    </div>
    @endif
    @if (Session::has('success'))
    <div style="display: flex; align-items: center; justify-content: center; color: green ">
        <div class="alert alert-success">{{Session::get('success')}}</div>
    </div>
    @endif

@endsection




