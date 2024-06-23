



@extends('components.layout_teacher')



@section('titleteacher','techer Add Note')


@section('contentteacher')
        {{-- لاستقبال ال api --}}
    <meta name="_token" content="{{ csrf_token() }}">

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
    <style>
        body {
          text-align: center;
          background-color: #f7f7f7;
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



    {{-- <h1>techer Add Note</h1>





    
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
    <a type="button" class="btn btn-primary" href="dashbosrd">back</a>

        @if (Session::has('success'))
            <div class="alert alert-success">{{Session::get('success')}}</div>
        @endif

   
    <br>
    <br>
    <br>
    <br>

    

    

    <form action="{{Route('teacher.ProcessAddNode')}}" method="POST">
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
            <option value="">select majors</option>
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


    </form> --}}





    <h1>Enter The Note</h1>
    <form action="{{Route('teacher.ProcessAddNode')}}" method="POST">
        @csrf
        <div class="form-group">
            <label>Majors :</label>
            <select name="Majors" id="Majors">
            <option value="" hidden>select majors</option>
            @foreach ($Majors as $m)
                <option value="{{$m->MajorId}}">{{$m->name}}</option>
            @endforeach
            </select>
        </div>


        <div class="form-group">
            <label>Class :</label>
            <select name="class" id="class">
            <option hidden>Select Class</option>
            </select>
        </div>
        @error('class')
            <p class="invalid-feedback">{{$message}}</p>
        @enderror




        <div class="form-group">
            <label>Division :</label>
            <select name="division" id="division">
                <option >Select division</option>
            </select>
        </div>


        <div class="form-group">
            <label>Student  :</label>
            <select name="Student" id="Student">
                <option >Select Student </option>
            </select>
        </div>



        <div class="form-group">
            <label for="content">Text Note :</label>
            <textarea id="content" name="content" rows="4"></textarea>
        </div>

        <button type="submit">Add Note</button>
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


                console.log(Majors);
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










            //#Student
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



@endsection


