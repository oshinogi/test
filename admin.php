<?php
include('pdo.php');
session_start();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php">
        <input type="submit" value="TOPへ戻る">
    </form>

    <?php
    $result = select_all();
    foreach($result as $r) {
        echo "<p>" ,$r['content'], "</p>";
        echo "<p>投稿者: ",$r['user_name'], "</p>";
        echo "<p>投稿時間: " , $r['upload_time'], "</p>";
        if ($r['update_time'] != NULL) {
            echo "<p>更新時間: " , $r['update_time'], "</p>";
        }
        ?>

        <form action="admin.php" method="POST">
            <button type="submit" name="edit" value="<?php echo $r['id']; ?>">編集</button>
            <button type="submit" name="del" value="<?php echo $r['id']; ?>">削除</button>
        </form>

        <?php
        if (isset($_POST['edit']) && $_POST['edit'] == $r['id']) {
            echo "<form action='admin.php' method='POST'>
                    <input type='hidden' name='post_id' value='" . $r['id'] . "'>
                    <label for='edit_content'>内容:</label>
                    <textarea name='edit_content' required>" ,$r['content'], "</textarea><br>
                    <input type='submit' name='update' value='更新'>
                </form>";
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update']) && isset($_POST['edit_content']) && isset($_POST['post_id'])) {
            $edit_content = $_POST['edit_content'];
            $post_id = $_POST['post_id'];
            
            if (!empty($edit_content)) {
                update_data($post_id, $edit_content);
            }
        }
        if (isset($_POST['del']) && $_POST['del'] == $r['id']) {
            echo "<script type='text/javascript'>
                if(confirm('本当に削除しますか？')) {
                    location.href = 'admin.php?del_id=" . $r['id'] . "';
                }
            </script>";
        }
    }
    if (isset($_GET['del_id'])) {
        $post_id = $_GET['del_id'];
        delete_data($post_id);
    }
    ?>

</body>
</html>
