<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>teacherAdd mark</title>
      <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        {{-- لاستقبال ال api --}}
    <meta name="_token" content="{{ csrf_token() }}">
   </head>
   <body style="background: #596275">
    

    <div>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>    
        @endif
    </div>

    
    <h1 class="text-center">Add mark</h1>
    <a type="button" class="btn btn-primary" href="dashbosrd">back</a>

        @if (Session::has('success'))
            <div class="alert alert-success">{{Session::get('success')}}</div>
        @endif

   
    <br>
    <br>
    <br>
    <br>

    

    

    <form action="{{Route('teacher.ProcessAddMark',$mark->id)}}" method="POST">
        {{-- <form action="" method="Get"> --}}
            @csrf
            <label>mid /{{$mx->max_mid}}</label>
            <input type="text" name="mid" id="mid" value="{{$mark->mid}}" class="form-control  @error('mid') is-invalid @enderror">
    
            @error('mid')
                <p class="invalid-feedback">{{$message}}</p>
            @enderror
    
    
    
            <br>
            <br>
            <label>in_class /{{$mx->max_in_class}}</label>
            <input type="text" name="in_class" id="in_class" value="{{$mark->in_class}}" class="form-control  @error('in_class') is-invalid @enderror">
    
            @error('in_class')
                <p class="invalid-feedback">{{$message}}</p>
            @enderror
    
            <br>
            <br>
            <label>homework /{{$mx->max_homework}}</label>
            <input type="text" name="homework" id="homework" value="{{$mark->homework}}" class="form-control  @error('homework') is-invalid @enderror">
    
            @error('homework')
                <p class="invalid-feedback">{{$message}}</p>
            @enderror
    
    
    
            <br>
            <br>
            <label>final /{{$mx->max_final}}</label>
            <input type="text" name="final" id="final" value="{{$mark->final}}" class="form-control  @error('final') is-invalid @enderror">
    
            @error('final')
                <p class="invalid-feedback">{{$message}}</p>
            @enderror
    
    
            <br>
           
            
    
    
        








        <div style="display: flex; justify-content: center;">
            <button type="submit" class="btn bsb-btn-xl btn-success py-3 "> add mark</button>
        </div>


    </form>








    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html> 




