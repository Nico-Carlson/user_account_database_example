<?php
// require the connection file
require __DIR__ . '/db_connect.php';
/** @var PDO $pdo */
/**
 * @return string
 * @var string $dbStatus
 */


function sanitize($value): string
{
    // strip the whitespace
    $value = trim($value);

    // get rid of html tags
    $value = strip_tags($value);

    // convert special chars
    $value = htmlspecialchars($value, ENT_QUOTES, 'utf8');

    return $value;
}


if(!empty($_POST['userName'])) {

    try {
        $pwd = $_POST['password'];

        $sql = "INSERT INTO tblUser(firstName, lastName, userName, password)
                VALUES             (:firstName, :lastName, :userName, :password); ";

        // prepare
        $sqlobj = $pdo->prepare($sql);

        // sanitize
        $firstName = sanitize($_POST['firstName']);
        $lastName = sanitize($_POST['lastName']);
        $userName = sanitize($_POST['userName']);

        // -------- password -----------
        // hash the password
        $password = password_hash($pwd, PASSWORD_DEFAULT);
        // -----------------------------

        // bind
        $sqlobj->bindParam(":firstName", $firstName);
        $sqlobj->bindParam(":lastName", $lastName);
        $sqlobj->bindParam(":userName", $userName);
        $sqlobj->bindParam(":password", $password);

        // execute
        $sqlobj->execute();

        echo("Successfully entered new user<br>");
        header("Location: default.php");

    } catch (PDOException $ee) {
        // you'd show this for development
        echo($ee->getMessage());
        echo("<br><br>");
        echo($ee->getCode());

        // and show the user this if they enter a duplicate
        if($ee->getCode() == 23000){
            echo("<br>Username is already taken...");
            echo('<script>alert("Please enter a different username");</script>script>');
            header("Location: newUser.php");
        }
    }

} else {
    echo('

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles.css">
    <title>New User</title>
</head>
<body>
');
require __DIR__ . '/nav.php';
echo('
<h1>New User</h1>

<form action="newUser.php" method="POST">
    <table>
        <tr>
            <td colspan="2">
                Enter New User
            </td>
        </tr>

        <tr>
            <td>
                First Name
            </td>
            <td>
                <input type="text" name="firstName" size="25">
            </td>
        </tr>

        <tr>
            <td>
                Last Name
            </td>
            <td>
                <input type="text" name="lastName" size="25">
            </td>
        </tr>

        <tr>
            <td>
                UserName
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

        ');
}