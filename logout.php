<?php
session_start();
session_destroy();
header("Location: index.php");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
exit();