<?php
$conn = mysqli_connect('localhost', 'root', '', 'frank');
mysqli_set_charset($conn,'utf8');
if (!$conn) {
    echo mysqli_connect_error();
}
