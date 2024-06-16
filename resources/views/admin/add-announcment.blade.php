<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>admin Add Announcment</title>
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

    
    <h1 class="text-center">Add Announcment</h1>
    <a type="button" class="btn btn-primary" href="dashbosrd">backe</a>
    @if (Session::has('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger">{{Session::get('error')}}</div>
    @endif
    

   
    <br>
    <br>
    <br>
    <br>

    

    

    <form action="{{Route('admin.processAnnouncment')}}" method="POST">
        @csrf
        <div style="display: flex; justify-content: center;">
            <h4> title Announcment</h4>
        </div>

        <div style="display: flex; justify-content: center;">
            <input class="form-control form-control-lg w-25" type="text" name="title" id="title">
        </div>

        <br>

        <div style="display: flex; justify-content: center;">
            <h4> Content Announcment</h4>
        </div>
        <div style="display: flex; justify-content: center;">
            <br>
            <div class="form-outline w-50 mb-4" style="display: block">
                <textarea class="form-control" id="content" name="content" rows="9" ></textarea>
            </div>
            <br>
        </div>



        <label class="container">All
            <input type="checkbox" name="all" id="all" onchange="checkAll(this)">
            <span class="checkmark"></span>
        </label>

        <label class="container">Students
            <input type="checkbox" name="students" id="students">
            <span class="checkmark"></span>
        </label>
        
        <label class="container">Teachers
            <input type="checkbox" name="teachers" id="teachers">
            <span class="checkmark"></span>
        </label>
        
        <label class="container">Mentors
            <input type="checkbox" name="mentors" id="mentors">
            <span class="checkmark"></span>
        </label>
        
        <label class="container">secretary
            <input type="checkbox" name="secretary" id="secretary" >
            <span class="checkmark"></span>
        </label>

        <div style="display: flex; justify-content: center; align-items: center">

            <label>end date</label>
            <input type="date" name="date" id="date">
        </div>


        <div style="display: flex; justify-content: center;">
            <button type="submit" class="btn bsb-btn-xl btn-success py-3 "> add announcment</button>
        </div>


    </form>

                
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




