<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
</head>
<body>

    <?php
        $uname = $password = $unameErr = $passwordErr = $msg = "";
        $flag = 0;
        $filepath = "userlogin.txt";
        $f = fopen($filepath,'r') or die("Fail to Open File");
        
        if ($_SERVER["REQUEST_METHOD"] =="POST")
        {
            if(empty($_POST['uname'])) 
            {
                $unameErr = "Please Fill Up the UserName";
            }
            else
            {
                $uname = $_POST['uname'];
            }

            if(empty($_POST['password'])) 
            {
                $passwordErr = "Please Fill Up the Password";
            }
            else
            {
                $password = $_POST['password'];
            }

            while($row = fgets($f)) 
            {
                list($userName,$password,$firstName,$lastName,$email,$gender,$recoveryEmail) = explode( ",", $row);

                if($userName == $uname && $password == $password)
                {
                    $flag++;
                    break;
                }
            }
            
            if ($flag>0)
            {
                $msg = "Successful";
                echo $msg;
                echo "<br>";
            }
            else
            {
                $msg = "Try Again";
                echo "Unsuccessful!" .$msg;
            }
        }

        session_unset();
        session_destroy();
        fclose($f);
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">

        <h2>User Login</h2>
        
        <b> <p>UserName</p> 
        <input type="text" name="uname" value="" placeholder="User Name">
        <p><?php echo $unameErr; ?></p>
        
                        
        <b> <p>Password</p> 
            <input type="password" name="password" value="" placeholder="Password">
        <p><?php echo $passwordErr; ?></p>
        
        <br> 
        <input type="submit" name="" value="Login">
    </form>
</body>
</html>