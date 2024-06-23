 <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title> @yield('title') </title>
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="{{ asset('./styles/StyleNour.css') }}" />
</head>
<body>
  <nav>
    <input type="checkbox" id="sidebar-active">
    <label for="sidebar-active" class="open-sidebar-button">
      <svg xmlns="http://www.w3.org/2000/svg" height="32" viewBox="0 -960 960 960" width="32"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg> 
      {{-- <img src="{{ asset('./images/itachi.jpg') }}" alt="Profile Image" /> --}}


        {{-- <img src="{{ asset('./images/menu1') }}" alt=""> --}}
    </label>
    <label id="overlay" for="sidebar-active"></label>
    <div class="links-container">
      <label for="sidebar-active" class="close-sidebar-button">
        {{-- <img src="{{ asset('./images/itachi.jpg') }}" alt="Profile Image" />  --}}

        <img src="{{ asset('./images/menu1.png') }}" alt="">
      </label>
      <a class="home-link" href="index.html">Home</a> 
      <a href="{{Route('admin.add-class')}}">Classes</a>
      <a href="{{Route('admin.addAnnouncment')}}">Announcment</a> 
      <a href="{{Route('admin.employers_managment')}}">Employers</a>
    </div>
  </nav> 
 <aside class="sidebar">
<div class="sidebar-header">
    <img src="{{ asset('./images/menu1.png') }}" alt="logo" />
    <h2>User Menu</h2>
    </div>
    <ul class="sidebar-links">
    <h4>
    <span>Main Menu</span>
    <div class="menu-separator"></div>
    </h4>
    <li>
    <a href="{{Route('admin.addteacher')}}">
        <span class="material-symbols-outlined"> dashboard </span> Add Teacher</a>
    </li>
    <li>
    <a href="{{Route('admin.addmentor')}}"><span class="material-symbols-outlined"> overview </span>Add mentor</a>
    </li>
    <li>
    <a href="{{Route('admin.addsecretary')}}"><span class="material-symbols-outlined"> monitoring </span>Add Secretary</a>
    </li>
    <h4>
    <span>General</span>
    <div class="menu-separator"></div>
    </h4>
    <li>
    <a href="{{Route('admin.add-class')}}"><span class="material-symbols-outlined"> folder </span>Add Class</a>
    </li>


    <li>
    <a href="{{Route('admin.showallteacher')}}"><span class="material-symbols-outlined"> groups </span>Show All Teacher</a>
    </li>
    <li>
    <a href="{{Route('admin.showallmentor')}}"><span class="material-symbols-outlined"> move_up </span>Show All Mentor</a>
    </li>
    <li>
        <a href="{{Route('admin.showallsecretary')}}"><span class="material-symbols-outlined">notifications_active </span>Show All Secretary</a>
    </li>


    <li>
        <a href="{{Route('admin.showallclass')}}"><span class="material-symbols-outlined"> flag </span> Show All Class</a>
    </li>

      <h4>
        <span>Account</span>
        <div class="menu-separator"></div>
      </h4>
      <li>
        <a href="{{Route('admin.Profile')}}"  id="profile-page"><span class="material-symbols-outlined"> account_circle </span>Profile</a>
      </li>

      <li>
        <a href="{{Route('admin.addAnnouncment')}}"><span class="material-symbols-outlined"> settings </span>Add Announcement</a>
      </li>

      <li>

        <a href='{{route('admin.logout')}}'>
            <span class="material-symbols-outlined"> logout </span>
            Logout
        </a>
      </li> 
   </ul>
    <div class="user-account">
      <div class="user-profile">
        <img src="{{ asset('./images/photo_profile.jpg') }}" alt="Profile Image" />
        <div class="user-detail">
            <h3>
                {{ Auth::user()->username }}
            </h3>
            <span>
                manager
            </span>
        </div>
      </div>
    </div>
  </aside>




  @yield('content')




</body>
</html>


