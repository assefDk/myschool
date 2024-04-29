<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add teacher</title>
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





    <h1>add teacher</h1>
    
    <form action="{{Route('admin.processaddteacher')}}" method="POST">
        @csrf
        <label>first_name</label>
        <input type="text" name="firstname" id="firstname" value="{{old('firstname')}}" class="form-control  @error('firstname') is-invalid @enderror">

        @error('firstname')
            <p class="invalid-feedback">{{$message}}</p>
        @enderror



        <br>
        <br>
        <label>last_name</label>
        <input type="text" name="lastname" id="lastname" value="{{old('lastname')}}" class="form-control  @error('lastname') is-invalid @enderror">

        @error('lastname')
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
        <label>address</label>
        <input type="text" name="address" id="address" value="{{old('address')}}" class="form-control  @error('address') is-invalid @enderror">

        @error('address')
            <p class="invalid-feedback">{{$message}}</p>
        @enderror

        {{-- $2y$12$Ah.vMXTMWN6HEXMRSEy8VOXJ8ZN.l6dJMThaYrWf5Vb... --}}

        <br>
        <br>
        <label>e-mail</label>
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
        <label>fathername</label>
        <input type="text" name="fathername" id="fathername" value="{{old('fathername')}}" class="form-control  @error('fathername') is-invalid @enderror">

        @error('fathername')
            <p class="invalid-feedback">{{$message}}</p>
        @enderror

        <br>
        <br>
        <label>mothername</label>
        <input type="text" name="mothername" id="mothername" value="{{old('mothername')}}" class="form-control  @error('mothername') is-invalid @enderror">

        @error('mothername')
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

        <button class="btn bsb-btn-xl btn-primary py-3" type="submit">add teacher</button>

    </form>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>