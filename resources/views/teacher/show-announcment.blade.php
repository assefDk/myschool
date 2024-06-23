



@extends('components.layout_teacher')



@section('titleteacher','teacher Add Announcment')


@section('contentteacher')
    <link rel="stylesheet" href="{{ asset('./s/style.css') }}" />

    <title>Announcments</title>
</head>
<body>
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