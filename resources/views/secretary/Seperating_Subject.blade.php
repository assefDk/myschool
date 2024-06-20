<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SelectClass</title>
    
    <meta name="_token" content="{{ csrf_token() }}">
    {{-- bootstrip css --}}
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
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


    <h1>Seperating Subject.</h1>

    <br>
    <br>

    <form action="{{Route('secretary.SeperatingSubject')}}" method="POST">
        @csrf
      
        <br>
        <br>
        <br>
        <br>


        <label>class</label>
        <select name="cls" id="cls">
            <option value="" disabled>select class</option>
            @foreach ($cls as $c)
                <option value="{{$c->ClassId}}">{{$c->ClassName}}</option>
            @endforeach
        </select>
        @error('name')
            <p class="invalid-feedback">{{$message}}</p>
        @enderror


        <br>
         select the subject you want to seperate
        <select class="form-control" name="Subject" id="Subject" >
            @foreach ($Su as $s)
                <option value="{{$s->idS}}">{{$s->sub_name}}</option>
            @endforeach
        </select>
        {{-- enter into how many subjects you want to seperate
        <input type="number" name="num" id="num" value="{{old('num')}}" class="form-control  @error('num') is-invalid @enderror">

        @error('num')
            <p class="invalid-feedback">{{$message}}</p>
        @enderror
         --}}




         <label for="">name</label>
         <input type="text" name="sub_name">
 
         <br>
         <br>
 
         <label for="">max</label>
         <input type="number" name="max">
 
         <br>
         <br>
 
         <label for="">min</label>
         <input type="number" name="min">
         <br>
 
         <br>
         <br>
 

         



         <label>max mid</label>
         <input type="text" name="max_mid" id="max_mid" value="{{old('max_mid')}}" class="form-control  @error('mid') is-invalid @enderror">
 
         @error('mid')
             <p class="invalid-feedback">{{$message}}</p>
         @enderror
 
 
 
         <br>
         <br>
         <label>max in_class</label>
         <input type="text" name="max_in_class" id="max_in_class" value="{{old('max_in_class')}}" class="form-control  @error('in_class') is-invalid @enderror">
 
         @error('in_class')
             <p class="invalid-feedback">{{$message}}</p>
         @enderror
 
         <br>
         <br>
         <label>max homework</label>
         <input type="text" name="max_homework" id="max_homework" value="{{old('max_homework')}}" class="form-control  @error('homework') is-invalid @enderror">
 
         @error('homework')
             <p class="invalid-feedback">{{$message}}</p>
         @enderror
 
 
 
         <br>
         <br>
         <label>max final</label>
         <input type="text" name="max_final" id="max_final" value="{{old('max_final')}}" class="form-control  @error('final') is-invalid @enderror">
 
         @error('final')
             <p class="invalid-feedback">{{$message}}</p>
         @enderror
 
 


        <br>
        <br>
        <br>

        <button class="btn btn-primary" type="submit">Connect</button>

    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script>
        //all
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        //#class
        $(document).ready(function(){
            $('#cls').change(function(){
                var cl = $(this).val();

                if(cl == ""){
                    var cl = 0;
                }

                $.ajax({
                    url : '{{ url("secretary/fetchSubject/")}}/'+ cl,
                    type : 'post',
                    datatype: 'json',
                    success: function(response){
                        //من اجل تفضية ال opthin بعد كل تحديد
                        $('#Subject').find('option:not(:first)').remove();
                        if(response['status'] > 0)
                        {
                            // console.log(response);     
                            $.each(response['sub'],function(key,value){
                                $("#Subject").append("<option value='"+value['Subject_id']+"'>"+value['sub_name']+"</option>");
                            });
                        }
                    }
                });

            });

        });


    </script>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>


</body>
</html>