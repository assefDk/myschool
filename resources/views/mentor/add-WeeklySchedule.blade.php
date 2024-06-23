@extends('components.layout_mentor')



@section('titlementor','Add WeeklySchedule')


@section('contentmentor')

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




      <link rel="stylesheet" href="{{ asset('./styles/StyleNour.css') }}" />
        {{-- لاستقبال ال api --}}
    <meta name="_token" content="{{ csrf_token() }}">

    <style>
        body { 
        text-align: center;
        background-color: #f7f7f7;
        margin: 20px;
      }
      #btn{display: flex; margin: 0px 0px 0px 20px;}
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
      
     .form-group .schedule-header label {
        display: block;
        margin-bottom: 5px;
        color: #000;
        font-weight: bold;
      }
      
      select,
      input[type='file'] {
        width: calc(100% - 22px);
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
      }
      </style>



    




    <h1> Add Weekly Schedule</h1>
    <form action="{{Route('mentor.ProcessAddWeeklySchedule')}}" method="post" enctype="multipart/form-data">
        @csrf


        <div class="form-group">
            <div class="Schedule-header">
            <label>Majors :</label>
            <select name="Majors" id="Majors">
                <option value="" hidden>select Major</option>
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


        <div class="form-group">
            <label>Division :</label>
            <select name="division" id="division">
            <option >Select division</option>
            </select>
        </div>
        </div>

        <div class="form-group">
            <label class="Blod">Weekly Schedule File :</label>
            <input type="file" id="image" name="image">
            <label for="image" class="file-label">Upload a file</label>
        </div>





      <button type="submit">Publish</button>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>


@endsection


