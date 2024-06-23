{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>secrtary show announcment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>



    @foreach ($Announcments as $a)
        <div class="card mb-3 w-50">
            <div class="card-body">
                <h5 class="card-title">{{$a->title}}</h5>

                <p class="card-text">{{$a->content}}</p>
                <p class="card-text"><small class="text-muted">{{$a->Date_Created}}</small></p>
                <p class="card-text">{{$a->creator}}</p>
            </div>
        </div>
        <br>
    @endforeach



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html> --}}


@extends('components.layout_secretary')

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

@section('titleSecretary','dachbord')


@section('contentSecretary')
    <link rel="stylesheet" href="{{ asset('./s/style.css') }}" />

    <title>Announcments</title>
</head>
<body>
    <div style="display: flex; justify-content: center; align-items: center;">
    <h2 style="margin: 10px;">Announcments</h2>
    </div>

    @foreach ($Announcments as $a)
        <div class="settings-container">
            <div class="settings-content">
                <h3>{{$a->title}}</h3>
                <p>{{$a->content}}</p>
                <div class="label-container">
                <label class="creator">{{$a->creator}}</label>
                <label class="date">{{$a->Date_Created}}</label>
                </div>                   
            </div>
        </div>           
    @endforeach

</body>
</html>
@endsection




