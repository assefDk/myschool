<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        {{-- لاستقبال ال api --}}
        <meta name="_token" content="{{ csrf_token() }}">
    <title>add-homework</title>
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

    <a class="btn btn-primary " href="{{Route('teacher.dashbosrd')}}"> back</a>



    <br>
    <br>


    @if (Session::has('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif
    <center>
        <h1> add homework</h1>
    </center>
<br>







    <form action="{{Route('teacher.ProcessAddHomework')}}" method="POST" enctype="multipart/form-data">
        @csrf



        <div class="mb-3" style="text-align: center; align-items: center; justify-content: center; display: flex;">
            <label>majors</label>
            <select name="Major" id="Major">
                <option value="">select Major</option>
                @foreach ($Majors as $m)
                    <option value="{{$m->MajorId}}">{{$m->name}}</option>
                @endforeach
            </select>
            @error('name')
                <p class="invalid-feedback">{{$message}}</p>
            @enderror
        </div>

        
        <br>
        <br>
        <div class="mb-3" style="text-align: center; align-items: center; justify-content: center; display: flex;">
            <label>class</label>
            <select name="class" id="class">
                <option>Select Class</option>
            </select>
            @error('class')
                <p class="invalid-feedback">{{$message}}</p>
            @enderror
        </div>
        

        
        <br>
        <br>
        <div class="mb-3" style="text-align: center; align-items: center; justify-content: center; display: flex;">
            <label>division</label>
            <select name="division" id="division">
                <option >Select division</option>
            </select>
            @error('division')
                <p class="invalid-feedback">{{$message}}</p>
            @enderror
        </div>



        <br>
        <br>
        <div class="mb-3" style="text-align: center; align-items: center; justify-content: center; display: flex;">
            <label>Subject</label>
            <select name="Subject" id="Subject">
                <option >Select Subject</option>
            </select>
            @error('division')
                <p class="invalid-feedback">{{$message}}</p>
            @enderror
        </div>




        <br>
        <br>


            <div class="mb-3" style="text-align: center; align-items: center; justify-content: center; display: flex;">
                <label for="">end date</label>
                <input type="date" name="endDate">
            </div>

        <br>
            <div class="mb-3" style="text-align: center; align-items: center; justify-content: center; display: flex;">
                <input class="form-control w-50 " name="file" type="file" id="formFile">
            </div>


        <br>
        <br>


            <div class="mb-3" style="text-align: center; align-items: center; justify-content: center; display: flex;">
                <button type="submit" class="btn bsb-btn-xl btn-success py-3 "> Add Homework</button>
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
            $('#Major').change(function(){
                var Major = $(this).val();

                if(Major == ""){
                    var Major = 0;
                }

                $.ajax({
                    url : '{{ url("teacher/fetchClass/")}}/'+ Major,
                    type : 'post',
                    datatype: 'json',
                    success: function(response){
                        //من اجل تفضية ال opthin بعد كل تحديد
                        $('#class').find('option:not(:first)').remove();
                        $('#division').find('option:not(:first)').remove();
                        $('#Subject').find('option:not(:first)').remove();
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




            //#Subject
            $('#division').change(function(){
                var div = $('#division').val();
                var clas = $('#class').val();


                console.log(div);


                $.ajax({
                    url : '{{ url("teacher/fetchSubject/")}}/'+div,
                    type : 'post',
                    datatype: 'json',
                    success: function(response){
                        console.log(response);
                        if(response['status'] > 0)
                        {
                            //من اجل تفضية ال opthin بعد كل تحديد
                            $('#Subject').find('option:not(:first)').remove();
                            $.each(response['Subject'],function(key,value){
                                $("#Subject").append("<option value='"+value['idS']+"'>"+value['sub_name']+"</option>");
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