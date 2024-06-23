

    
@extends('components.layout')
@section('title','Add class')







    {{-- <div>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>    
        @endif
    </div> --}}




    @section('content')

    <link rel="stylesheet" href="{{ asset('./styles/style.css') }}">

    <br>
    <br>
    <br>
    <br>

    <section class="container"> 
        <header>Add Class</header>
            <form action="{{Route('admin.processClass')}}" method="POST" class="form">
                @csrf

                <div class="input-box">
                    <label>Major Name</label>
                    <input  type="text" value="General" id="majorname" name="majorname" class="form-control @error('firstname') is-invalid @enderror" />
                    @error('firstname')
                        <p class="invalid-feedback">{{$message}}</p>
                    @enderror
                </div>
    
                <br>
                <br>

                <div class="column">
                    <div class="select-box">
                        <select id="ClassName" name="ClassName">                    
                            <option value="">Name Calss</option> 
                            <option value="ClassOne">ClassOne</option> 
                            <option value="ClassTow">ClassTow</option>
                            <option value="ClassThree">ClassThree</option>
                            <option value="ClassFour">ClassFour</option>
                            <option value="Classfive">Classfive</option>
                            <option value="ClassSix">ClassSix</option>
                            <option value="ClassSeven">ClassSeven</option>
                            <option value="ClassEight">ClassEight</option>
                            <option value="ClassNine">ClassNine</option>
                            <option value="ClassTen">ClassTen</option>
                            <option value="ClassTwelfth">ClassTwelfth</option>
                            <option value="ClassThirteenth">ClassThirteenth</option> 
                        </select>
                    </div>

                    <div class="column">
                        <div class="column">
                            <div class="select-box">
                                <select id="division" name="division">
                                    <option value="" hidden>division</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>    
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                        </div>
                        @error('gender')
                            <p class="invalid-feedback">{{$message}}</p>
                        @enderror 
                    </div>
                </div>
    
                <button type="submit">Add</button>
            </form> 
    </section>
    @endsection()

