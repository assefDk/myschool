@extends('components.layout_secretary')



@section('titleSecretary','dachbord')


@section('contentSecretary')
   {{-- bootstrip css --}}
   <meta name="_token" content="{{ csrf_token() }}">
   <link rel="stylesheet" href="{{ asset('./styles/style.css') }}">
</head>
<body>
    {{-- <h1>Select Class</h1> --}}
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


    <div>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>    
        @endif
    </div>


    <section class="container"> 
        <header>Select Class</header>
            <form action="{{Route('secretary.ShowAllSubject')}}" method="POST" class="form">
                @csrf

                <div class="column">

                    <div class="column">
                        <div class="select-box">                        
                            <select name="Majors" id="Majors">
                                <option hidden>Majors</option>
                                @foreach ($Majors as $m)
                                    <option value="{{$m->MajorId}}">{{$m->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @error('name')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror


                    <div class="column">
                        <div class="select-box">
                            <select name="class" id="class">
                                <option hidden>Select Class</option>
                            </select>
                        </div>
                    </div>
                    @error('class')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror
    
                </div>
                
                <button type="submit">Show</button>
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

                if(Majors == ""){
                    var Majors = 0;
                }

                $.ajax({
                    url : '{{ url("secretary/fetchClass/")}}/'+ Majors,
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

        });


    </script>

@endsection