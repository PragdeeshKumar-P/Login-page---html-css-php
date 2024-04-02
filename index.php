<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registeration</title>
    <link rel="shortcut icon" href="icon.png" type="icon">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="cont" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
        <h1 class="head">Registeration</h1>
        <?php

        include('connect.php');

        if(isset($_POST['submit'])){

            $username = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['pass'];

            $verify_query = mysqli_query($connect, "SELECT Email FROM Users WHERE Email = '$email' ");

            if(empty($username) OR empty($email) OR empty($password)){
                echo "
                
                <div id='message'>
                    Any of the fields is empty! Pls fill it.
                </div>
                
                
                ";
            }
            
            if(mysqli_num_rows($verify_query) != 0){
                echo "
                
                <div style='background-color: rgb(243, 202, 202);
                border: 1px solid rgb(243, 58, 58);
                color: rgb(243, 58, 58);
                padding: 20px 40px;'>
                    This email is already used!
                </div>
                
                <a style='background-color: #CD8D7A;
                border: 1px solid #CD8D7A;
                color: #EAECCC;
                padding: 10px 15px;
                text-decoration: none;
                border-radius: 7px;
                cursor: pointer;
                font-size: 15px;' href='javascript:self.history.back()'>Go back</a>
                
                ";
            }else{

                mysqli_query($connect, "INSERT INTO Users(Username, Email, Password) VALUES ('$username', '$email', '$password')");

                echo "
                
                <div id='message'>
                    Registeration successful!
                </div>

                <a style='background-color: #CD8D7A;
                border: 1px solid #CD8D7A;
                color: #EAECCC;
                padding: 10px 15px;
                text-decoration: none;
                border-radius: 7px;
                cursor: pointer;
                font-size: 15px;' href='home.php'>Login</a>
                
                ";            
            
            }

        }else{

        ?>
        <form action="" id="form" method="post">
            <input type="text" name="name" placeholder="Enter your name" id="username" required/>
            <input type="email" name="email" placeholder="Enter your email" id="email" required/>
            <input type="password" name="pass" placeholder="Enter your password" id="pass" required/>
            <input type="submit" value="Register" id="submit" name="submit"/>
        </form>
        <p>Wanna <a href="login.php" style="color:#CD8D7A;">Login?</a></p>
    </div>
    <?php } ?>
</body>
<script src="script.js"></script>
</html>
