<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title> @yield('titleSecretary') </title>
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
      <a href="{{Route('secretary.addStudent')}}"><span class="material-symbols-outlined"> dashboard </span> Add Student</a>
    </li>



      <h4>
      <div class="menu-separator"></div>
      </h4>
      <li>
        <a href="{{Route('secretary.addSubject')}}"><span class="material-symbols-outlined"> folder </span>Add Subject</a>
      </li>


      <li>
        <a href="{{Route('secretary.SelectClass')}}"><span class="material-symbols-outlined"> groups </span>Show All Subject</a>
      </li>



      <li>
        <a href="{{Route('secretary.ShowConnectingTeacherWithSubject')}}"><span class="material-symbols-outlined"> groups </span>Connecting the teacher with the Subject</a>
      </li>

      <li>
        <a href="{{Route('secretary.ShowSeperatingSubject')}}"><span class="material-symbols-outlined"> groups </span>Seperating the subject</a>
      </li>


      
      

      <h4>
        <div class="menu-separator"></div>
      </h4>
      <li>
        <a href="{{Route('secretary.Profile')}}"  id="profile-page"><span class="material-symbols-outlined"> account_circle </span>Profile</a>
      </li>

      <li>
        <a href="{{Route('secretary.showAnnouncment')}}"><span class="material-symbols-outlined"> settings </span>Show Announcement</a>
      </li>

      <li>

        <a href='{{route('secretary.logout')}}'>
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
                Secretary
            </span>
        </div>
      </div>
    </div>
  </aside>




  @yield('contentSecretary')




</body>
</html>


