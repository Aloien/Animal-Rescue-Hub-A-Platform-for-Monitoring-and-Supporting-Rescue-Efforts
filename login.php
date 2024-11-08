<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <form action="registration.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="fullname" placeholder="Full Name:">
            </div>
              <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email:">
            </div>
              <div class="form-group">
                <input type="password" class="form-control"  name="password" placeholder="Password:">
            </div>
              <div class="form-group">
                <input type="text" class="form-control" name="retype_password" placeholder="Retype_Password:">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="register" name="submit">
            
        </form>
    </div>
</body>
</html>
