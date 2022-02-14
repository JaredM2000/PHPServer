<?php
$displayMe = "Undefined"; 

if($_SERVER['REQUEST_METHOD'] === 'POST'){
	
	function getAuthorInfo() 
	{
		$dsn = 'mysql:host=localhost;port=3306;dbname=pubs'; 
		$user = 'root';
		$password = 'root'; 

		$sql = ""; 
		$names = array(); 

		try{	
			$handle = new PDO($dsn, $user, $password); // open connection
		}catch(PDOException $ex){
			return "PDO create error: " . mysqli_connect_error() . "<br>"; 
		}

		$handle->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 		$handle->exec("SET CHARACTER SET utf8"); 

		$sql = "SELECT * FROM authors"; 

		$first = ''; 
		$last = '';  

		if(isset($_POST['frm_data'])) // serialized from JQuery
		{
			parse_str($_POST['frm_data'], $formdata); //convert string to array
 
			if(array_key_exists('f_name', $formdata))
			{
				$first = trim($formdata['f_name']);
			}

			if(array_key_exists('l_name', $formdata))
			{
				$last = trim($formdata['l_name']);
			}
		}
		else // form data NOT serialized from JQuery
		{
			if(isset($_POST['f_name']))
			{
				$first = trim($_POST['f_name']); 
			}

			if(isset($_POST['l_name']))
			{
				$last = trim($_POST['l_name']); 
			}
		}

		if($first != "" && $last != "") // first and last names
		{
			$names[] = $first;
			$names[] = $last; 

			$sql = "SELECT * FROM authors WHERE au_fname = ? AND au_lname = ?"; 

		}else if($first != "" && $last  == ""){ // first name only 

			$names[] = $first;

			$sql = " SELECT * FROM authors WHERE au_fname = ?"; 

		}else if($first == "" && $last != ""){ // last name only 

			$names[] = $last ;

			$sql = " SELECT * FROM authors WHERE au_lname = ?"; 
		}

		$stmt = $handle->prepare($sql);

        try{
			if(count($names) > 0){
				$stmt->execute($names); 
			}else{ // ask for all authors
				$stmt->execute(); 
			}

			$rows = array(); // exception not thrown

			while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$rows[] = $row; // add each row to array
			}

			$retVal = json_encode($rows); 

		}catch(PDOException $e) {

  			$retVal = "ERROR: " . $e->getMessage();
		}
	 
		$stmt->closeCursor(); 
		$stmt = null; 
		$handle = null; // close connection

		return $retVal; 		
	}// end function get author info

	$displayMe = getAuthorInfo(); 

}else{ // not post
	$displayMe = "NOT POST"; 
}// end if/else POST

echo $displayMe; // return result to Web page
?> 

