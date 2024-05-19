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
    <h1>show all Class</h1>

    <a type="button" class="btn btn-primary" href="dashbosrd">back</a>
    
<br>



    @if (Session::has('success'))
    <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif
    {{-- @if (Session::has('error'))
    <div class="alert alert-danger">{{Session::get('error')}}</div>
    @endif --}}
    <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              {{-- <th scope="col">id</th> --}}
              <th scope="col">ClassName</th>
              <th scope="col">division</th>
              <th scope="col">Major</th>
              
            </tr>
          </thead>
          <tbody>
          <tr>
                @foreach ($classes as $c)
                    @csrf
                    <span id="DivisionId" name="DivisionId"></span>
                      <tr>
                          {{-- <td scope="row" id="DivisionId" name="DivisionId">  {{$c->DivisionId}} </td> --}}
                          {{-- <td scope="row" id="idClass" name="idClass"></td> --}}
                          <td scope="row">  {{$c->ClassName}} </td>
                          <td scope="row">  {{$c->Numberdvs}} </td>
                          <td scope="row">  {{$c->name}}  </td>
                          <td scope="row"> <a type="button" class="btn btn-danger" href="deleteClass/{{$c->DivisionId}}/{{$c->ClassId}}">Delete</a></td>  
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


