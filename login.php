<!--login.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, 
                   initial-scale=1.0">


<style>
input[type=submit]{
    background-color: blue;
    color: white;
    margin-top: 35px;
    padding: 10px;
    margin-left: 5px;
    margin-right: 5px;
}
input[type=submit]:hover {
background-color: rgb(76, 238, 84);
color: white;
cursor: pointer;
}
input[type=text],input[type=password]{
    padding: 15px;
    margin-top: 2px;
}
.login_form{
    background-color: white;
    text-align: center;
    padding: 50px;
    border-radius: 15px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    margin: 0 auto;
    margin-top: 45px;
}
</style>
</head>

<div class="login_form">
<form action="login_verification.php" method="post">
<h1 style="margin-bottom:20px">Login</h1>
Username: <br><input type="text" name="un" id="un"><br>
Password: <br><input type="password" name="pass" id="pass"><br>
<input type="submit" value="Login to mera-darzi website">
</form>
</div>

</body>

</html>