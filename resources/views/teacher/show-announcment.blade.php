<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>teacher show announcment</title>
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
</html>