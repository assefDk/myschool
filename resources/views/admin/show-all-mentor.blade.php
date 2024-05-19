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
    <h1>show all mentor</h1>



<br>

<a href="{{route('admin.dashboard')}}" class="btn btn-primary">bake</a>

    <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">id</th>
              <th scope="col">firstname</th>
              <th scope="col">lastname</th>
              <th scope="col">username</th>
              <th scope="col">phone</th>
              <th scope="col">address</th>
              <th scope="col">email</th>
              <th scope="col">birthdate</th>
              <th scope="col">fathername</th>
              <th scope="col">mothername</th>
              <th scope="col">gender</th>
            </tr>
          </thead>
          <tbody>
            <tr>
                @foreach ($user as $u)
                <tr>
                    <th scope="row">  {{$u->mentorid}}</th>
                    <th scope="row">  {{$u->firstname}}</th>
                    <td scope="row">   {{$u->lastname}} </td>
                    <td scope="row">   {{$u->username}} </td>
                    <td scope="row">   {{$u->phone}} </td>
                    <td scope="row">   {{$u->address}} </td>
                    <td scope="row">   {{$u->email}} </td>
                    <td scope="row">   {{$u->birthdate}} </td>
                    <td scope="row">   {{$u->fathername}} </td>
                    <td scope="row">   {{$u->mothername}} </td>
                    <td scope="row">   {{$u->gender}} </td>
                    <td scope="row"> <a href="{{route('admin.editmentor',$u->mentorid)}}" class="btn btn-success">Edit</a></td>
                    <td scope="row">
                      <form action="{{route('admin.destroymentor',$u->mentorid)}}" method="post">
                        @csrf
                        @method('delete')
                        <input class="btn btn-danger" type="submit" value="Delete" >
                      </form> 
                    </td>
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