<?php
// require the connection file
require __DIR__ . '/db_connect.php';
/** @var PDO $pdo */
/**
 * @return string
 * @var string $dbStatus
 */
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles.css">
    <title>Error Page</title>
</head>
<body>
<h1>Errors</h1>
<p>
    <?php echo($_SESSION['errMessage']); ?>
</p>

</body>
</html>
