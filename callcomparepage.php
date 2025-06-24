<?php
    $commit_id=$_GET["commit_id"];
    setcookie('commit_id', $commit_id, time() + (86400 * 30), "/"); // 86400 = 1 day
    header("Location: git-hub-compare.html");
?>