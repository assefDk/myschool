@extends('components.layout')



@section('title','Add Announcement')



<style>
    body {
    height: 100vh;
    background: linear-gradient(
        135deg,
        #052659,
        #006aff
    );
    }
    *,
    *:before,
    *:after {
        font-weight: 500px;
    }
</style>





{{--     
    <a type="button" class="btn btn-primary" href="dashbosrd">backe</a> --}}
    @if (Session::has('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger">{{Session::get('error')}}</div>
    @endif
    


    @section('content')


    <div class="announcment-container">
        <h1>Add Announcment</h1>
        <p>Publish an announcment to a certain profission or to all profissions</p>
        <form action="{{Route('admin.processAnnouncment')}}" method="POST">
            @csrf
            <div class="row">
                <div class="column">
                    <div class="checkbox-container">
                        <div class="label-checkbox"><label for="all">All</label><input type="checkbox" type="checkbox" name="all" id="all" onchange="checkAll(this)"></div>
                        <div class="label-checkbox"><label for="">Students</label><input type="checkbox" name="students" id="students"></div>
                        <div class="label-checkbox"><label for="secretary">Secretary</label><input type="checkbox" name="secretary" id="secretary"></div>
                        <div class="label-checkbox"><label for="mentor">Mentors</label><input type="checkbox" name="mentors" id="mentors"></div>
                        <div class="label-checkbox"><label for="teatcher">Teatchers</label><input type="checkbox" name="teachers" id="teachers"></div>
                        <div class="label-checkbox"><label for="teatcher">End Date</label><input type="date" name="date" id="date"></div>
                    </div>
                </div>      
            </div>       
            <div class="row">
                <div class="column">
                    <label for="caption">Caption</label>
                    <input type="text" name="title" id="title" placeholder="The caption here">
                </div>      
            </div>

            <div class="row">
                <div class="column">
                    <label for="content">Announcment's content </label>
                    <textarea id="content" name="content" placeholder="Write the announcment's content here " rows="3"></textarea>
                </div>
            </div>
            <button>Publish</button>
            
        </form>
    </div>



    
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




