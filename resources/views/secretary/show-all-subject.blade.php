@extends('components.layout_secretary')



@section('titleSecretary','dachbord')


@section('contentSecretary')
    <h1>show all subject</h1>


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
<br>


    <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">id</th>
              <th scope="col">name</th>
              <th scope="col">max</th>
              <th scope="col">min</th>
              <th scope="col">ClassId</th>
              <th scope="col">major</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              @foreach ($subjects as $s)
              <tr>
                  <th scope="row">   {{$s->idS}}</th>
                  <th scope="row">   {{$s->sub_name}}</th>
                  <th scope="row">   {{$s->max}}</th>
                  <th scope="row">   {{$s->min}}</th>
                  <th scope="row">   {{$s->ClassId}}</th>
                  <th scope="row"> <a href="{{route('secretary.editsubject',$s->idS)}}" class="btn btn-success">Edit</a></th>

                  <th scope="row">
                    <form action="{{route('secretary.destroysubject',$s->idS)}}" method="post">
                      @csrf
                      @method('delete')
                      <input class="btn btn-danger" type="submit" value="Delete" >
                    </form> 
                  </th></tr>    
              @endforeach
          </tr>
            
          </tbody>
        </table>
      </div>
      


@endsection