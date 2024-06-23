@extends('components.layout_secretary')



@section('titleSecretary','dachbord')


@section('contentSecretary')
    {{-- bootstrip css --}}
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    {{-- css --}}
    <link rel="stylesheet" href="{{ asset('./styles/style.css') }}">
</head>
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
{{-- 
    <div>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>    
        @endif
    </div> --}}




    <section class="container"> 
        <header>Connecting teacher with Subject.</header>
    <form action="{{Route('secretary.ConnectingTeacherWithSubject')}}" method="POST" class="form">
        @csrf
        <label>Teacher</label>
        <select class="form-control" name="Teacher" id="Teacher">
            <option value="" 	disabled>Select Teacher</option>
            @foreach ($Teachers as $t)
                <option value="{{$t->idT}}">{{$t->firstname}} {{$t->lastname}}</option>
            @endforeach
        </select>


        <br>
        <br>
        <br>
        <br>

        <label>majors</label>
        <select class="form-control" name="Majors" id="Majors">
            <option value="">Select Major</option>
            @foreach ($Majors as $m)
                <option value="{{$m->MajorId}}">{{$m->name}}</option>
            @endforeach
        </select>
        @error('name')
            <p class="invalid-feedback">{{$message}}</p>
        @enderror


        <br>
        <br>
        <br>
        <br>


        <label>Class</label>
        <select class="form-control" name="class" id="class">
            <option value="" >Select Class</option>
        </select>
        @error('class')
            <p class="invalid-feedback">{{$message}}</p>
        @enderror


        <br>
        <br>
        <br>
        <br>


        <label>Division</label>
        <select class="form-control" name="division" id="division">
            <option value="">Select division</option>
        </select>
        @error('class')
            <p class="invalid-feedback">{{$message}}</p>
        @enderror



        <br>
        <br>
        <br>
        <br>



        <select class="form-control" name="Subjects" id="Subjects" multiple>
            <option value="" disabled>Select Subject</option>
        </select>

        <br>
        <br>
        <br>

        <button class="btn btn-primary" type="submit">Connect</button>

    </form>
</section>




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

                // if(Majors == ""){
                //     var Majors = 0;
                // }

                $.ajax({
                    url : '{{ url("secretary/fetchClass/")}}/'+ Majors,
                    type : 'post',
                    datatype: 'json',
                    success: function(response){
                        //من اجل تفضية ال opthin بعد كل تحديد
                        $('#class').find('option:not(:first)').remove();
                        $('#division').find('option:not(:first)').remove();
                        $('#Subjects').find('option:not(:first)').remove();
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


            $('#class').change(function(){
                var clas = $(this).val();
                
                
                // console.log(clas);

                $.ajax({
                    url : '{{ url("secretary/fetchDivision/")}}/'+ clas,
                    type : 'post',
                    datatype: 'json',
                    success: function(response){
                        //من اجل تفضية ال opthin بعد كل تحديد
                        $('#division').find('option:not(:first)').remove();
                        $('#Subjects').find('option:not(:first)').remove();
                        if(response['status'] > 0)
                        {
                            // console.log(response);     
                            $.each(response['Division'],function(key,value){
                                $("#division").append("<option value='"+value['DivisionId']+"'>"+value['Numberdvs']+"</option>");
                            });
                        }
                    }
                });
                
            });



            $('#division').change(function(){
                var clas = $('#class').val();

                
                // console.log(clas);  

                $.ajax({
                    url : '{{ url("secretary/fetchSubject/")}}/'+ clas,
                    type : 'post',
                    datatype: 'json',
                    success: function(response){
                        //من اجل تفضية ال opthin بعد كل تحديد
                        $('#Subjects').find('option:not(:first)').remove();
                        if(response['status'] > 0)
                        {
                            // console.log(response);     
                            $.each(response['Subject'],function(key,value){
                                $("#Subjects").append("<option value='"+value['idS']+"'>"+value['sub_name']+"</option>");
                            });
                        }
                    }
                });

            });


        });
  
  
    </script>


@endsection