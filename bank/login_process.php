<?php
include "config.php";

session_start(); 

if (isset($_POST['Login'])) {

    $name = $_POST["username"];
    $password = $_POST["password"];


    if (empty($name) && empty($password)) {
        echo "<script>alert('Both email and password are required.');</script>";
        echo "<script>location.href = 'login.php';</script>";
        exit();
    } elseif (empty($name)) {
        echo "<script>alert('Email is required.');</script>";
        echo "<script>location.href = 'login.php';</script>";
        exit();
    } elseif (empty($password)) {
        echo "<script>alert('Password is required.');</script>";
        echo "<script>location.href = 'login.php';</script>";
        exit();
    } else {
        $sql = "SELECT id, name, email, password FROM users WHERE name='$name' AND password='$password'";
        $request = mysqli_query($conn, $sql);
        
        if (!$request) {
            die("Error: " . mysqli_error($conn));
        }
        
        $result_array = mysqli_fetch_array($request);
        
        if (mysqli_num_rows($request) == 1) {
            $_SESSION["user_id"] = $result_array['id'];
            header("Location: index.php");
            exit();
        } else {
            echo "<script>alert('Invalid username or password');</script>";
            echo "<script>location.href = 'login.php';</script>";
            exit();
        }
    }
}
?>