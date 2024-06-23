@extends('components.layout_teacher')



@section('titleteacher','show Add mark')


@section('contentteacher')


<style>
    body {
      text-align: center;
      background: linear-gradient(
              135deg,
              #052659,
              #006aff)
    }
    form {
      margin: 20px auto;
      max-width: 400px;
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 2px 4px rgba(0, 0, 0, 0.5);
    }
    .form-group {
      margin-bottom: 20px;
    }
    
    label {
      display: block;
      margin-bottom: 5px;
      color: #000;
      font-weight: bold;
    }
    
    select,
    textarea {
      width: calc(100% - 22px);
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    
    
    </style>

      
        {{-- لاستقبال ال api --}}
    <meta name="_token" content="{{ csrf_token() }}">
    

    {{-- <div>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>    
        @endif
    </div> --}}

    
    {{-- <h1 class="text-center">Add mark</h1>
    <a type="button" class="btn btn-primary" href="dashbosrd">back</a>

        @if (Session::has('success'))
            <div class="alert alert-success">{{Session::get('success')}}</div>
        @endif

   
    <br>
    <br>
    <br>
    <br>

    

    

    <form action="{{Route('teacher.addMark')}}" method="POST">
            @csrf
           
    
        <br>
        <br>

        <label>majors</label>
        <select name="Majors" id="Majors">
            <option value="" hidden>select major</option>

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
        <select name="student_id" id="student_id">
            <option>Select Student</option>
        </select>
        @error('student_id')
            <p class="invalid-feedback">{{$message}}</p>
        @enderror

        
        <br>

        <label>subject teacher</label>
        <select name="sub_tea" id="sub_tea">
            <option >Select subject teacher</option>
        </select>


        @error('name')
            <p class="invalid-feedback">{{$message}}</p>
        @enderror









        <div style="display: flex; justify-content: center;">
            <button type="submit" class="btn bsb-btn-xl btn-success py-3 "> add mark</button>
        </div>


    </form> --}}






    <form action="{{Route('teacher.addMark')}}" method="POST">
        <h1>Add Marks</h1>




        @csrf
           
    
        <br>
        <br>

        






        <div class="form-group">
          <label>Majors :</label>
          <select name="Majors" id="Majors">
            <option value="" hidden>Select Major</option>
            @foreach ($Majors as $m)
                <option value="{{$m->MajorId}}">{{$m->name}}</option>
            @endforeach
          </select>
        </div>
        @error('name')
            <p class="invalid-feedback">{{$message}}</p>
        @enderror



        <div class="form-group">
            <label for="division">class :</label>
        <select name="class" id="class">
            <option value="" hidden>select Class</option> 
        </select>
        </div>
        @error('class')
            <p class="invalid-feedback">{{$message}}</p>
        @enderror 


        <div class="form-group">
            <label for="division">division</label>
            <select name="division" id="division">
                <option value="" hidden>select division</option>
            </select>
        </div>
        @error('division')
            <p class="invalid-feedback">{{$message}}</p>
        @enderror



        <div class="form-group">
          <label>Student  :</label>
          <select name="student_id" id="student_id">
            <option value="" hidden>Select Student </option>
          </select>
        </div>
        @error('student_id')
            <p class="invalid-feedback">{{$message}}</p>
        @enderror









        {{-- <label>subject teacher</label>
        <select name="sub_tea" id="sub_tea">
            <option >Select subject teacher</option>
        </select> --}}

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
       

        <div class="form-group">
            <label>Student Teacher :</label>
            <select name="sub_tea" id="sub_tea">
            <option value="" hidden>Select</option>
          </select>
        </div>
        @error('name')
            <p class="invalid-feedback">{{$message}}</p>
        @enderror
      
       <a href="AddMarkT.html"> <button type="submit">Add Mark</button></a>
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
                    url : '{{ url("teacher/fetchClass/")}}/'+ Majors,
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
                    url : '{{ url("teacher/fetchDivision/")}}/'+ class_id,
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







            //#division
            $('#division').change(function(){
            var division_id = $(this).val();

            console.log(division_id);


            $.ajax({
                url : '{{ url("teacher/fetchStudent/")}}/'+ division_id,
                type : 'post',
                datatype: 'json',
                success: function(response){
                    console.log(response);
                    if(response['status'] > 0)
                    {
                        //من اجل تفضية ال opthin بعد كل تحديد
                        $('#student_id').find('option:not(:first)').remove();
                        $.each(response['students'],function(key,value){
                            $("#student_id").append("<option value='"+value['studentId']+"'>"+value['firstName']+"</option>");
                        });
                    }
                }
            });
        });   
        //#sub_tea
        $('#student_id').change(function(){
                    var stdc_id = $(this).val();

                    console.log(stdc_id);

                    $.ajax({
                        url : '{{ url("teacher/fetchsubtea/")}}/'+ stdc_id,
                        type : 'post',
                        datatype: 'json',
                        success: function(response){
                            console.log(response);
                            if(response['status'] > 0)
                            {
                                //من اجل تفضية ال opthin بعد كل تحديد
                                $('#sub_tea').find('option:not(:first)').remove();
                                $.each(response['subjectt'],function(key,value){
                                    $("#sub_tea").append("<option value='"+value['sub_tea_id']+"'>"+value['sub_name']+' _ ' + value['firstname']+' '+value['lastname']+"</option>");
                                });
                            }
                        }
                    });
                   
                });   
            

        });

    </script>
@endsection




