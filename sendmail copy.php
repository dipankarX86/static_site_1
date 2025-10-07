<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $myfile = fopen("TEST.txt", "w") or die("Unable to open file!");
    $txt = '$token';
    fwrite($myfile, $txt);
    fclose($myfile);

} else {
    // If accessed directly (without submitting form)
    header("Location: index.html");
    exit();
}
?>

