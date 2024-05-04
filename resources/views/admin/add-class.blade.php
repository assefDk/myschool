<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add class</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<br>
<body>

    <div>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>    
        @endif
    </div>



    <h1 class="add-class">add calss</h1>

    <form action="{{Route('admin.processClass')}}" method="post">
        @csrf

        <label for="majors">add major</label>
        <input type="text" value="General" id="majorname" name="majorname">
    
        <br>
        <br>

        <label for="ClassName">name calss</label>

        <select id="ClassName" name="ClassName">
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
        
        <br>
        <br>

        <label for="division">division</label>
        <select id="division" name="division">
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

        <br>
        <br>
        <button class="btn bsb-btn-xl btn-primary py-3" type="submit">add calss</button>

    </form>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>