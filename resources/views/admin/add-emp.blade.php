    
@extends('components.layout')
@section('title','Add Secretary')

@section('content')



    
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

        
        



        @section('content')

















        
    <link rel="stylesheet" href="{{ asset('./styles/style.css') }}">
<section class="container"> 
    <header>Add employers</header>
        <form action="{{Route('admin.processaddEmp')}}" method="POST" class="form">
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
                <input type="text" placeholder="Enter First Name" name="firstname" id="firstname" value="{{old('firstname')}}" class="form-control @error('firstname') is-invalid @enderror"/>
                @error('firstname')
                    <p class="invalid-feedback">{{$message}}</p>
                @enderror
            </div>

            <div class="input-box">
                <label>Last Name</label>
                <input type="text" placeholder="Enter Last Name" name="lastname" id="lastname" value="{{old('lastname')}}" class="form-control  @error('lastname') is-invalid @enderror"/>
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
                <input type="text" name="address" id="address" value="{{old('address')}}" class="form-control  @error('address') is-invalid @enderror" placeholder="Enter Address"/>
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
                <input type="text" name="fathername" id="fathername" value="{{old('fathername')}}" class="form-control  @error('fathername') is-invalid @enderror" placeholder="Enter Father Name"/>
                @error('fathername')
                    <p class="invalid-feedback">{{$message}}</p>
                @enderror
            </div>

            <div class="input-box">
                <label>Mother Name</label>
                <input type="text" name="mothername" id="mothername" value="{{old('mothername')}}" class="form-control  @error('mothername') is-invalid @enderror" placeholder="Enter Mother Name"/>
                @error('mothername')
                    <p class="invalid-feedback">{{$message}}</p>
                @enderror
            </div>

            <div class="column">
                <div class="column">
                    <div class="select-box">
                    <select name="gender" id="gender">
                        <option hidden>Gender</option>
                        <option value="female">Female</option>
                        <option value="male">Male</option>
                    </select>
                    </div>
                </div>
                @error('gender')
                    <p class="invalid-feedback">{{$message}}</p>
                @enderror 
            </div>
            

                    <label for="">mentor</label>
                    <input type="checkbox" class='form-control-checkbox' name="mentor">
                    <label for="">secrutary</label>
                    <input type="checkbox" class='form-control-checkbox' name="secrutary">
                    <label for="">techer</label>
                    <input type="checkbox" class='form-control-checkbox' name="techer">
            <button type="submit">Add</button>
        </form> 
</section>





<script>
    formcControlCheckbox = [...document.querySelectorAll('.form-control-checkbox')];
    formcControlCheckbox.forEach((onebyone) => {
        onebyone.addEventListener('click', function() {
            formcControlCheckbox.forEach((onebyone) => {
                onebyone.checked = false;
            })

            onebyone.checked = true;
        })
    })

</script>


    @endsection


