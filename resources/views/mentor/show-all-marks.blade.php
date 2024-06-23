@extends('components.layout_mentor')



@section('titlementor','mentor Add Announcment')


@section('contentmentor')
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
        
        select {
          width: calc(100% - 22px);
          padding: 10px;
          border: 1px solid #ccc;
          border-radius: 4px;
        }
        </style>
    

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
    <br>
    <br>
    <br>

    <br>
    <br>
    <br>
    <br>

    <br>
    
    

    

    {{-- <form action="{{Route('mentor.showStudents')}}" method="POST">
        @csrf
        

        <br>

        
        
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

        <div style="display: flex; justify-content: center;">
            <button type="submit" class="btn bsb-btn-xl btn-success py-3 ">show students</button>
        </div>


    </form> --}}





    
    <form action="{{Route('mentor.showStudents')}}" method="POST">
        @csrf
    <h2>Enter Marks details</h2>


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
        <option>Select Class</option>
        </select>
    </div>






    {{-- <label>division</label>
    <select name="division" id="division">
        <option >Select division</option>
    </select>
    @error('division')
        <p class="invalid-feedback">{{$message}}</p>
    @enderror --}}


    <div class="form-group">
        <label>Division :</label>
        <select name="division" id="division">
        <option >Select division</option>
        </select>
    </div> 


    <button type="submit">Show Marks</button>
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



        

        

    });


    </script>
@endsection
