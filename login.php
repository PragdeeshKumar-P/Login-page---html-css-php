<?php

    session_start();

    if(isset($_COOKIE['email']) && isset($_COOKIE['pass'])){

        $cmail = $_COOKIE['email'];
        $cpass = $_COOKIE['pass'];

    }else{

        $cmail = "";
        $cpass = "";

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="shortcut icon" href="img/account.png" type="icon">
    <link rel="stylesheet" href="style/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="cont" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
        <h1 class="head">Login</h1>
        <?php

        include('routes/connect.php');

        if(isset($_POST['submit'])){

            $email = mysqli_real_escape_string($connect,$_POST['email']);
            $password = mysqli_real_escape_string($connect,$_POST['pass']);

            $result = mysqli_query($connect,"SELECT * FROM Users WHERE Email = '$email' AND Password = '$password'") or die("Error OCCURED!");
            $row = mysqli_fetch_assoc($result);

            if(is_array($row) && $row['Email'] === $email && $row['Password'] === $password){
                $_SESSION['valid'] = $row['Email'];
                $_SESSION['Username'] = $row['Username'];
                $_SESSION['id'] = $row['Id'];

                if(isset($_POST['remember_me'])){
                    setcookie('email',$_POST['email'],time() + (60*60*24));
                    setcookie('pass',$_POST['pass'],time() + (60*60*24));
                }else{
                    setcookie('email','',time() - (60*60*24));
                    setcookie('pass','',time() - (60*60*24));
                }

                echo "
                
                <div id='message'>
                    Logged in!
                </div>
                
                <a style='background-color: #CD8D7A;
                border: 1px solid #CD8D7A;
                color: #EAECCC;
                padding: 10px 15px;
                text-decoration: none;
                border-radius: 7px;
                cursor: pointer;
                font-size: 15px;' href='home.php'>Continue to Website.</a>

                "; 
                
            }else{
                echo "
                
                <div style='background-color: rgb(243, 202, 202);
                border: 1px solid rgb(243, 58, 58);
                color: rgb(243, 58, 58);
                padding: 20px 40px;'>
                    Wrong username or password!
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
            }
        }else{


        ?>
        <form action="" id="form" method="post">
            <input type="email" name="email" placeholder="Enter your email" id="email" value="<?php echo $cmail ?>"/>
            <input type="password" name="pass" placeholder="Enter your password" id="pass" value="<?php echo $cpass ?>"/>
            <p style="display:flex; color:#CD8D7A; align-items:center; justify-content:space-between; gap: 15px;">Remember me: <input style="width: 16px; 
    height: 16px;" type="checkbox" name="remember_me" id="remember_me">
            </p>    
            <input type="submit" value="Login" id="submit" name="submit"/>
        </form>
        <p>Wanna <a href="index.php" style="color:#CD8D7A;">Register?</a></p>
    </div>
    <?php } ?>
</body>
<script src="script.js"></script>
</html>