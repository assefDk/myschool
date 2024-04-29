<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add teacher</title>
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



        <h1 class="add-class">إضافة فئة</h1>
    
        <label for="majors">إضافة تخصصات</label>
        <input type="text" id="majors" name="majors">
    
        <label for="class-names">أسماء الصفوف:</label>
        <select id="class-names" name="class-names">
            <option value="1">الصف 1</option>
            <option value="2">الصف 2</option>
            <!-- ... تكرار الخيارات للصفوف الأخرى -->
            <option value="12">الصف 12</option>
        </select>
    
        <label for="numbers">الأرقام من 1 إلى 10:</label>
        <select id="numbers" name="numbers">
            <option value="1">1</option>
            <option value="2">2</option>
            <!-- ... تكرار الخيارات للأرقام الأخرى -->
            <option value="10">10</option>
        </select>
    




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>