<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SelectClass</title>
    {{-- bootstrip css --}}
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>



    <div>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>    
        @endif
    </div>


    <h1>Connecting teacher with Subject.</h1>

    <br>
    <br>

    <form action="{{Route('secretary.ConnectingTeacherWithSubject')}}" method="POST">
        @csrf
        <select class="form-control" name="Teacher" id="Teacher">
            <option value="" 	disabled>Select Teacher</option>
            @foreach ($Teachers as $t)
                <option value="{{$t->teacher_id}}">{{$t->firstname}} {{$t->lastname}}</option>
            @endforeach
        </select>


        <br>
        <br>
        <br>
        <br>


        <select class="form-control" name="Subjects[]" id="Subjects" multiple>
            @foreach ($Subjects as $s)
                <option value="{{$s->Subject_id}}">{{$s->sub_name}}</option>
            @endforeach
        </select>

        <br>
        <br>
        <br>

        <button class="btn btn-primary" type="submit">Connect</button>

    </form>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>


</body>
</html>