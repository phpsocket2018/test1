// server.php
<?php 


$sock = stream_socket_server("tcp://127.0.0.1:80", $errno, $errstr);

$pids = [];

for ($i=0; $i<10; $i++) {

    $pid = pcntl_fork();
    $pids[] = $pid;

    if ($pid == 0) {
        for ( ; ; ) {
            $conn = stream_socket_accept($sock);

            $write_buffer = "HTTP/1.0 200 OK\r\nServer: my_server\r\nContent-Type: text/html; charset=utf-8\r\n\r\nhello!world";

            fwrite($conn, $write_buffer);

            fclose($conn);
        }

        exit(0);
    }

}

foreach ($pids as $pid) {
    pcntl_waitpid($pid, $status);
}
/*
$sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

socket_bind($sock, "127.0.0.1", 80);

socket_listen($sock);

for ( ; ; ) {
    $conn = socket_accept($sock);

    $write_buffer = "HTTP/1.0 200 OK\r\nServer: my_server\r\nContent-Type: text/html; charset=utf-8\r\n\r\nhello!world";

    socket_write($conn, $write_buffer);

    socket_close($conn);
}*/