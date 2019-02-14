<?php 

	
	// require __DIR__ . '/vendor/autoload.php';

	// // echo "First: " . getenv("M_DB_HOST");

	// if(stristr($_SERVER['HTTP_HOST'], 'local') || (substr($_SERVER['HTTP_HOST'], 0, 7) == '192.168')){
	// 	$dotenv = new Dotenv\Dotenv(__DIR__);
	// 	$dotenv->load();
	// }


	// // echo "<br/>SECOND: " . getenv("M_DB_HOST");

	// $DB_HOST = getenv("M_DB_HOST");
	// $DB_NAME = getenv("M_DB_NAME");
	// $DB_USERNAME = getenv("M_DB_USERNAME");
	// $DB_PASSWORD = getenv("M_DB_PASSWORD");
	// $DB_PORT = getenv("M_DB_PORT");


	// $myPDO = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USERNAME, $DB_PASSWORD);

class Connection
{
  // public $server = "localhost";
  // public $user = "id8152710_iottest";
  // public $pass = "kasalian";
  // public $dbname = "id8152710_testiot";

	public $server = "localhost";
  public $user = "root";
  public $pass = "";
  public $dbname = "testiot";

	public $conn;
  public function __construct()
  {
  	$this->conn= new mysqli($this->server,$this->user,$this->pass,$this->dbname);
  	if($this->conn->connect_error)
  	{
  		die("connection failed");
  	}
  }
 	public function insert($dist,$loc,$cdtime)
 	{
 			$sql = "INSERT INTO garbage_data(distance,location,cdatetime) VALUES('$dist','$loc','$cdtime')";
 			$query = $this->conn->query($sql);
 			return $query;
 	}

 	public function lastRow(){
 		$sql = "SELECT distance, location FROM garbage_data ORDER BY id DESC LIMIT 1";
 		$qry = $this->conn->query($sql);
 		return $qry;
 	}
 }

 $conn = new Connection();

 ?>