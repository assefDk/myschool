

@extends('components.layout')

@section('title','dachbord')




    <div>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>    
        @endif
    </div>




    @section('content')
    
    @endsection






            {{-- <br>
            <br>
                @if (Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger">{{Session::get('error')}}</div>
                @endif
{{--      --}}

                {{-- <div class="d-flex justify-content-center ml-3"> --}}
                    {{-- <a class="btn bsb-btn-xl btn-primary py-3 " href=""> add secretary</a> --}}
                    {{-- <a class="btn bsb-btn-xl btn-primary py-3 " href="{{Route('admin.addsecretary')}}"> add secretary</a>
                    {{-- كود المسافة في html --}}
             
                    {{-- <a class="btn bsb-btn-xl btn-primary py-3 " href="{{Route('admin.showallsecretary')}}"> show all secretary</a>
                </div>

                <br> --}} 

                {{-- <div class="d-flex justify-content-center ">
                    {{-- <a class="btn bsb-btn-xl btn-primary py-3 " href=""> add-teacher</a> --}}
                    {{-- <a class="btn bsb-btn-xl btn-primary py-3 " href="{{Route('admin.addteacher')}}"> add-teacher</a>
                    {{-- كود المسافة في html --}}
                    {{-- &#160
                    &#160
                    &#160
                    &#160
                    &#160
                    &#160
                    <a class="btn bsb-btn-xl btn-primary py-3 " href="{{Route('admin.showallteacher')}}"> show all teacher</a>
                </div> --}}

                {{-- <br> --}} 

            
                {{-- <div class="d-flex justify-content-center">
                    <a class="btn bsb-btn-xl btn-primary py-3 " href="{{Route('admin.addmentor')}}"> add-mentor</a>
                    {{-- كود المسافة في html --}}
         
                    {{-- <a class="btn bsb-btn-xl btn-primary py-3 " href="{{Route('admin.showallmentor')}}"> show all mentor</a>
                    {{-- <a class="btn bsb-btn-xl btn-primary py-3 " href=""> add-mentor</a> --}}
                {{-- </div> --}} 

                
                {{-- <br> --}}


                {{-- <div class="d-flex justify-content-center">
                    <a class="btn bsb-btn-xl btn-primary py-3 " href="{{Route('admin.add-class')}}"> add class</a>
                    {{-- كود المسافة في html --}}
                 
                    {{-- <a class="btn bsb-btn-xl btn-primary py-3 " href="{{Route('admin.showallclass')}}"> show all class</a>

                </div> --}}

                {{-- <br> --}}
{{-- 
                <div class="d-flex justify-content-center">
                    <a class="btn bsb-btn-xl btn-primary py-3 " href="{{Route('admin.searchEmp')}}">search All Emp</a>
                </div>
 --}}







                {{-- <br>
                <br>

                <div class="d-flex justify-content-center">
                    <a class="btn bsb-btn-xl btn-primary py-3 " href="{{Route('admin.nav')}}">test NAV</a>
                </div>



                @endsection
 --}}









            
                {{-- <h1>bvds</h1> --}}
                
        {{-- </body> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> --}}
{{-- </html> --}}