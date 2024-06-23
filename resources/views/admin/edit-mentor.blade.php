<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit  mentor</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
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



    <section class="container"> 
        <header>Edit Mentor</header>
        
            <form action="{{route('admin.updatementor',['id'=>$mentor->mentorid])}}" method="POST" class="form">
                @csrf
    


                <div class="column">
                    <div class="input-box">
                        <label>User Name</label>
                        <input type="text" name="username" id="username" value="{{$mentor->username}}" class="form-control  @error('username') is-invalid @enderror" placeholder="Enter User Name" />
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
                    <input type="text" placeholder="Enter First Name" name="firstname" id="firstname" value="{{$mentor->firstname}}"  class="form-control @error('firstname') is-invalid @enderror"/>
                    @error('firstname')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                </div>
        
                <div class="input-box">
                    <label>Last Name</label>
                    <input type="text" placeholder="Enter Last Name" name="lastname" id="lastname" value="{{$mentor->lastname}}" class="form-control  @error('lastname') is-invalid @enderror"/>
                    @error('lastname')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                </div>

                <div class="column">
                    <div class="input-box">
                        <label>Phone Number</label>
                        <input type="text" name="phone" id="phone" value="{{$mentor->phone}}" class="form-control  @error('phone') is-invalid @enderror" placeholder="Enter phone number"  />
                    </div>
                    @error('phone')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror 

                    <div class="input-box">
                        <label>Birth Date</label>
                        <input type="date" name="birthdate" id="birthdate" value="{{$mentor->birthdate}}" class="form-control  @error('birthdate') is-invalid @enderror" placeholder="Enter birth date" />
                    </div>
                    @error('birthdate')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror 
                </div>


                <div class="input-box">
                    <label>Address</label>
                    <input type="text" name="address" id="address" value="{{$mentor->address}}" class="form-control  @error('address') is-invalid @enderror" placeholder="Enter Address"/>
                    @error('address')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror 
                </div>

                <div class="input-box">
                    <label>Email</label>
                    <input type="email" name="email" id="email" value="{{$mentor->email}}" class="form-control  @error('email') is-invalid @enderror" placeholder="Enter Email"/>
                    @error('email')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror 
                </div>

                <div class="input-box">
                    <label>Father Name</label>
                    <input type="text" name="fathername" id="fathername" value="{{$mentor->fathername}}" class="form-control  @error('fathername') is-invalid @enderror" placeholder="Enter Father Name"/>
                    @error('fathername')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                </div>

                <div class="input-box">
                    <label>Mother Name</label>
                    <input type="text" name="mothername" id="mothername" value="{{$mentor->mothername}}" class="form-control  @error('mothername') is-invalid @enderror" placeholder="Enter Mother Name"/>
                    @error('mothername')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                </div>


                <div class="column">
                    <div class="column">
                        <div class="select-box">
                        <select name="gender" id="gender">
                            <option hidden>Gender</option>

                            @if($mentor->gender == 'male')    
                                <option value="female" >Female</option>
                                <option value="male" selected>Male</option>
                            @else
                            <option value="female" selected>female</option>
                            <option value="male" >male</option>
                            @endif

                        </select>
                        </div>
                    </div>
                    @error('gender')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror 
                </div>
                
                <button type="submit">Edit </button>
            </form> 
    </section>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>