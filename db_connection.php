<?php 
 
class DBConnection {
    private $_con;
 
    public function __construct() {
    	try {
        	$this->_con = new PDO('mysql:host=localhost;dbname=u1181048_default', 'u1181048_test', 'test1234');    
        	$this->_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    } catch(PDOException $e) {
			echo "Connection failed: " . $e->getMessage();
		} 
    }
    
    public function returnConnection() {
        return $this->_con;
    }
}
?>
