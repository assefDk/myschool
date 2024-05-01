<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add Student</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        label {
            margin-right: 20px;
        }
    </style>
</head>
<br>
<body>

    <div>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>    
        @endif
    </div>



    <h1>add Student</h1>
    
    <form action="{{Route('processAddStudent')}}" method="POST">
        @csrf
        <label>firstName</label>
        <input type="text" name="firstName" id="firstName" value="{{old('firstName')}}" class="form-control  @error('firstName') is-invalid @enderror">

        @error('firstName')
            <p class="invalid-feedback">{{$message}}</p>
        @enderror



        <br>
        <br>
        <label>lastName</label>
        <input type="text" name="lastName" id="lastName" value="{{old('lastName')}}" class="form-control  @error('lastName') is-invalid @enderror">

        @error('lastName')
            <p class="invalid-feedback">{{$message}}</p>
        @enderror

        <br>
        <br>
        <label>username</label>
        <input type="text" name="username" id="username" value="{{old('username')}}" class="form-control  @error('username') is-invalid @enderror">

        @error('username')
            <p class="invalid-feedback">{{$message}}</p>
        @enderror



        <br>
        <br>
        <label>password</label>
        <input type="password" name="password" id="password" value="{{old('password')}}" class="form-control  @error('password') is-invalid @enderror">

        @error('password')
            <p class="invalid-feedback">{{$message}}</p>
        @enderror


        <br>
        <label>phone</label>
        <input type="text" name="phone" id="phone" value="{{old('phone')}}" class="form-control  @error('phone') is-invalid @enderror">

        
        @error('phone')
           <p class="invalid-feedback">{{$message}}</p>
        @enderror



        <br>
        <br>
        <label>adress</label>
        <input type="text" name="adress" id="adress" value="{{old('adress')}}" class="form-control  @error('adress') is-invalid @enderror">

        @error('adress')
            <p class="invalid-feedback">{{$message}}</p>
        @enderror

        {{-- $2y$12$Ah.vMXTMWN6HEXMRSEy8VOXJ8ZN.l6dJMThaYrWf5Vb... --}}

        <br>
        <br>
        <label>email</label>
        <input type="email" name="email" id="email" value="{{old('email')}}" class="form-control  @error('email') is-invalid @enderror">

        @error('email')
            <p class="invalid-feedback">{{$message}}</p>
        @enderror

        <br>
        <br>
        <label>birthdate</label>
        <input type="date" name="birthdate" id="birthdate" value="{{old('birthdate')}}" class="form-control  @error('birthdate') is-invalid @enderror">

        @error('birthdate')
            <p class="invalid-feedback">{{$message}}</p>
        @enderror


        <br>
        <br>
        <label>fathernName</label>
        <input type="text" name="fathernName" id="fathernName" value="{{old('fathernName')}}" class="form-control  @error('fathernName') is-invalid @enderror">

        @error('fathernName')
            <p class="invalid-feedback">{{$message}}</p>
        @enderror

        <br>
        <br>
        <label>motherName</label>
        <input type="text" name="motherName" id="motherName" value="{{old('motherName')}}" class="form-control  @error('motherName') is-invalid @enderror">

        @error('motherName')
            <p class="invalid-feedback">{{$message}}</p>
        @enderror

        <br>
        <br>
        <label>gender</label>
        <select name="gender" id="gender">
            <option value="feminine">feminine</option>
            <option value="male">male</option>
        </select>
        @error('gender')
            <p class="invalid-feedback">{{$message}}</p>
        @enderror






        <br>
        <br>
        <label>studentStatus</label>
        <select name="studentStatus" id="studentStatus">
            <option value="successful">successful</option>
            <option value="Failed">Failed</option>
        </select>
        @error('studentStatus')
            <p class="invalid-feedback">{{$message}}</p>
        @enderror

        
        <br>
        <br>

        <button class="btn bsb-btn-xl btn-primary py-3" type="submit">add mentor</button>

    </form>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>