<?php
    include_once("db_info.php");
	
	function buildInsertQuery($table_name, $values){
		//$table_append = "censpro_";
		$value_list = "";
		$datatype_list = getTableColumnTypes($table_name);
		
		//for this to work, values must be in an order that complies with the database etructure.
		for($i = 0; $i<count($values); $i++){
			if(strpos($datatype_list[$i], "int(11)") !== false || strpos($datatype_list[$i], "BLOB") !== false)
				$value_list.=$values[$i].", ";
			else
				$value_list.="'".$values[$i]."', ";
		}
		$value_list = removeLastOccurenceOfChar(",", $value_list);
		
		$query = "INSERT INTO $table_name VALUES ($value_list)";
		
		return $query;
	}
	
	function db_insert($table_name, $values){				
		$query = buildInsertQuery($table_name, $values);		
		$result = db_query($query);
		return $result;	
	}
	
	function db_query($query){
		$db = new ConnectDB();
		$conn = $db->connect();
		//echo $query;
		$db_query = mysqli_query($conn, $query);
		if($db_query)
			return true;
		else return false;	
	}

	function db_query_intid($query){
		$db = new ConnectDB();
		$conn = $db->connect();
		//echo $query;
		$db_query = mysqli_query($conn, $query);
		$id = mysqli_insert_id($conn);
		if($db_query)
			return $id;
		else return -1;	
	}
	
	function db_query2($query){
		$db = new ConnectDB();
		$conn = $db->connect();
		//echo $query;
		$db_query = mysqli_query($conn, $query);
		if($db_query)
			return $db_query;
		else return "-1";	
	}
	
	function db_query3($query){
		$db = new ConnectDB();
		$conn = $db->connect();
		//echo $query;
		$db_query = mysqli_query($conn, $query) or die(mysql_error());
		//if($db_query)
		return $db_query;
		
	}
	
	function db_select1($table, $criteria, $value, $data_type){
		if($data_type != "int")
			$value = "'$value'";
		$db = new ConnectDB();
		$conn = $db->connect();
		$no_table_columns = countColumns($table);
		
		$query = "SELECT * FROM $table ";//WHERE $criteria = $value";
		$select_result = array();
		$count = 0;
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_array($result)){
				for ($i=0; $i<$no_table_columns; $i++)
					$select_result[$count][$i] = $row[$i];
				$count++;
			}
		}		
		return $select_result;		
	}
	
	function db_select($query, $table){
		
		$db = new ConnectDB();
		$conn = $db->connect();
		//$no_table_columns = countColumns($table);
		
		$select_result = array();
		$count = 0;
		//echo $query;
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) > 0){
			$rows = mysqli_num_rows($result);
			$columns = mysqli_num_fields($result);
			
			for($j =0; $j<$rows; $j++){
				$row = mysqli_fetch_array($result);
				for ($i=0; $i<$columns; $i++)
					$select_result[$j][$i] = $row[$i];
			}
			/*
			while($row = mysqli_fetch_array($result)){
				for ($i=0; $i<$no_table_columns; $i++)
					$select_result[$count][$i] = $row[$i];
				$count++;
			}*/			
		}		
		return $select_result;		
	}
	
	function getId($query){
		$db = new ConnectDB();
		$conn = $db->connect();
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) > 0){
			$row = mysqli_fetch_array($result);
			return $row[0];	
		}
		return 0;
	}
	
	function db_select2($query){
		
		$db = new ConnectDB();
		$conn = $db->connect();
		//$no_table_columns = countColumns($table);
		
		$select_result = array();
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) > 0){
			$rows = mysqli_num_rows($result);
			$columns = mysqli_num_fields($result);
			
			for($j =0; $j<$rows; $j++){
				$row = mysqli_fetch_array($result);
				for ($i=0; $i<$columns; $i++)
					$select_result[$j][$i] = $row[$i];
			}	
		}		
		return $select_result;		
	}
	
	function db_select2_1($query){
		
		$db = new ConnectDB();
		$conn = $db->connect();
		//$no_table_columns = countColumns($table);
		
		$select_result = array();
		$result = mysqli_query($conn, $query);
				
		return $result;		
	}
	
	function db_select3($query){
		$db = new ConnectDB();
		$conn = $db->connect();
		
		$data = array();
		$res = db_select2($query);
		for($i=0; $i<count($res); $i++)
			for($j=0; $j<count($res[0]); $j++)  
				$data[$i] = $res[$i][$j] ;//name is here
				
		return $data;
	}
	 
?>