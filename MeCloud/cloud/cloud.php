<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cloud Page</title>

    <link rel="stylesheet" href="cloudStyles.css"> 
</head>
<body>
    <h1>Welcome to your cloud storage!</h1>
    <div class="data-list">
        <h2>Here are your files:</h2>
    </div>
    <?php
    session_start();
    if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
        header("Location: login.php");
        exit();
    }

    $path = $_SESSION['path'];

    $dh = opendir($path);
    if ($dh !== false) {
        while (($file = readdir($dh)) !== false) {
            if ($file != "." && $file != "..") {
                $safe_file = htmlspecialchars($file, ENT_QUOTES, 'UTF-8');
                $file_url = htmlspecialchars($path . DIRECTORY_SEPARATOR . $file, ENT_QUOTES, 'UTF-8');
                echo "<a href='downloadFile.php?filename=$safe_file'>$safe_file</a><br>";
                echo "<form action='deleteFile.php' method='post' style='display:inline;'>
                        <input type='hidden' name='filename' value='$safe_file'>
                        <input type='submit' value='Delete'>
                      </form><br /><br />";
            }
        }
        closedir($dh);
    } else {
        echo "Unable to open directory.";
    }
    ?>

<div class="upload-container">
    <form action="upload.php" method="post" enctype="multipart/form-data" id="uploadForm">
        <label for="filesToUpload">Select files to upload:</label>
        <input type="file" name="filesToUpload[]" id="filesToUpload" multiple>
        <input type="submit" value="Upload Images" name="submit">
    </form>
</div>


    
</body>
</html>
