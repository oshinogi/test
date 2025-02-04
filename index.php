<?php include('pdo.php'); ?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="POST">
        <button formaction="admin.php">管理画面へ</button>
        <p>投稿者</p>
        <input type="text" name="user_name">
        <p>内容</p>
        <input type="textarea" name="content">
        <input type="submit" name="投稿">
    </form>

    <?php
    $result = select_all();
    foreach($result as $r){
        echo "<p>", $r['content'], "</p>"; 
        echo "<p>投稿者: ", $r['user_name'], "</p>";
        echo "<p>投稿時間: ", $r['upload_time'],  "</p>";
        if($r['update_time'] != NULL){
            echo "<p>更新時間: " ,$r['update_time'],  "</p>";
        }
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['user_name']) && !empty($_POST['content'])){
        insert_data($_POST['user_name'], $_POST['content']);
    }
    ?>
</body>

