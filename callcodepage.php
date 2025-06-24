<?php
    $repo_id=$_GET["id"];
    setcookie('repo_id', $repo_id, time() + (86400 * 30), "/"); // 86400 = 1 day
    header("Location: github-code.html");
?>