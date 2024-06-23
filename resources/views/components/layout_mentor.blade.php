 <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title> @yield('titlementor') </title>
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="{{ asset('./styles/StyleNour.css') }}" />
</head>
<body> 
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
      <a href="{{Route('mentor.showAddNote')}}"><span class="material-symbols-outlined"> dashboard </span> Add note</a>
    </li>





    <li>
      <a href="{{Route('mentor.addWeeklySchedule')}}"><span class="material-symbols-outlined"> overview </span>Add Weekly Schedule</a>
    </li>




      <h4>
      <div class="menu-separator"></div>
      </h4>
      <li>
      <a href="{{Route('mentor.showAnnouncment')}}"><span class="material-symbols-outlined"> folder </span>Show Announcment</a>
      </li>


      <li>
      <a href="{{Route('mentor.showMarks')}}"><span class="material-symbols-outlined"> groups </span>Show Marks</a>
      </li>


      <h4>
        <div class="menu-separator"></div>
      </h4>
      <li>
        <a href="{{Route('mentor.Profile')}}"  id="profile-page"><span class="material-symbols-outlined"> account_circle </span>Profile</a>
      </li>

      <li>
        <a href="{{Route('mentor.addAnnouncment')}}"><span class="material-symbols-outlined"> settings </span>Add Announcement</a>
      </li>

      <li>

        <a href='{{route('mentor.logout')}}'>
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
                mentor
            </span>
        </div>
      </div>
    </div>
  </aside>




  @yield('contentmentor')




</body>
</html>


