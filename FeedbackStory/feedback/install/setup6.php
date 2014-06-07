<h2>How easy was that?</h2>
Your install packet has been deleted you may now <a href="../admin/settings.php">login.</a>

<?php

$dir = "../install"; // directory name

foreach (scandir($dir) as $item) {
    if ($item == '.' || $item == '..') continue;
    unlink($dir.DIRECTORY_SEPARATOR.$item);
}
rmdir($dir);

?>

