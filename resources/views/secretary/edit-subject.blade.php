<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit Subject</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    {{-- لاستقبال ال api --}}
    <meta name="_token" content="{{ csrf_token() }}">
    {{-- css --}}
    <link rel="stylesheet" href="{{ asset('./styles/style.css') }}">
</head>
<br>
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

    {{-- <div>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>    
        @endif
    </div> --}}





<br>


<section class="container"> 
    <header>Edit Subject</header>

    <form action="{{Route('secretary.updatesubject',$subject->idS)}}" method="POST" class="form">
        @csrf   



        <div class="column">
            <div class="input-box">
                <label>Subject Name</label>
                <input type="text" name="sub_name" id="sub_name" value="{{$subject->sub_name}}" class="form-control  @error('sub_name') is-invalid @enderror" placeholder="Enter Subject Name" />
            </div>
            @error('sub_name')
                <p class="invalid-feedback">{{$message}}</p>
            @enderror
        </div>







        <div class="column">
            <div class="input-box">
                <label>max</label>
                <input type="number" name="max" id="max" value="{{$subject->max}}" class="form-control  @error('max') is-invalid @enderror" />
            </div>
            @error('max')
                <p class="invalid-feedback">{{$message}}</p>
            @enderror

            <div class="input-box">
                <label>min</label>
                <input type="number" name="min" id="min" value="{{$subject->min}}" class="form-control  @error('min') is-invalid @enderror" />
            </div>
            @error('min')
                <p class="invalid-feedback">{{$message}}</p>
            @enderror
        </div>


{{-- bruce --}}



        <div class="column">
            <div class="input-box">
                <label>Max Mid</label>
                <input type="text" name="max_mid" id="max_mid" value="{{$subject->max_mid}}" class="form-control  @error('mid') is-invalid @enderror" />
            </div>
            @error('mid')
                <p class="invalid-feedback">{{$message}}</p>
            @enderror

            <div class="input-box">
                <label>Max In Class</label>
                <input type="text" name="max_in_class" id="max_in_class" value="{{$subject->max_in_class}}" class="form-control  @error('max_in_class') is-invalid @enderror" />
            </div>
            @error('max_in_class')
                <p class="invalid-feedback">{{$message}}</p>
            @enderror
        </div>


        <div class="column">
            <div class="input-box">
                <label>Max Homework</label>
                <input type="text" name="max_homework" id="max_homework" value="{{$subject->max_homework}}" class="form-control  @error('max_homework') is-invalid @enderror"/>
            </div>
            @error('max_homework')
                <p class="invalid-feedback">{{$message}}</p>
            @enderror

            <div class="input-box">
                <label>Max Final</label>
                <input type="text" name="max_final" id="max_final" value="{{$subject->max_final}}" class="form-control  @error('max_final') is-invalid @enderror" />
            </div>
            @error('max_final')
                <p class="invalid-feedback">{{$message}}</p>
            @enderror
        </div>








        <button type="submit">update Subject</button>

    </form>
</section>    


   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>

