//zombieProcess.php
<?php 

$pid = pcntl_fork();

if ($pid) {
    //������
    echo "This is parent process\n";
    sleep(30);
} elseif ($pid == 0) {
    //�ӽ���
    echo "This is child process\n";
} else {
    die("fork failed\n");
}