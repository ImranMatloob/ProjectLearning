<?php

function connectionTest($connection) {
    if (!$connection) {
        throw new Exception("Connection failed: " . mysqli_connect_error());
    } else{
        echo "we are up and running and connected to the database";
    }
}

$connect = mysqli_connect("db", "user", "password", "docker_php");

// Check connection
connectionTest($connect);
//
//- MYSQL_ROOT_PASSWORD=password
//- MYSQL_DATABASE=docker_php
//- MYSQL_USER=user
//- MYSQL_PASSWORD=password