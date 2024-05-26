<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SelectClass</title>
    {{-- bootstrip css --}}
    <meta name="_token" content="{{ csrf_token() }}">
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


    <h1>Connecting teacher with Subject.</h1>

    <br>
    <br>

    <form action="{{Route('secretary.ConnectingTeacherWithSubject')}}" method="POST">
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



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>


</body>
</html>