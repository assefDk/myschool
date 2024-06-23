@extends('components.layout_secretary')



@section('titleSecretary','dachbord')


@section('contentSecretary')
    {{-- لاستقبال ال api --}}
    <meta name="_token" content="{{ csrf_token() }}">

    {{-- css --}}
    <link rel="stylesheet" href="{{ asset('./styles/style.css') }}">


    <style>
        label {
            margin-right: 20px;
        }
    </style>
</head>
<br>
<body>
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



<section class="container"> 
    <header>Add Student</header>
        <form action="{{Route('processAddStudent')}}" method="POST" class="form">
            @csrf

            <div class="column">
                <div class="input-box">
                    <label>User Name</label>
                    <input type="text" name="username" id="username" value="{{old('username')}}" class="form-control  @error('username') is-invalid @enderror" placeholder="Enter User Name" />
                </div>
                @error('username')
                    <p class="invalid-feedback">{{$message}}</p>
                @enderror

                <div class="input-box">
                    <label>Password</label>
                    <input type="password" name="password" id="password" value="{{old('password')}}" class="form-control  @error('password') is-invalid @enderror" placeholder="Enter Password" />
                </div>
                @error('password')
                    <p class="invalid-feedback">{{$message}}</p>
                @enderror
            </div>

            <div class="input-box">
                <label>First Name</label>
                
                <input type="text" name="firstName" id="firstName" value="{{old('firstName')}}" class="form-control  @error('firstName') is-invalid @enderror" placeholder="Enter First Name"/>
                @error('firstname')
                    <p class="invalid-feedback">{{$message}}</p>
                @enderror
            </div>

            <div class="input-box">
                <label>Last Name</label>
                
                <input type="text" name="lastName" id="lastName" value="{{old('lastName')}}" class="form-control  @error('lastName') is-invalid @enderror" placeholder="Enter Last Name"/>
                @error('lastname')
                    <p class="invalid-feedback">{{$message}}</p>
                @enderror
            </div>

            <div class="column">
                <div class="input-box">
                    <label>Phone Number</label>
                    <input type="text" name="phone" id="phone" value="{{old('phone')}}" class="form-control  @error('phone') is-invalid @enderror" placeholder="Enter phone number"  />
                </div>
                @error('phone')
                    <p class="invalid-feedback">{{$message}}</p>
                @enderror 

                <div class="input-box">
                    <label>Birth Date</label>
                    <input type="date" name="birthdate" id="birthdate" value="{{old('birthdate')}}" class="form-control  @error('birthdate') is-invalid @enderror" placeholder="Enter birth date" />
                </div>
                @error('birthdate')
                    <p class="invalid-feedback">{{$message}}</p>
                @enderror 
            </div>

            <div class="input-box">
                <label>Address</label>
                <input type="text" name="adress" id="adress" value="{{old('adress')}}" class="form-control  @error('adress') is-invalid @enderror" placeholder="Enter Address"/>
                @error('address')
                    <p class="invalid-feedback">{{$message}}</p>
                @enderror 
            </div>
    
            <div class="input-box">
                <label>Email</label>
                <input type="email" name="email" id="email" value="{{old('email')}}" class="form-control  @error('email') is-invalid @enderror" placeholder="Enter Email"/>
                @error('email')
                    <p class="invalid-feedback">{{$message}}</p>
                @enderror 
            </div>

            <div class="input-box">
                <label>Father Name</label>
                <input type="text" name="fathernName" id="fathernName" value="{{old('fathernName')}}" class="form-control  @error('fathernName') is-invalid @enderror" placeholder="Enter Father Name"/>
                @error('fathername')
                    <p class="invalid-feedback">{{$message}}</p>
                @enderror
            </div>

            <div class="input-box">
                <label>Mother Name</label>
                <input type="text" name="motherName" id="motherName" value="{{old('motherName')}}" class="form-control  @error('motherName') is-invalid @enderror" placeholder="Enter Mother Name"/>
                @error('mothername')
                    <p class="invalid-feedback">{{$message}}</p>
                @enderror
            </div>

            <div class="column">

                <div class="column">
                    <div class="select-box">
                        <select name="gender" id="gender">
                            <option hidden>Gender</option>
                            <option value="feminine">Female</option>
                            <option value="male">Male</option>
                        </select>
                    </div>
                </div>



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
                            <option hidden>Class</option>
                        </select>
                    </div>
                </div>
                @error('class')
                    <p class="invalid-feedback">{{$message}}</p>
                @enderror




                <div class="column">
                    <div class="select-box">
                        <select name="division" id="division">
                            <option hidden>division</option>
                        </select>
                    </div>
                </div>
                @error('class')
                    <p class="invalid-feedback">{{$message}}</p>
                @enderror




            </div>
            
            <button type="submit">Add</button>
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

            //#division
            $('#class').change(function(){
                var class_id = $(this).val();

                console.log(class_id);


                $.ajax({
                    url : '{{ url("secretary/fetchDivision/")}}/'+ class_id,
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
<script></script>
@endsection

