<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>admin Search Emp</title>
      <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
   </head>
   <style>
    .container {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 22px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        }

        /* Hide the browser's default checkbox */
        .container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        /* Create a custom checkbox */
        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 25px;
            width: 25px;
            background-color: #eee;
        }

        /* On mouse-over, add a grey background color */
        .container:hover input ~ .checkmark {
            background-color: #ccc;
        }

        /* When the checkbox is checked, add a blue background */
        .container input:checked ~ .checkmark {
            background-color: #2196F3;
        }

        /* Create the checkmark/indicator (hidden when not checked) */
        .checkmark:after {
        content: "";
        position: absolute;
        display: none;
        }

        /* Show the checkmark when checked */
        .container input:checked ~ .checkmark:after {
            display: block;
        }

        /* Style the checkmark/indicator */
        .container .checkmark:after {
            left: 9px;
            top: 5px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }


   </style>
   <body style="background: #596275">
    

    <div>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>    
        @endif
    </div>

    
    {{-- <h1 class="text-center">Add Announcment</h1> --}}
    <a href="{{route('admin.dashboard')}}" class="btn btn-primary">bake</a>
    @if (Session::has('error'))
        <div class="alert alert-danger">{{Session::get('error')}}</div>
    @endif
    

   
    <br>
    <br>
    <br>
    <br>
    


    

    

    <form action="{{route('admin.processsearch')}}" method="POST">
        @csrf


        <label class="container">All
            <input type="checkbox" name="all" id="all" onchange="checkAll(this)" checked>
            <span class="checkmark"></span>
        </label>
        
        <label class="container">Teachers
            <input type="checkbox" name="teachers" id="teachers" checked>
            <span class="checkmark"></span>
        </label>
        
        <label class="container">Mentors
            <input type="checkbox" name="mentors" id="mentors" checked>
            <span class="checkmark"></span>
        </label>
        
        <label class="container">secretary
            <input type="checkbox" name="secretary" id="secretary" checked>
            <span class="checkmark"></span>
        </label>





        <div style="display: flex; justify-content: center;">

            <div class="input-group mb-3 w-50 ">
                <button class="btn btn-outline-success" type="submit">Search</button>
                <input type="text" name="name" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
            </div>

        </div>






    </form>











    <div class="table-responsive">
            <table class="table">
            <thead>
                <tr>
                <th scope="col">firstname</th>
                <th scope="col">lastname</th>
                <th scope="col">username</th>
                <th scope="col">phone</th>
                <th scope="col">address</th>
                <th scope="col">email</th>
                <th scope="col">birthdate</th>
                <th scope="col">fathername</th>
                <th scope="col">mothername</th>
                <th scope="col">gender</th>
                <th scope="col"></th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @if (isset($Secretarys))
                <tr>
                    @foreach ($Secretarys as $s)
                    <tr>
                        <th scope="row">  {{$s->firstname}}</th>
                        <td scope="row">   {{$s->lastname}} </td>
                        <td scope="row">   {{$s->username}} </td>
                        <td scope="row">   {{$s->phone}} </td>
                        <td scope="row">   {{$s->address}} </td>
                        <td scope="row">   {{$s->email}} </td>
                        <td scope="row">   {{$s->birthdate}} </td>
                        <td scope="row">   {{$s->fathername}} </td>
                        <td scope="row">   {{$s->mothername}} </td>
                        <td scope="row">   {{$s->gender}} </td>
                        <td scope="row"> <a href="{{route('admin.editsecretary',$s->secretaryid)}}" class="btn btn-success">Edit</a></td>

                        <td scope="row">
                        <form action="{{route('admin.destroysecretary',$s->secretaryid)}}" method="post">
                            @csrf
                            @method('delete')
                            <input class="btn btn-danger" type="submit" value="Delete" >
                        </form> 
                        </td>

                    </tr>
                    @endforeach
                </tr>
                @endif



                @if (isset($Mentors))
                    <tr>
                        @foreach ($Mentors as $u)
                        <tr>
                            <th scope="row">  {{$u->firstname}}</th>
                            <td scope="row">   {{$u->lastname}} </td>
                            <td scope="row">   {{$u->username}} </td>
                            <td scope="row">   {{$u->phone}} </td>
                            <td scope="row">   {{$u->address}} </td>
                            <td scope="row">   {{$u->email}} </td>
                            <td scope="row">   {{$u->birthdate}} </td>
                            <td scope="row">   {{$u->fathername}} </td>
                            <td scope="row">   {{$u->mothername}} </td>
                            <td scope="row">   {{$u->gender}} </td>
                            <td scope="row"> <a href="{{route('admin.editmentor',$u->mentorid)}}" class="btn btn-success">Edit</a></td>
                            <td scope="row">
                            <form action="{{route('admin.destroymentor',$u->mentorid)}}" method="post">
                                @csrf
                                @method('delete')
                                <input class="btn btn-danger" type="submit" value="Delete" >
                            </form> 
                            </td>
                        </tr>    
                        @endforeach
                    </tr>
                @endif




                @if (isset($Teachers))
                    
                    <tr>
                        @foreach ($Teachers as $u)
                        <tr>
                            <th scope="row">  {{$u->firstname}}</th>
                            <td scope="row">   {{$u->lastname}} </td>
                            <td scope="row">   {{$u->username}} </td>
                            <td scope="row">   {{$u->phone}} </td>
                            <td scope="row">   {{$u->address}} </td>
                            <td scope="row">   {{$u->email}} </td>
                            <td scope="row">   {{$u->birthdate}} </td>
                            <td scope="row">   {{$u->fathername}} </td>
                            <td scope="row">   {{$u->mothername}} </td>
                            <td scope="row">   {{$u->gender}} </td>
                            <td scope="row"> <a href="{{route('admin.editteacher',$u->idT)}}" class="btn btn-success">Edit</a></td>
                            <td scope="row">
                                <form action="{{route('admin.destroyteacher',$u->idT)}}" method="post">
                                    @csrf
                                    @method('delete')
                            
                                    <input class="btn btn-danger" type="submit" value="Delete" >
                                </form> 
                            </td>
                        </tr>    
                        @endforeach
                    </tr>
                @endif









                


                @if (isset($rec)) 
                @if (array_key_exists(0, $rec->toArray()))
                    @foreach ($rec as $u)
                        <tr>
                            <th scope="row">{{ $u->firstname }}</th>
                            <td scope="row">{{ $u->lastname }}</td>
                            <td scope="row">{{ $u->username }}</td>
                            <td scope="row">{{ $u->phone }}</td>
                            <td scope="row">{{ $u->address }}</td>
                            <td scope="row">{{ $u->email }}</td>
                            <td scope="row">{{ $u->birthdate }}</td>
                            <td scope="row">{{ $u->fathername }}</td>
                            <td scope="row">{{ $u->mothername }}</td>
                            <td scope="row">{{ $u->gender }}</td>
                            <td scope="row">
                                <a href="{{ route('admin.editteacher', $u->secretaryid) }}" class="btn btn-success">Edit</a>
                            </td>
                            <td scope="row">
                                <form action="{{ route('admin.destroyteacher', $u->secretaryid) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input class="btn btn-danger" type="submit" value="Delete">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            @endif
            




            @if (isset($reco))
            @if (array_key_exists(0, $reco->toArray()))

                <tr>
                    @foreach ($reco as $u)
                    <tr>
                        <th scope="row">  {{$u->firstname}}</th>
                        <td scope="row">   {{$u->lastname}} </td>
                        <td scope="row">   {{$u->username}} </td>
                        <td scope="row">   {{$u->phone}} </td>
                        <td scope="row">   {{$u->address}} </td>
                        <td scope="row">   {{$u->email}} </td>
                        <td scope="row">   {{$u->birthdate}} </td>
                        <td scope="row">   {{$u->fathername}} </td>
                        <td scope="row">   {{$u->mothername}} </td>
                        <td scope="row">   {{$u->gender}} </td>
                        <td scope="row"> <a href="{{route('admin.editteacher',$u->mentorid)}}" class="btn btn-success">Edit</a></td>
                        <td scope="row">
                            <form action="{{route('admin.destroyteacher',$u->mentorid)}}" method="post">
                                @csrf
                                @method('delete')
                        
                                <input class="btn btn-danger" type="submit" value="Delete" >
                            </form> 
                        </td> 
                    </tr>    
                    @endforeach
                </tr> 
            @endif
            @endif







            @if (isset($recor))
            @if (array_key_exists(0, $recor->toArray()))
                <tr>
                    @foreach ($recor as $u)
                    <tr>
                        <th scope="row">  {{$u->firstname}}</th>
                        <td scope="row">   {{$u->lastname}} </td>
                        <td scope="row">   {{$u->username}} </td>
                        <td scope="row">   {{$u->phone}} </td>
                        <td scope="row">   {{$u->address}} </td>
                        <td scope="row">   {{$u->email}} </td>
                        <td scope="row">   {{$u->birthdate}} </td>
                        <td scope="row">   {{$u->fathername}} </td>
                        <td scope="row">   {{$u->mothername}} </td>
                        <td scope="row">   {{$u->gender}} </td>
                        <td scope="row"> <a href="{{route('admin.editteacher',$u->idT)}}" class="btn btn-success">Edit</a></td>
                        <td scope="row">
                            <form action="{{route('admin.destroyteacher',$u->idT)}}" method="post">
                                @csrf
                                @method('delete')
                        
                                <input class="btn btn-danger" type="submit" value="Delete" >
                            </form> 
                        </td> 
                    </tr>    
                    @endforeach
                </tr> 
            @endif
            @endif
















            </tbody>
            </table>
        </div>
















    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <script>

        var checkboxes = document.querySelectorAll("input[type='checkbox']");

        function checkAll(mycheckbox) {
            if (mycheckbox.checked) {
                checkboxes.forEach(function (checkbox) {
                    checkbox.checked = true;
                });
            } else {
                checkboxes.forEach(function (checkbox) {
                    checkbox.checked = false;
                });
            }
        }



    </script>   

</html> 




