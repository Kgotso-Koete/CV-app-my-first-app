<?php
require_once "pdo.php";
require_once "util.php";
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>Kgotso Koete: Index Page</title>
<?php require_once "head.php";?>
</head>
<body>

<h1>Kgotso Koete's Resume Registry</h1>

<div>
<?php
// Flash pattern
flashMessages();

if ( isset($_SESSION["name"]) )
{
    echo '<p style="color:green"> Welcome: '.$_SESSION['name']."</p>\n";
}
?>
</div>

<div>
<?php

if ( isset($_SESSION['name']) )
{
    echo('<table border="1">'."\n");
    echo('<tr><th>Name</th><th>Headline</th><th id = "toHide" >Action</th></tr>');
    $stmt = $pdo->query("SELECT * FROM profile");
    // pull SQL data to put into HTML table
    while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
        $profname = htmlentities($row['first_name'])." ".htmlentities($row['last_name']);
        $headline = htmlentities($row['headline']);
        $profileID = htmlentities($row['profile_id']);

        echo "<tr><td>";
        echo('<a href="view.php?profile_id='.$profileID.'">'.$profname.'</a>');
        echo("</td><td>");
        echo($headline);
        echo("</td><td  id = 'toHide' >");
        echo('<a href="edit.php?profile_id='.$profileID.'">Edit</a> / ');
        echo('<a href="delete.php?profile_id='.$profileID.'">Delete</a>');
        echo("</td></tr>\n");
    }
    echo '<div>
    <p><a href="logout.php">Logout</a></p>
    <p><a href="add.php">Add New Entry</a></p>

    </div>';
}
else
{
  echo('<table border="1">'."\n");
  echo('<tr><th>Name</th><th>Headline</th></tr>');
  $stmt = $pdo->query("SELECT * FROM profile");
  // pull SQL data to put into HTML table
  while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
      $profname = htmlentities($row['first_name'])." ".htmlentities($row['last_name']);
      $headline = htmlentities($row['headline']);
      $profileID = htmlentities($row['profile_id']);

      echo "<tr><td>";
      echo('<a href="view.php?profile_id='.$profileID.'">'.$profname.'</a>');
      echo("</td><td>");
      echo($headline);
      echo("</td></tr>\n");
  }
    echo '<div>
    <p><a href="login.php">Please log in</a></p>
    </div>';
}

?>

</div>


</body>
</html>
