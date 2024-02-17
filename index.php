<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Login </title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <form action="login.php" method="POST">
        <div class="form-container">
            <h2 class="login-title"> Login </h2>

            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <input type="email" name="Email" class="userName" placeholder="Email" maxlength="40">
            <input type="password" name="userPassword" class="userPassword" placeholder="Password" maxlength="40">
            <button class="loginBtn"> Login </button>
        </div>
    </form>
</body>
</html>