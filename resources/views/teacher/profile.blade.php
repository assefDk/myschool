





@extends('components.layout_teacher')
@section('titleteacher','profile')





@section('contentteacher')

<br>
<br>
<br>
<br>
<br>

<div class="profile-card">
    <div class="profile-header">
        <img src="{{asset('images/photo_profile.jpg')}}" alt="profile-picture">
        <h2><label>#</label></h2>
        <p><b>The Profession :</b> <label>#</label></p>
    </div>
    <div class="profile-details">
        <p>
            <b>First Name:</b><label class="marg0">{{ Auth::user()->firstname }}</label><b class="marg">Last Name:</b><label class="marg1">{{ Auth::user()->lastname }}</label>
        </p>
        <p>
            <b>Mother Name:</b><label class="marg0">{{ Auth::user()->mothername }}</label>
        </p>

        <p>
            <b>Father Name:</b><label class="marg0">{{ Auth::user()->fathername }}</label>
        </p>

        <p>
            <b>Phone:</b><label class="marg0">{{ Auth::user()->lastname }}</label><b class="marg">Age:</b><label class="marg1">{{ Auth::user()->birthdate }}</label>
        </p>
        <p>
            <b>Birthday:</b><label class="marg0">{{ Auth::user()->birthdate }}</label><b class="marg">Gender:</b><label class="marg1">{{ Auth::user()->gender }}</label>
        </p>
        <p>
            <b>Address:</b><label>{{ Auth::user()->address }}</label>
        </p>
        
    </div>
</div>
@endsection