<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    {{-- <link rel="stylesheet" href="style.css"> --}}
    <title>Login</title>
</head>
    <style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins',sans-serif;
    }
    body{
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: #dfdfdf;
    }
    .login-box{
        display: flex;
        justify-content: center;
        flex-direction: column;
        width: 440px;
        height: 480px;
        padding: 30px;
    }
    .login-header{
        text-align: center;
        margin: 20px 0 40px 0;
    }
    .login-header header{
        color: #333;
        font-size: 30px;
        font-weight: 600;
    }
    .input-box .input-field{
        width: 100%;
        height: 60px;
        font-size: 17px;
        padding: 0 25px;
        margin-bottom: 15px;
        border-radius: 30px;
        border: none;
        box-shadow: 0px 5px 10px 1px rgba(0,0,0, 0.05);
        outline: none;
        transition: .3s;
    }
    ::placeholder{
        font-weight: 500;
        color: #222;
    }
    .input-field:focus{
        width: 105%;
    }
    a{
        text-decoration: none;
    }
    a:hover{
        text-decoration: underline;
    }
    section a{
        color: #555;
    }
    .input-submit{
        position: relative;
    }
    .submit-btn{
        width: 100%;
        height: 60px;
        background: #638ECb;
        border: none;
        border-radius: 30px;
        cursor: pointer;
        transition: .3s;
    }
    .input-submit label{
        position: absolute;
        top: 45%;
        left: 50%;
        color: #fff;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        cursor: pointer;
    }
    .submit-btn:hover{
        /* background: #000; */
        background: #395886;
        transform: scale(1.05,1);
    }

    </style>
<body>


    <div style="position: relative;">

        {{-- <div style="position: absolute; top: 0; right: 1px; align-items: center"> --}}
        <div style="align-items: center; display: flex; justify-content: center">
            @if (Session::has('error'))
                <div class="alert alert-danger">{{Session::get('error')}}</div>
            @endif
        </div>


        <br>
        <div style="">

            <form action="{{Route('authenticate')}}" method="POST">
                @csrf
                <div class="login-box">
                    <div class="login-header">
                        <header>Login</header>
                    </div>
                    <div class="input-box">
                        <input type="text" value="{{old('username')}}" class="input-field  @error('username') is-invalid @enderror" name="username" id="username" placeholder="username" autocomplete="off" required>
                        @error('password')
                            <p class="invalid-feedback">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="input-box">
                        <input type="password" class="input-field @error('password') is-invalid @enderror" name="password" id="password" value="" placeholder="Password">
                        @error('password')
                            <p class="invalid-feedback">{{$message}}</p>
                        @enderror
                    </div>
                    <br>
                    <br>
                    <br>
                    <div class="input-submit">
                        <button class="submit-btn" id="submit"></button>
                        <label for="submit">Login</label>
                    </div>
                </div>
            </form>
        </div>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>