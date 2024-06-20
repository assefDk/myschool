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


<br>


    <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">subject</th>
              <th scope="col">sum / {{$mark->subject_teacher->subject->max}}</th>
              <th scope="col">mid / {{$mark->subject_teacher->subject->max_mid}}</th>
              <th scope="col">in class progress / {{$mark->subject_teacher->subject->max_in_class}}</th>
              <th scope="col">homework / {{$mark->subject_teacher->subject->max_homework}}</th>
              <th scope="col">final / {{$mark->subject_teacher->subject->max_final}}</th>
              <th scope="col">avg / 100 %</th>
              <th scope="col">estimation</th>
            </tr>
          </thead>
          <tbody>
            <tr>
                <tr>
                    <th scope="row">   {{$mark->subject_teacher->subject->sub_name}}</th>
                    <th scope="row">   {{$sume=$mark->mid+$mark->in_class+$mark->homework+$mark->final;}}</th>
                    <th scope="row">   {{$mark->mid}}</th>
                    <th scope="row">   {{$mark->in_class}}</th>
                    <th scope="row">   {{$mark->homework}}</th>
                    <th scope="row">   {{$mark->final}}</th>
                    <th scope="row">   {{number_format($sume*100/$mark->subject_teacher->subject->max, 2, '.', ',')}} %</th>
                    <th scope="row">   everybody is good for now ....</th>
                </tr>    
            </tr>
            
          </tbody>
        </table>
      </div>



<br>
<br>
<br>
<br>
<br>

    {{$mark->subject_teacher->subject->sub_name}} is seperated into |_  
    @foreach  ($seperatedM as $sep)
      {{$sep->subject_teacher->subject->sub_name}} _|_
    @endforeach
                


@foreach  ($seperatedM as $sep)
<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">subject</th>
        <th scope="col">sum / {{$sep->subject_teacher->subject->max}}</th>
        <th scope="col">mid / {{$sep->subject_teacher->subject->max_mid}}</th>
        <th scope="col">in class progress / {{$sep->subject_teacher->subject->max_in_class}}</th>
        <th scope="col">homework / {{$sep->subject_teacher->subject->max_homework}}</th>
        <th scope="col">final / {{$sep->subject_teacher->subject->max_final}}</th>
        <th scope="col">avg / 100 %</th>
        <th scope="col">estimation</th>
      </tr>
    </thead>
    <tbody>
      <tr>
          <tr>
              <th scope="row">   {{$sep->subject_teacher->subject->sub_name}}</th>
              <th scope="row">   {{$sume=$sep->mid+$sep->in_class+$sep->homework+$sep->final;}}</th>
              <th scope="row">   {{$sep->mid}}</th>
              <th scope="row">   {{$sep->in_class}}</th>
              <th scope="row">   {{$sep->homework}}</th>
              <th scope="row">   {{$sep->final}}</th>
              <th scope="row">   {{number_format($sume*100/$sep->subject_teacher->subject->max, 2, '.', ',')}} %</th>
              <th scope="row">   everybody is good for now ....</th>
          </tr>    
          @endforeach

      
                {{-- @foreach ($subjects as $s)
                <tr>
                    <th scope="row">   {{$s->Subject_id}}</th>
                    <th scope="row">   {{$s->sub_name}}</th>
                    <th scope="row">   {{$s->max}}</th>
                    <th scope="row">   {{$s->min}}</th>
                    <th scope="row">   {{$s->ClassId}}</th>
                    <th scope="row"> <a href="{{route('secretary.editsubject',$s->Subject_id)}}" class="btn btn-success">Edit</a></th>

                    <th scope="row">
                      <form action="{{route('secretary.destroysubject',$s->Subject_id)}}" method="post">
                        @csrf
                        @method('delete')
                        <input class="btn btn-danger" type="submit" value="Delete" >
                      </form> 
                    </th></tr>    
                @endforeach --}}
            </tr>
            
          </tbody>
        </table>
      </div>
      
      


    {{-- bootstrip script --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>