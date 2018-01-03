//multiProcess.php
<?php 

$pid = pcntl_fork();

if ($pid) {
    //父进程
    echo $pid."This is parent process\n";
    pcntl_waitpid($pid, $status);
} elseif ($pid == 0) {
    //子进程
    echo $pid."This is child process\n";
} else {
    die("fork failed\n");
}