<?php
// require the connection file
require __DIR__ . '/db_connect.php';
/** @var PDO $pdo */
/**
 * @return string
 * @var string $dbStatus
 */

// sanitize function
function sanitize($value): string
{
    // strip the whitespace
    $value = trim($value);

    // get rid of html tags
    $value = strip_tags($value);

    // convert special chars
    return htmlspecialchars($value, ENT_QUOTES, 'utf8');
}


// turn off the error reporting for login screen
//error_reporting(0);

if (isset($_POST['userName'])){

    // statement
    $sql =  "SELECT userName, password ".
            "FROM tblUser ".
            "WHERE userName = :userName";

    // prepare
    $sql_obj = $pdo->prepare($sql);

    // sanitize
    $userName = sanitize($_POST['userName']);

    // bind
    $sql_obj->bindParam(':userName', $userName);

    // execute
    $sql_obj->execute();

    // get data
    $rs = $sql_obj->fetch();

    if($rs['password'] == null){
//        echo("<br>Bad username or password<br>");

        // bad login
        $_SESSION['loginStatus'] = false;
        $_SESSION['errMessage'] = '<h3>Bad Login... Please try again or make a new user</h3>
            <nav>
                <a href="login.php">Login</a>
                <a href="newUser.php">New User</a>
            </nav>
            
        ';

        header("Location:errors.php");

    } else {
        // FOR EDUCATIONAL PURPOSES
        echo("Here is the hashed password for the account<br>");
        print_r($rs['password']);
        echo("<br><br>");

        // store the password
        $hash_pw_db = $rs['password'];

        // reverse the process and compare
        if (password_verify($_POST['password'],$hash_pw_db)){
            echo("Password is valid<br>");

            // set a flag - loginStatus
            // session_start is in db_connect already
            $_SESSION['loginStatus'] = true;
            $_SESSION['userName'] = $_POST['userName'];

            // go to members page
            header("Location:members.php");

        } else{
            // bad login
            $_SESSION['loginStatus'] = false;
            $_SESSION['errMessage'] = "Bad Login<br>
                <a href='login.php'>Login Page</a>";
            header("Location:errors.php");
        }
    }

}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles.css">
    <title>Login</title>
</head>
<body>
<?php require __DIR__ . '/nav.php'; ?>
<h1>Login</h1>


<form action="login.php" method="POST">
    <table>
        <tr>
            <td>
                Username
            </td>
            <td>
                <input type="text" name="userName" size="25" required>
            </td>
        </tr>

        <tr>
            <td>
                Password
            </td>
            <td>
                <input type="password" name="password" size="25" required>
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <input type="submit" value="Enter">
            </td>
        </tr>

    </table>
</form>

</body>
</html>