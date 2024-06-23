@extends('components.layout_mentor')



@section('titlementor','mentor Add Announcment')


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
   </head>
    <style>
    body {
        height: 100vh;
        background: linear-gradient(
            135deg,
            #052659,
            #006aff
        );
    }
    *,
    *:before,
    *:after {
        font-weight: 500px;
    }
    select {
        width: calc(100% );
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    </style>






    <div class="announcment-container">
        <h1>Add Announcment</h1>
        <p>Publish an announcment to a certain profission or to all profissions</p>
            <form action="{{Route('mentor.ProcessAddAnnouncment')}}" method="POST">
                @csrf
            <div class="row">
                <div class="column">
                    <div class="checkbox-container">
                        <!-- <div class="label-checkbox"><label for="all">All</label><input type="checkbox" id="all"></div>
                        <div class="label-checkbox"><label for="student">Students</label><input type="checkbox" id="student"></div> -->
                        <div class="label-checkbox"><label for="teatcher">Teatchers</label><input type="checkbox" id="teachers" name="teachers"></div>
                    </div>                 
                </div>      
            </div>





            <div class="row">
                <div class="column">
                    <label for="caption" >Major</label>
                    <select name="Majors" id="Majors">
                        <option value="" hidden>select major</option>
                        @foreach ($Majors as $m)
                            <option value="{{$m->MajorId}}">{{$m->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>




            <div class="row">
                <div class="column">
                    <label for="caption" >Class</label>
                    <select name="class" id="class">
                        <option value="" hidden>select class</option>
                    </select>
                </div>
            </div>         





            <div class="row">
                <div class="column">
                    <label for="caption">Division</label>
                    <select name="division" id="division">
                        <option value="division1" hidden>select division</option> 
                    </select>
                </div>
            </div>  
            <div class="row">
                <div class="column">
                    <label for="caption">title</label>
                    <input type="text" name="title" placeholder="The caption here">
                </div>      
            </div>           




            
            <div class="row">
                <div class="column">
                    <label for="content">Announcment's content </label>
                    <textarea id="content" name="content" placeholder="Write the announcment's content here " rows="3"></textarea>
                    <label for="content">Enter end date </label>
                        <input type="date" name="date" id="date">
                </div>
            </div>
            <button type="submit" onclick="openpopup()">Publish</button>
        </form>
    </div>





































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