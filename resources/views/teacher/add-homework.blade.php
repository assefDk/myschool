
@extends('components.layout_teacher')



@section('titleteacher','Add Homework')
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

@section('contentteacher')
<style>
    body {
      text-align: center;
      margin: 0;
      padding: 0;
      background: linear-gradient(
              135deg,
              #052659,
              #006aff)
    }
    
    h1 {
      color: #000;
      margin: 20px;
    }
    
    form {
      margin: 20px auto;
      max-width: 400px;
      background-color: #fff;
      padding: 20px;
      border-radius: 12px;
      box-shadow:  4px 4px rgba(0, 0, 0, 0.5);
    }
    
    .form-group {
      margin-bottom: 20px;
    }
    
    .Blod {
      display: block;
      margin-bottom: 5px;
      color: #000;
      font-weight: bold;
    }
    
    select,
    input[type='date'],
    input[type='file'] {
      width: calc(100% - 22px);
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    
    button:hover {
      background-color: #052659;
    }
    </style>

    {{-- لاستقبال ال api --}}
    <meta name="_token" content="{{ csrf_token() }}">

<br>
<br>


        <form>
            <h1> Add Homework</h1>

            <div class="form-group">
                <label class="Blod">Majors</label>
                <select id="Major" name="Major">
                    <option value="" hidden>select Major</option>
                    @foreach ($Majors as $m)
                        <option value="{{$m->MajorId}}">{{$m->name}}</option>
                    @endforeach
                </select>
            </div>



            <div class="form-group">
                <label class="Blod">Class</label>
                <select name="class" id="class">
                    <option value="" hidden>Select Class</option>
                </select>
            </div>

            <div class="form-group">
                <label class="Blod">Division</label>
                <select name="division" id="division">
                    <option hidden>Select division</option>
                </select>
            </div>


            <div class="form-group">
                <label class="Blod">Subject</label>
                <select name="Subject" id="Subject">
                    <option hidden>Select Subject</option>
                </select>
            </div>



            <div class="form-group">
                <label for="deadline">End Date Homework</label>
                <input type="date" name="endDate">
            </div>


            <div class="form-group">
                <label class="Blod">Homework File</label>
                <input name="file" type="file" id="file">
                <label for="file" class="file-label">Uplaod a file</label>
            </div>

            <button type="submit">Add Homework</button>
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



                // console.log(Major);



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
@endsection