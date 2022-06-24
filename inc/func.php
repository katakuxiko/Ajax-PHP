<?php
session_start();
include 'connect.php';
$idU = $_SESSION['user']['id'];
$sql = $pdo->prepare("SELECT * FROM `posts` WHERE `userId` = $idU;");
$sql->execute();
$result = $sql->fetchAll();

// DELETE
if (isset($_POST['delete_submit'])) {
$get_id = $_GET['id'];
$sql = "DELETE FROM posts WHERE id=?";
$query = $pdo->prepare($sql);
$query->execute([$get_id]);
header('Location: '. $_SERVER['HTTP_REFERER']);
}