<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Laravel 11 Multi Auth::Admin</title>
      <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
   </head>
   <body class="bg-light">
    

    <div>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>    
        @endif
    </div>

    
        <nav class="navbar navbar-expand-md bg-white shadow-lg bsb-navbar bsb-navbar-hover bsb-navbar-caret">
            <div class="container">
                <a class="navbar-brand" href="#">
                   <strong>Page Admin System</strong>
                </a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                </svg>
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1">
                        
                        <li class="nav-item dropdown">
                            @auth
                                {{-- <a class="nav-link dropdown-toggle" href="#!" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Hello, {{Auth::guard('secretary')->user()->username}} </a> --}}
                                <a class="nav-link dropdown-toggle" href="#!" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Hello, {{ Auth::user()->username }} </a>
                            @endauth
                            <ul class="dropdown-menu border-0 shadow bsb-zoomIn" aria-labelledby="accountDropdown">                          
                                <li>
                                    <a class="dropdown-item" href="{{route('admin.logout')}}">Logout</a>
                                    {{-- <a class="dropdown-item" href="">Logout</a> --}}
                                    {{-- <a class="dropdown-item" href="#!">Logout</a> --}}
                                </li>
                            </ul>
                        </li>
                        
                    </ul>
                </div>
                </div>
            </div>
        </nav>
        <div class="container">
           <div class="card border-0 shadow my-5">
                <div class="card-header bg-light">
                    <h3 class="h5 pt-2">Dashboard</h3>
                </div>
                <div class="card-body">
                    You are logged in !!
                </div>
           </div>
        </div>

            {{-- <h1>{{Auth::guard('secretary')->Secretary()->username}}</h1> --}}
            {{-- <a class="nav-link dropdown-toggle" href="#!" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Hello, {{Auth::guard('secretary')->Secretary()->username}}</a> --}}



            <br>
            <br>
                @if (Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger">{{Session::get('error')}}</div>
                @endif
    

                <div class="d-flex justify-content-center ml-3">
                    {{-- <a class="btn bsb-btn-xl btn-primary py-3 " href=""> add secretary</a> --}}
                    <a class="btn bsb-btn-xl btn-primary py-3 " href="{{Route('admin.addsecretary')}}"> add secretary</a>
                    {{-- كود المسافة في html --}}
                    &#160
                    &#160
                    &#160
                    &#160
                    &#160
                    &#160
                    <a class="btn bsb-btn-xl btn-primary py-3 " href="{{Route('admin.showallsecretary')}}"> show all secretary</a>
                </div>

                <br>

                <div class="d-flex justify-content-center ">
                    {{-- <a class="btn bsb-btn-xl btn-primary py-3 " href=""> add-teacher</a> --}}
                    <a class="btn bsb-btn-xl btn-primary py-3 " href="{{Route('admin.addteacher')}}"> add-teacher</a>
                    {{-- كود المسافة في html --}}
                    &#160
                    &#160
                    &#160
                    &#160
                    &#160
                    &#160
                    <a class="btn bsb-btn-xl btn-primary py-3 " href="{{Route('admin.showallteacher')}}"> show all teacher</a>
                </div>

                <br>

            
                <div class="d-flex justify-content-center">
                    <a class="btn bsb-btn-xl btn-primary py-3 " href="{{Route('admin.addmentor')}}"> add-mentor</a>
                    {{-- كود المسافة في html --}}
                    &#160
                    &#160
                    &#160
                    &#160
                    &#160
                    &#160
                    <a class="btn bsb-btn-xl btn-primary py-3 " href="{{Route('admin.showallmentor')}}"> show all mentor</a>
                    {{-- <a class="btn bsb-btn-xl btn-primary py-3 " href=""> add-mentor</a> --}}
                </div>


                
                <br>


                <div class="d-flex justify-content-center">
                    <a class="btn bsb-btn-xl btn-primary py-3 " href="{{Route('admin.add-class')}}"> add class</a>
                    {{-- كود المسافة في html --}}
                    &#160
                    &#160
                    &#160
                    &#160
                    &#160
                    &#160
                    <a class="btn bsb-btn-xl btn-primary py-3 " href="{{Route('admin.showallclass')}}"> show all class</a>

                </div>



                <br>

                <div class="d-flex justify-content-center">
                    <a class="btn bsb-btn-xl btn-primary py-3 " href="{{Route('admin.addAnnouncment')}}"> add announcment</a>
                </div>



            
                {{-- <h1>bvds</h1> --}}
                
        </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</html>