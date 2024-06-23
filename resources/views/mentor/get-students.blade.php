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

    <h1>show students</h1>



<br>

{{-- <a href="{{route('mentor.dashboard')}}" class="btn btn-primary">back</a> --}}

    <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">student_id</th>
              <th scope="col">full name</th>
              <th scope="col">avg</th>
              </tr>
          </thead>
          <tbody>
            <tr>
                @foreach ($myquery as $u)
                <tr>
                    <th scope="row">  {{$u->student_id}}</th>
                    <th scope="row">  {{$u->firstName}} {{$u->fathernName}} {{$u->lastName}}</th>
                    <td scope="row">   {{$t=number_format($u->res*100/$mx, 2, '.', ',');}} % </td>
                    <td scope="row"> <a href="{{route('mentor.studentDetails',$u->student_id)}}" class="btn btn-success">details</a></td>
                    {{-- <td scope="row">
                      <form action="{{route('admin.destroymentor',$u->mentorid)}}" method="post">
                        @csrf
                        @method('delete')
                        <input class="btn btn-danger" type="submit" value="Delete" >
                      </form> 
                    </td> --}}
                </tr>    
                @endforeach
            </tr>
            
          </tbody>
        </table>
      </div>
      


    {{-- bootstrip script --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>