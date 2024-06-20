<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit Subject</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    {{-- لاستقبال ال api --}}
    <meta name="_token" content="{{ csrf_token() }}">
    <style>
        label {
            margin-right: 20px;
        }
    </style>
</head>
<br>
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




    <h1>edit Subject</h1>

    {{-- secretary.processAddSubject --}}
<br>
    <form action="{{Route('secretary.updatesubject',$subject->idS)}}" method="POST">
        @csrf   

        <label for="">name</label>
        <input type="text" name="sub_name" value="{{$subject->sub_name}}">

        <br>
        <br>

        <label for="">max</label>
        <input type="number" name="max" value="{{$subject->max}}">

        <br>
        <br>

        <label for="">min</label>
        <input type="number" name="min" value="{{$subject->min}}">
        
        {{-- <input type="number" name="ClassId" value="{{$subject->ClassId}}"> --}}
        <br>

{{-- bruce --}}

<label>max mid</label>
<input type="text" name="max_mid" id="max_mid" value="{{$subject->max_mid}}" class="form-control  @error('mid') is-invalid @enderror">

@error('mid')
    <p class="invalid-feedback">{{$message}}</p>
@enderror



<br>
<br>
<label>max in_class</label>
<input type="text" name="max_in_class" id="max_in_class" value="{{$subject->max_in_class}}" class="form-control  @error('in_class') is-invalid @enderror">

@error('in_class')
    <p class="invalid-feedback">{{$message}}</p>
@enderror

<br>
<br>
<label>max homework</label>
<input type="text" name="max_homework" id="max_homework" value="{{$subject->max_homework}}" class="form-control  @error('homework') is-invalid @enderror">

@error('homework')
    <p class="invalid-feedback">{{$message}}</p>
@enderror



<br>
<br>
<label>max final</label>
<input type="text" name="max_final" id="max_final" value="{{$subject->max_final}}" class="form-control  @error('final') is-invalid @enderror">

@error('final')
    <p class="invalid-feedback">{{$message}}</p>
@enderror



{{-- end bruce --}}

        


        <br>
       
        <br>
        <br>

        <button class="btn bsb-btn-xl btn-primary py-3" type="submit">update Subject</button>

    </form>
    


   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>

