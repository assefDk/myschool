<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- bootstrip css --}}
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <h1>show all subject</h1>

    @if (Session::has('delete'))
    <div class="alert alert-success">{{Session::get('delete')}}</div>
@endif

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


<br>

      {{$student->firstName}} {{$student->fathernName}} {{$student->lastName}} {{--$student->major->name--}}
    <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">subject</th>
              <th scope="col">is Seperated ?</th>
              <th scope="col">teacher</th>
              <th scope="col">mark</th>
              <th scope="col">max</th>
              <th scope="col">avg</th>
            </tr>
          </thead>
          <tbody>
            <tr>
                @foreach ($marksn as $m)
                <tr>
                 
                    
                  <th scope="row">   {{$m->subject_teacher->subject->sub_name}}</th>
                  <th scope="row">    @if(app('App\Http\Controllers\mentor\DashbosrdController')->isSeperated($m->subject_teacher->subject->idS))
                    yes
                @else
                    no
                @endif</th>
                  <th scope="row">   {{$m->subject_teacher->teacher->firstname}} {{$m->subject_teacher->teacher->lastname}}</th>
                    <th scope="row">   {{$up=$m->mid+$m->in_class+$m->homework+$m->final;}}</th>
                    <th scope="row">   {{$down=$m->subject_teacher->subject->max;}}</th>
                    <th scope="row">   {{number_format($up*100/$down, 2, '.', ',')}} %</th>

                     <th scope="row"> <a href="{{route('mentor.markDetails',$m->id)}}" class="btn btn-success">Details</a></th>
{{--
                    <th scope="row">
                       <form action="{{route('secretary.destroysubject',$s->Subject_id)}}" method="post">
                        @csrf
                        @method('delete')
                        <input class="btn btn-danger" type="submit" value="Delete" >
                      </form>  --}} 
                    </th></tr>    
                @endforeach
            </tr>
            
          </tbody>
        </table>
      </div>
      


    {{-- bootstrip script --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>