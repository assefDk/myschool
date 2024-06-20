<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Subject</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    {{-- لاستقبال ال api --}}
    <meta name="_token" content="{{ csrf_token() }}">

     {{-- css --}}
     <link rel="stylesheet" href="{{ asset('./styles/style.css') }}">
</head>
<br>
<body>

    {{-- <div>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>    
        @endif
    </div> --}}



    @if (Session::has('error'))
        <div class="alert alert-danger">{{Session::get('error')}}</div>
    @endif



    <section class="container"> 
        <header>Add Subject</header>
            <form action="{{Route('secretary.processAddSubject')}}" method="POST" class="form">
                @csrf



                {{-- new --}}
                <div class="column">
                    <div class="input-box">
                        <label>Subject Name</label>
                        <input type="text" name="sub_name" id="sub_name" value="{{old('sub_name')}}" class="form-control  @error('sub_name') is-invalid @enderror" placeholder="Enter Subject Name" />
                    </div>
                    @error('sub_name')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                </div>
    
                {{-- new --}}
                <div class="column">
                    <div class="input-box">
                        <label>max</label>
                        <input type="number" name="max" id="max" value="{{old('max')}}" class="form-control  @error('max') is-invalid @enderror" />
                    </div>
                    @error('max')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror

                    <div class="input-box">
                        <label>min</label>
                        <input type="number" name="min" id="min" value="{{old('min')}}" class="form-control  @error('min') is-invalid @enderror" />
                    </div>
                    @error('min')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                </div>

                {{-- new --}}
                <div class="column">
                    <div class="input-box">
                        <label>Max Mid</label>
                        <input type="text" name="max_mid" id="max_mid" value="{{old('max_mid')}}" class="form-control  @error('mid') is-invalid @enderror" />
                    </div>
                    @error('mid')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror

                    <div class="input-box">
                        <label>Max In Class</label>
                        <input type="text" name="max_in_class" id="max_in_class" value="{{old('max_in_class')}}" class="form-control  @error('max_in_class') is-invalid @enderror" />
                    </div>
                    @error('max_in_class')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                </div>

                {{-- new --}}
                <div class="column">
                    <div class="input-box">
                        <label>Max Homework</label>
                        <input type="text" name="max_homework" id="max_homework" value="{{old('max_homework')}}" class="form-control  @error('max_homework') is-invalid @enderror"/>
                    </div>
                    @error('max_homework')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror

                    <div class="input-box">
                        <label>Max Final</label>
                        <input type="text" name="max_final" id="max_final" value="{{old('max_final')}}" class="form-control  @error('max_final') is-invalid @enderror" />
                    </div>
                    @error('max_final')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                </div>


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
                                <option> Class</option>
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

        });


    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>

