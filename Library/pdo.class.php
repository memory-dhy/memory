<?php
#定义pdo数据库操作类
class PdoManager{
	#定义全局私有变量
	private $conn;
	public function __construct($host,$user,$pwd,$char = 'utf8'){
		try{
			$this->conn = new PDO($host,$user,$pwd);
			$this->conn->query('set names '.$char);
			#设置PDO异常输出方式
 			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $this->conn;
		}catch(PDOException $e){
			die('错误信息：'.$e->getMessage());
		}
	}
	public function toExec($sql){
		try{
			return $this->conn->exec($sql);
		}catch(PDOException $e){
			die('错误信息：'.$e->getMessage());
		}
	}
	public function getData($sql,$isMore = true,$model = PDO::FETCH_ASSOC){
		try{
			$result = $this->conn->query($sql);
			if($isMore){
				$content = $result->fetchall($model);
			}else{
				$content = $result->fetch($model);
			}
			return $content;
		}catch(PDOException $e){
			die('错误信息：'.$e->getMessage());
		}
	}
	public function __destruct(){
		$this->conn = null;
	}
}
$pdo = new PdoManager('mysql:host=127.0.0.1;dbname=memory','root','root');
?>