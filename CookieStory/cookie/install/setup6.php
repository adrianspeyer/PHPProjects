<h2>How easy was that?</h2>
Your install packet has been deleted you may now <a href="../user/listing.php">login.</a>

 <p>NEED TO UNCOMMENT DELETE FOR PRODUCTION</p>
<?php
 NEED TO UNCOMMENT FOR PRODUCTION
$dir = "../install"; // directory name

foreach (scandir($dir) as $item) {
    if ($item == '.' || $item == '..') continue;
    unlink($dir.DIRECTORY_SEPARATOR.$item);
}
rmdir($dir);
?>

