<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>SelectClass</title>
   {{-- bootstrip css --}}
   <meta name="_token" content="{{ csrf_token() }}">
   <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <h1>SelectClass</h1>



  <div>
      @if ($errors->any())
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{$error}}</li>
              @endforeach
          </ul>    
      @endif
  </div>


<br>
    <form action="{{Route('secretary.ShowAllSubject')}}" method="post">

      @csrf   


      <label>majors</label>
      <select name="Majors" id="Majors">
          @foreach ($Majors as $m)
              <option value="{{$m->MajorId}}">{{$m->name}}</option>
          @endforeach
      </select>
      @error('name')
          <p class="invalid-feedback">{{$message}}</p>
      @enderror


      <br>
      <br>
      <label>class</label>
      <select name="class" id="class">
          <option>Select Class</option>
      </select>
      @error('class')
          <p class="invalid-feedback">{{$message}}</p>
      @enderror


      <br>
      <br>

      <button class="btn bsb-btn-xl btn-primary py-3" type="submit">show subject </button>

  </form>
  


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <script>
      //all
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
      });

      //#class
      $(document).ready(function(){
          $('#Majors').change(function(){
              var Majors = $(this).val();

              if(Majors == ""){
                  var Majors = 0;
              }

              $.ajax({
                  url : '{{ url("secretary/fetchClass/")}}/'+ Majors,
                  type : 'post',
                  datatype: 'json',
                  success: function(response){
                      //من اجل تفضية ال opthin بعد كل تحديد
                      $('#class').find('option:not(:first)').remove();
                      $('#division').find('option:not(:first)').remove();
                      if(response['status'] > 0)
                      {
                          // console.log(response);     
                          $.each(response['Classes'],function(key,value){
                              $("#class").append("<option value='"+value['ClassId']+"'>"+value['ClassName']+"</option>");
                          });
                      }
                  }
              });

          });

      });


  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>


</body>
</html>