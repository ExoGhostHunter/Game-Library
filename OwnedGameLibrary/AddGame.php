<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add Game Form</title>
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gamelibrary";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully!";
}
?>

<?php

//fileUpload
    $target_dir = "../../images/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}


//////////////////////////////////////////////////////////////////////////////////
// Get data from the POST request
    $gameTitle = $_POST['gameTitle'];
    $platform = $_POST['platform'];
    $genre = $_POST['genre'];
    $steamid = $_POST['steamid'];
    $descriptie = $_POST['descriptie'];
    $image = $_FILES["fileToUpload"]["name"];

    // Insert data into the 'games' table
    $sql = "INSERT INTO games (title, platform, genre, steamid, descriptie, image) VALUES ('$gameTitle', '$platform', '$genre', '$steamid', '$descriptie', '$image')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to the OwnedGameLibrary page
        // header("Location: OwnedGameLibrary.php");
        // exit();
        echo "Data send to database updated succesfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}


// Close connection
$conn->close();
?>
</body>
</html>
