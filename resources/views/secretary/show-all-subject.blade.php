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


    <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">id</th>
              <th scope="col">name</th>
              <th scope="col">max</th>
              <th scope="col">min</th>
              <th scope="col">ClassId</th>
              <th scope="col">major</th>
            </tr>
          </thead>
          <tbody>
            <tr>
                @foreach ($subjects as $s)
                <tr>
                    <th scope="row">   {{$s->Subject_id}}</th>
                    <th scope="row">   {{$s->sub_name}}</th>
                    <th scope="row">   {{$s->max}}</th>
                    <th scope="row">   {{$s->min}}</th>
                    <th scope="row">   {{$s->ClassId}}</th>
                    <td scope="row"> <button type="button" class="btn btn-success">Edit</button></td>
                    <td scope="row"> <button type="button" class="btn btn-danger">Delete</button></td>  
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