@extends('components.layout_mentor')



@section('titlementor','dachbord')


@section('contentmentor')

@if (Session::has('error'))
    <div style="display: flex; align-items: center; justify-content: center; color: red ">
        <div class="alert alert-danger">{{Session::get('error')}}</div>
    </div>
    @endif
    @if (Session::has('success'))
    <div style="display: flex; align-items: center; justify-content: center; color: green ">
        <div class="alert alert-success">{{Session::get('success')}}</div>
    </div>
    @endif
        {{-- @if (Session::has('success'))
            <div class="alert alert-success">{{Session::get('success')}}</div>
        @endif --}}

{{-- 
        <div class="d-flex justify-content-center ml-3">
            <a class="btn bsb-btn-xl btn-primary py-3 " href="{{Route('mentor.showAddNote')}}"> add note</a>
        </div>
        <br>
        <br>

        <div class="d-flex justify-content-center ml-3">
            <a class="btn bsb-btn-xl btn-primary py-3 " href="{{Route('mentor.addWeeklySchedule')}}"> add Weekly Schedule</a>
        </div>





        <br>
        <br>
        <br>
        <br>
        <br>



        <div class="d-flex justify-content-center ml-3">
            <a class="btn bsb-btn-xl btn-primary py-3 " href="{{Route('mentor.addAnnouncment')}}"> add Announcment</a>
        </div>


        <br>
        <br>
        <br>

        <div class="d-flex justify-content-center ml-3">
            <a class="btn bsb-btn-xl btn-primary py-3 " href="{{Route('mentor.showAnnouncment')}}"> Shoe Announcment</a>
        </div>


        <br>
        <br>
        <br>


        <div class="d-flex justify-content-center ml-3">
            <a class="btn bsb-btn-xl btn-primary py-3 " href="{{Route('mentor.showMarks')}}"> show marks</a>
        </div> --}}



@endsection



       