@extends('components.layout')
@section('title','Employers Managment')



@section('content')

<title>employers managment</title>
</head>
<link rel="stylesheet" href="{{ asset('./styleNour/style.css') }}" />
<body>



    <form action="{{route('admin.processsearch')}}" method="POST">
        @csrf

        <div class="topnav">
            <div class="checks">
                <input type="checkbox" id="alli">   
                <label for="alli">All</label>
            </div>
            <div class="checks">
                <input type="checkbox" name="all" id="all" onchange="checkAll(this)" checked>
                <label for="alli">All</label>
            </div>
            <div class="checks">
                <input type="checkbox" name="teachers" id="teachers" checked>
                <label for="toti">Teatchers</label>
            </div>
            <div class="checks">
                <input type="checkbox" name="mentors" id="mentors" checked>
                <label for="menti">Mentors</label>
            </div>
            <div class="checks">
                <input type="checkbox" name="secretary" id="secretary" checked>
                <label for="seci">Secretary</label>
            </div>

            <input type="text" placeholder="Search.." name="name" id="name">
            
            <button type="submit">Search</button>
        </div>
    </form>


















        <div class="emp-content">
            <button ><a href="{{Route('admin.add_emp')}}" style="color: #F0F4FF; text-decoration: none">Add New Employer </a></button>
        </div>






        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>




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






@endsection