<html>
<head>
<meta name="viewport" content="width=320, height=480, initial-scale=1.0, minimum-scale=1.0, maximum-scale=2.0, user-scalable=yes">
	<meta charset="utf-8">
<title>mission5-1</title>
	</head>
		<body>
			<form action="mission_5-1.php" method="POST">
				<font size="3" color="black" face="verdana">名前:</font><br>
                <input type="text" name="name" placeholder="名前" height="2" size="50"><br>

				<font size="3" color="black" face="verdana">コメント:</font><br>
				<input type="text" name="comment" placeholder="コメント" size="50">

                <input type="hidden" name="rewnum2" placeholder="編集番号指定用フォーム"size="50"><br>

                <font size="3" color="black" face="verdana">パスワード:</font><br>
                <input type="text" name="compassword" placeholder="パスワード" value="" size="50"/>
                <input type="submit" name="comsubmit" size="20"><br><br>
            </form>

             <form action="mission_5-1.php" method="post">
                    <font size='3' color='black'>削除対象番号:</font><br>
                    <input type="text" name="delete" placeholder="削除番号" size="50"><br>
                    <font size="3" color="black" face="verdana">パスワード:</font><br>
                    <input type="text" name="depassword" placeholder="パスワード" value="" size="50"/>
                    <input type="submit" name="desubmit" value="削除"><br><br>
            </form>
            <form action="mission_5-1.php" method="post">
                    <font size="3" color="black">編集対象番号:</font><br>
                    <input type="text" name="rewnum1" placeholder="編集対象番号" size="50"><br>
                    <font size="3" color="black">名前:</font><br>
                    <input type="text" name="rename" placeholder="名前" size="50"><br>
                    <font size="3" color="black">コメント:</font><br>
                    <input type="text" name="recomment" placeholder="コメント" size="50"><br>
                    <font size="3" color="black" face="verdana">パスワード:</font><br>
                    <input type="text" name="repassword" placeholder="パスワード" value="" size="50"/>
                    <input type="submit" name="resubmit"value="編集"><br>
            </form>

        <?php 
        
              
        $dsn = 'mysql:dbname=tb220068db;host=localhost';
        $user = 'tb-220068';
        $password = 'KH97Ctt4RP';
        $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
       
//テーブルを作成   
        $sql = "CREATE TABLE IF NOT EXISTS onepiece"
        ." ("
        . "id INT AUTO_INCREMENT PRIMARY KEY,"
        . "name char(32),"
        . "comment TEXT,"
        ."date DATE,"
        ."password TEXT"
        .");";
        $stmt = $pdo->query($sql);
        
       // $sql="DROP TABLE onepiece";
        //$delete=$pdo->query($sql) ;

        /*$sql ='SHOW TABLES';
        $result = $pdo -> query($sql);
        foreach ($result as $row){
            echo $row[0];
            echo '<br>';
        }
        echo "<hr>";*/
//入力
    if(!empty($_POST['comsubmit'])){
           if(!empty($_POST['name'])&&!empty($_POST['comment'])&&!empty($_POST['compassword'])){
                $password=$_POST["compassword"];
                $Originpassword="pw123";
                if($password=$Originpassword){

        $sql = $pdo -> prepare("INSERT INTO onepiece (name, comment,date) VALUES (:name, :comment,:date)");
        $sql -> bindParam(':name', $name, PDO::PARAM_STR);
        $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
        $sql -> bindParam(':date', $date, PDO::PARAM_STR);
        $name = $_POST["name"];
        $comment =$_POST["comment"];
        $date = date("Y/m/d H:i:s"); 
        $sql -> execute();
    }
    }
    }
//編集
    if(!empty($_POST['resubmit'])){
        if(!empty($_POST['rename'])&&!empty($_POST['recomment'])&&!empty($_POST['repassword'])){
             $password=$_POST["repassword"];
             $Originpassword="pw123";
             if($password=$Originpassword){

                $id =  $_POST["rewnum1"]; //変更する投稿番号
                $name =  $_POST["rename"];
                $comment =$_POST["recomment"]; //変更したい名前、変更したいコメントは自分で決めること
                $sql = 'update onepiece set name=:name,comment=:comment 
                where id=:id';
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
             }}
        }
//削除
        if(!empty($_POST['desubmit'])){
        if(!empty($_POST['delete'])&&!empty($_POST['depassword'])){
             $password=$_POST["depassword"];
             $Originpassword="pw123";
             if($password=$Originpassword){

                $id = $_POST["delete"];
                $sql = 'delete from onepiece where id=:id';
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
             }}
            }
    $sql = 'SELECT * FROM onepiece';
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll();
    foreach ($results as $row){
        //$rowの中にはテーブルのカラム名が入る
        echo $row['id'].',';
        echo $row['name'].',';
        echo $row['comment'].',';
        echo $row['date'].'<br>';
    echo "<hr>";
}

        ?>
        </body>
    </html>