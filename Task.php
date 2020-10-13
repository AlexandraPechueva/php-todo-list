<?php
    include('db_connection.php');

class Task 
{
    protected $db;
    private $_taskID;
    private $_title;
    private $_status;
 
    public function setTaskID($taskID) {
        $this->_taskID = $taskID;
    }
    public function setTitle($title) {
        $this->_title = $title;
    }
    public function setStatus($status) {
        $this->_status = $status;
    }
    
    public function __construct() {
        $this->db = new DBConnection();
        $this->db = $this->db->returnConnection();
    }
 
    // create
    public function createTask() {
		try {
    		$sql = 'INSERT INTO tasks (title, status)  VALUES (:task, :status)';
    		$data = [
			    'task' => $this->_title,
			    'status' => $this->_status,
			];
	    	$stmt = $this->db->prepare($sql);
	    	$stmt->execute($data);
			$status = $this->db->lastInsertId();
            return $status;
 
		} catch (Exception $err) {
    		die("query error ".$err);
		}
 
    }
 
    // update
    public function updateTask() {
        try {
		    $sql = "UPDATE tasks SET  status=:status WHERE id=:task_id";
		    $data = [
			    'status' =>$this->_status,
			    'task_id' => $this->_taskID
			];
			$stmt = $this->db->prepare($sql);
			$stmt->execute($data);
			$status = $stmt->rowCount();
            return $status;
		} catch (Exception $err) {
			die("query error" . $err);
		}
    }
   
    // getAll Task
    public function getAllTask() {
    	try {
    		$sql = "SELECT * FROM tasks";
		    $stmt = $this->db->prepare($sql);
		    $data = [];
		    $stmt->execute($data);		    
			$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
		} catch (Exception $err) {
		    die("query error " . $err);
		}
    }    
}
?>
