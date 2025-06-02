<?php
include 'Conn.php';

function getAllUser()
{
    global $conn;
    $query = 'SELECT * FROM user';
    return $conn->query($query);
}