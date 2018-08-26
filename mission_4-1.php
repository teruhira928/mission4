<?php
$dsn='mysql:dbname=データベース名;host=localhost';
$user='ユーザー名';
$password='パスワード';
$pdo=new PDO($dsn,$user,$password);

/*$sql="DESC tbtest";
$results=$pdo ->query($sql);*/


if(isset($_POST['btn3'])){

$sql='SELECT*FROM tbtest';
$results=$pdo ->query($sql);

foreach($results as $row){

if(($row['id']==$_POST['edit0'])&&($row['pass']==$_POST['pass2'])){
$value3=$row['id'];
$value0=$row['name'];
$value1=$row['comment'];
$value2=$row['pass'];
echo "編集モード<hr>";
}elseif(($row['id']==$_POST['edit0'])&&($row['pass']!=$_POST['pass2'])){
	$errors="パスワードが違います<br>";

}
}
}
?>
<html>
<meta http-equiv="content-type" charset="utf-8">
<body>

<form method="POST" action="./mission_4-1.php">

入力<hr align="left" width="300">
名前&emsp;&emsp;&emsp;&nbsp;<input type="text" name="name0" placeholder="名前" value="<?php echo $value0; ?>" ><br/>
コメント&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="comment0" placeholder="コメント" value="<?php echo $value1; ?>" ><br/>
パスワード&nbsp;<input type="text" name="pass0" placeholder="パスワード" value="<?php echo $value2; ?>" >
<input type="hidden" name="edit1" value="<?php echo $value3; ?>" >
<input type="submit" name="btn1" value="送信"><br/><br/>
削除<hr align="left" width="210">
<input type="text" name="delete0" placeholder="削除番号"><br/>
<input type="text" name="pass1" placeholder="パスワード" value="" >
<input type="submit" name="btn2" value="削除"><br/><br/>
編集<hr align="left" width="210">
<input type="text" name="edit0" placeholder="編集番号" value="" ><br/>
<input type="text" name="pass2" placeholder="パスワード" value="" >
<input type="submit" name="btn3" value="編集"><br/><br/>
</form>

</body>
</html>

<?php
$dsn='mysql:dbname=データベース名;host=localhost';
$user='ユーザー名';
$password='パスワード';
$pdo=new PDO($dsn,$user,$password);

$sql="CREATE TABLE tbtest"
."("
."id INT,"
."name char(32),"
."comment TEXT,"
."hiduke TEXT,"
."pass TEXT"
.");";
$stmt=$pdo->query($sql);

/*$sql="SHOW TABLES";
$result=$pdo -> query($sql);
foreach($result as $row){
echo $row[0];
echo "<br/>";
}*/

$pass0 = $_POST['pass0'];
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];

$sql='SELECT*FROM tbtest ORDER BY id ASC';
$results=$pdo ->query($sql);
$nmm=0;
foreach($results as $row){
	
		$nmm=$row['id'];
	

}
//echo ($nmm+1);

//入力
if(isset($_POST['btn1'])&&!empty($_POST['name0'])&&!empty($_POST['comment0'])&&empty($_POST['edit1'])){
$sql=$pdo -> prepare("INSERT INTO tbtest(id,name,comment,hiduke,pass)VALUES(($nmm+1),:name,:comment,now(),:pass)");
$sql -> bindParam(':name',$name,PDO::PARAM_STR);
$sql -> bindParam(':comment',$comment,PDO::PARAM_STR);
//$sql -> bindParam(':datet',$datet,PDO::PARAM_STR);
$sql -> bindParam(':pass',$pass,PDO::PARAM_STR);
$name=$_POST['name0'];
$comment=$_POST['comment0'];
//$daaa=date("Y-m-d H:i:s");
$pass=$_POST['pass0'];
$sql -> execute();
}

//削除番号のパスワードを取得
if(isset($_POST['btn2'])&&!empty($_POST['delete0'])){
$id=$_POST['delete0'];
$sql="SELECT pass FROM tbtest where id=$id";
$resultt=$pdo -> query($sql);
foreach($resultt as $row){
//echo $row['pass'];
}
//echo $row['pass'];
}
//削除
if(isset($_POST['btn2'])&&!empty($_POST['delete0'])&&$row['pass']==$_POST['pass1']){
$delete = $_POST['delete0'];
$id=$delete;
$sql="delete from tbtest where id=$id";
$result=$pdo -> query($sql);
}elseif(isset($_POST['btn2'])&&!empty($_POST['delete0'])&&$row['pass']!=$_POST['pass1']){
	$errors="パスワードが違います<br>";
}



//編集
if(isset($_POST['btn1'])&&!empty($_POST['edit1'])&&!empty($_POST['name0'])&&!empty($_POST['comment0'])){
$id=$_POST['edit1'];
$nm=$_POST['name0'];
$kome=$_POST['comment0'];
//$deto=date("Y/m/d H:i:s");
$pasu=$_POST['pass0'];
$sql="update tbtest set name='$nm',comment='$kome',hiduke=now(),pass='$pasu' where id=$id";
$result=$pdo -> query($sql);

}
//エラーメッセージ
echo $errors;

//表示
echo "<hr size=6>";
$sql='SELECT*FROM tbtest ORDER BY id ASC';
$results=$pdo ->query($sql);

foreach($results as $row){
echo $row['id'].' ';
echo $row['name'].' ';
echo $row['comment'].' ';
//echo $row['pass'].' ';
echo $row['hiduke'].'<br>';

//print_r($row);echo "<br>";
}


?>

