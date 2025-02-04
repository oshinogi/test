<?php
    $dsn      = 'mysql:dbname=test;host=localhost';
    $user     = 'root';
    $password = '20001122';
    $dbh      = null;
    try {
        $dbh = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        print("データベースの接続に失敗しました".$e->getMessage());
        die();
    }

    function select_all(){
        global $dbh;
        $stmt = $dbh->query('SELECT * FROM test ORDER BY upload_time DESC;');
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function insert_data($user_name,$content){
        date_default_timezone_set('Asia/Tokyo');
        global $dbh;
        $stmt = $dbh->prepare('INSERT INTO test(user_name,content,upload_time) VALUE(?,?,?);');
        $stmt->bindParam(1,$user_name);
        $stmt->bindParam(2,$content);
        $stmt->bindParam(3,date("Y/m/d H:i:s"));
        $stmt->execute();
        $result = $stmt->fetchAll();
    }
    function delete_data($id){
        global $dbh;
        $stmt = $dbh->prepare('DELETE FROM test WHERE id = ?;');
        $stmt->bindParam(1,$id);
        $stmt->execute();
    }
    function update_data($id,$content){
        global $dbh;
        $stmt = $dbh->prepare('UPDATE test SET content = ?, update_time = ? WHERE id = ?;');
        $stmt->bindParam(1,$content);
        $stmt->bindParam(2,date("Y/m/d H:i:s"));
        $stmt->bindParam(3,$id);
        $stmt->execute();
    }
?>