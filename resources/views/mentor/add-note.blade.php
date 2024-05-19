<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>mentor Add Note</title>
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

    
    <h1 class="text-center">Add Note</h1>
    <a type="button" class="btn btn-primary" href="dashbosrd">backe</a>

        @if (Session::has('success'))
            <div class="alert alert-success">{{Session::get('success')}}</div>
        @endif

   
    <br>
    <br>
    <br>
    <br>

    

    

    <form action="{{Route('mentor.ProcessAddNote')}}" method="POST">
        @csrf
        

        <br>

        <div style="display: flex; justify-content: center;">
            <h4> Content note</h4>
        </div>
        <div style="display: flex; justify-content: center;">
            <br>
            <div class="form-outline w-50 mb-4" style="display: block">
                <textarea class="form-control" id="content" name="content" rows="9" ></textarea>
            </div>
            <br>
        </div>
        
        
        <br>
        <br>

        <label>majors</label>
        <select name="Majors" id="Majors">
            @foreach ($Majors as $m)
                <option value="{{$m->MajorId}}">{{$m->name}}</option>
            @endforeach
        </select>
        @error('name')
            <p class="invalid-feedback">{{$message}}</p>
        @enderror

        
        <br>
        <br>
        <label>class</label>
        <select name="class" id="class">
            <option>Select Class</option>
        </select>
        @error('class')
            <p class="invalid-feedback">{{$message}}</p>
        @enderror

        

        
        <br>
        <br>
        <label>division</label>
        <select name="division" id="division">
            <option >Select division</option>
        </select>
        @error('division')
            <p class="invalid-feedback">{{$message}}</p>
        @enderror



        <br>
        <br>
        <label>Student</label>
        <select name="Student" id="Student">
            <option>Select Student</option>
        </select>
        @error('Student')
            <p class="invalid-feedback">{{$message}}</p>
        @enderror



        <div style="display: flex; justify-content: center;">
            <button type="submit" class="btn bsb-btn-xl btn-success py-3 "> add note</button>
        </div>


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
            $('#Majors').change(function(){
                var Majors = $(this).val();

                if(Majors == ""){
                    var Majors = 0;
                }

                $.ajax({
                    url : '{{ url("mentor/fetchClass/")}}/'+ Majors,
                    type : 'post',
                    datatype: 'json',
                    success: function(response){
                        //من اجل تفضية ال opthin بعد كل تحديد
                        $('#class').find('option:not(:first)').remove();
                        $('#division').find('option:not(:first)').remove();
                        if(response['status'] > 0)
                        {
                            // console.log(response);     
                            $.each(response['Classes'],function(key,value){
                                $("#class").append("<option value='"+value['ClassId']+"'>"+value['ClassName']+"</option>");
                            });
                        }
                    }
                });

            });

            //#division
            $('#class').change(function(){
                var class_id = $(this).val();

                console.log(class_id);


                $.ajax({
                    url : '{{ url("mentor/fetchDivision/")}}/'+ class_id,
                    type : 'post',
                    datatype: 'json',
                    success: function(response){
                        console.log(response);
                        if(response['status'] > 0)
                        {
                            //من اجل تفضية ال opthin بعد كل تحديد
                            $('#division').find('option:not(:first)').remove();
                            $.each(response['Division'],function(key,value){
                                $("#division").append("<option value='"+value['DivisionId']+"'>"+value['Numberdvs']+"</option>");
                            });
                        }
                    }
                });

            });







            //#Student
            $('#division').change(function(){
            var division_id = $(this).val();

            console.log(division_id);


            $.ajax({
                url : '{{ url("mentor/fetchStudent/")}}/'+ division_id,
                type : 'post',
                datatype: 'json',
                success: function(response){
                    console.log(response);
                    if(response['status'] > 0)
                    {
                        //من اجل تفضية ال opthin بعد كل تحديد
                        $('#Student').find('option:not(:first)').remove();
                        $.each(response['students'],function(key,value){
                            $("#Student").append("<option value='"+value['studentId']+"'>"+value['firstName']+"</option>");
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




