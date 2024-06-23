@extends('components.layout_teacher')



@section('titleteacher','Teacher Add mark')


@section('contentteacher')

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
<style>
    body {
    text-align: center;
    background-color: #f7f7f7;
    margin: 20px;
    padding: 0px;
    background: linear-gradient(
            135deg,
            #052659,
            #006aff
        );
  }
  h1 {
    color: #000;
  }
  
  form {
    margin: 20px auto;
    max-width: 400px;
    background-color: #fff;
    padding: 20px;
    border-radius: 12px;
    box-shadow:  4px 4px rgba(0, 0, 0, 0.5);
  }
  
  .form-group {
    margin-bottom: 20px;
  }
  
  label {
    display: block;
    margin-bottom: 5px;
    color: #000;
    font-weight: bold;
  }
  
  select,
  input[type='text']{
    width: calc(100% - 22px);
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }
  </style>


    <form action="{{Route('teacher.ProcessAddMark',$mark->id)}}" method="POST">
        @csrf
            <h1>Add Mark</h1>
            <div class="form-group">

                <label>Mid/{{$mx->max_mid}}</label>
                <input type="text" name="mid" id="mid" value="{{$mark->mid}}" class="form-control  @error('mid') is-invalid @enderror">
                @error('mid')
                    <p class="invalid-feedback">{{$message}}</p>
                @enderror
                
                <label>IN_Class/{{$mx->max_in_class}}</label>
                <input type="text" name="in_class" id="in_class" value="{{$mark->in_class}}" class="form-control  @error('in_class') is-invalid @enderror">
                @error('in_class')
                    <p class="invalid-feedback">{{$message}}</p>
                @enderror 

                <br>
                <br>
                <label>homework /{{$mx->max_homework}}</label>
                <input type="text" name="homework" id="homework" value="{{$mark->homework}}" class="form-control  @error('homework') is-invalid @enderror">
                @error('homework')
                    <p class="invalid-feedback">{{$message}}</p>
                @enderror

                <label>Homework/{{$mx->max_homework}}</label>
                <input type="text" name="homework" id="homework" value="{{$mark->homework}}" class="form-control  @error('homework') is-invalid @enderror">
                @error('homework')
                    <p class="invalid-feedback">{{$message}}</p>
                @enderror

                <label>Final/{{$mx->max_final}}</label>
                <input type="text" name="final" id="final" value="{{$mark->final}}" class="form-control  @error('final') is-invalid @enderror">
                @error('final')
                    <p class="invalid-feedback">{{$message}}</p>
                @enderror


            </div>
        <button type="submit">Add Mark</button>
    </form>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    

    @endsection();




