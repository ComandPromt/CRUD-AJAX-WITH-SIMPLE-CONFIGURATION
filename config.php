<?php 

class Userfunction{

	private $DBHOST='';
	
	private $DBUSER='';
	
	private $DBPASS='';
	
	private $DBNAME='';
	
	public $con;

	public function __construct(){
	
		$this->con = mysqli_connect($this->DBHOST, $this->DBUSER, $this->DBPASS, $this->DBNAME);

		if(!$this->con){
			
			return false;

		}

	}

	public function htmlvalidation($form_data){
		
		$form_data = trim( stripslashes( htmlspecialchars( $form_data ) ) );
		
		$form_data = mysqli_real_escape_string($this->con, trim(strip_tags($form_data)));
		
		return $form_data;
		
	}

	public function insert($tblname, $filed_data){

		$query_data = "";

		foreach ($filed_data as $q_key => $q_value) {
			
			$query_data = $query_data."$q_key='$q_value',";
			
		}
		
		$query_data = rtrim($query_data,",");

		$query = "INSERT INTO $tblname SET $query_data";
		
		$insert_fire = mysqli_query($this->con, $query);
		
		if($insert_fire){
			
			return $insert_fire;
			
		}
		
		else{
			
			return false;
			
		}

	}

	public function select_assoc($tblname, $condition, $op='AND'){

		$field_op = "";
		
		foreach ($condition as $q_key => $q_value) {
			
			$field_op = $field_op."$q_key='$q_value' $op ";
			
		}
		
		$field_op = rtrim($field_op,"$op ");

		$select_assoc = "SELECT * FROM $tblname WHERE $field_op";
		
		$select_assoc_query = mysqli_query($this->con, $select_assoc);
		
		$resultado=false;
		
		if(mysqli_num_rows($select_assoc_query) > 0){
			
			if(mysqli_num_rows($select_assoc_query) == 1){
				
				$select_assoc_fire = mysqli_fetch_assoc($select_assoc_query);
				
				if($select_assoc_fire){
					
					$resultado=$select_assoc_fire;
					
				}
				
			}
		
		}
		
		return $resultado;
		
	}

	public function verDatos($id,$tabla){
				
		$resultado=array();

		$select = "SELECT * FROM $tabla WHERE ID = $id";

		$select_fire = mysqli_query($this->con, $select);
		
		if(mysqli_num_rows($select_fire) > 0){
			
			while($row = mysqli_fetch_array($select_fire)) {
		
				for($i=1;$i<count($row);$i++){
					
					$resultado[]=$row[$i];
					
				}
			
			}

		}
		
		return $resultado;

	}

	public function insertarDatos($valores,$cabeceras,$tabla){
				
		$select = 'SELECT COUNT(ID) FROM '.$tabla.' WHERE '.$cabeceras[0]." = '".$valores[0]."'";

		$select_fire = mysqli_query($this->con, $select);
		
		$row = mysqli_fetch_array($select_fire);
					
		if((int)$row[0]==0){
		
			$columnas="";
			
			$datos="";
			
			for($i=0;$i<count($cabeceras);$i++){
				
				$columnas.=$cabeceras[$i].',';
				
				$datos.="'".$valores[$i]."',";
				
			}
			
			$columnas= substr($columnas, 0, -1);
			
			$datos= substr($datos, 0, -1);
		
			mysqli_query($this->con, 'INSERT INTO '.$tabla.' ('.$columnas.') VALUES('.$datos.')');

		}
					
	}

	public function eliminarDatos($id,$tabla){
	
		mysqli_query($this->con, 'DELETE FROM '.$tabla.' WHERE ID= '.$id);
			
	}

	public function actualizarDatos($valores,$cabeceras,$tabla,$id){
		
		for($i=0;$i<count($cabeceras);$i++){
			
			$select = "SELECT ".$cabeceras[$i].' FROM '.$tabla.' WHERE '.$cabeceras[$i]." = '".$valores[$i]."'";

			$select_fire = mysqli_query($this->con, $select);
		
			$row = mysqli_fetch_array($select_fire);
			
			if($row[0]!=$valores[$i]){
			
				mysqli_query($this->con, 'UPDATE '.$tabla.' SET '.$cabeceras[$i]." = '".$valores[$i]."' WHERE ID=".$id);
	
			}
				
		}
		
	}

	public function verColumnas($tblname){
		
		$resultado=array();

		$select = "SELECT COLUMN_NAME
		FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tblname' 
		ORDER BY ordinal_position";
		
		$select_fire = mysqli_query($this->con, $select);
		
		if(mysqli_num_rows($select_fire) > 0){
			
			$select_fetch = mysqli_fetch_all($select_fire, MYSQLI_ASSOC);
			
			if($select_fetch){
				
				for($i=0;$i<count($select_fetch);$i++){

					$resultado[]=$select_fetch[$i]["COLUMN_NAME"];
				}
								
			}

		}
		
		return $resultado;

	}

	public function select($tblname){

		$select = "SELECT * FROM $tblname";
		
		$select_fire = mysqli_query($this->con, $select);
		
		$resultado=false;
		
		if(mysqli_num_rows($select_fire) > 0){
			
			$select_fetch = mysqli_fetch_all($select_fire, MYSQLI_ASSOC);
			
			if($select_fetch){
				
				$resultado=$select_fetch;
				
			}
						
		}
					
		return $resultado;
				
	}

	public function update($tblname, $field_data, $condition, $op='AND'){

		$field_row = "";
		
		foreach ($field_data as $q_key => $q_value) {
			
			$field_row = $field_row."$q_key='$q_value',";
			
		}
		
		$field_row = rtrim($field_row,",");

		$field_op = "";

		foreach ($condition as $q_key => $q_value) {
			
			$field_op = $field_op."$q_key='$q_value' $op ";
			
		}
		
		$field_op = rtrim($field_op,"$op ");

		$update = "UPDATE $tblname SET $field_row WHERE $field_op";
				
		$update_fire = mysqli_query($this->con, $update);
		
		$resultado=false;
		
		if($update_fire){
		
			$resultado=$update_fire;

		}
		
		return $resultado;
		
	}	

	public function delete($tblname, $condition, $op='AND'){

		$delete_data = "";

		foreach ($condition as $q_key => $q_value) {
			
			$delete_data = $delete_data."$q_key='$q_value' $op ";
			
		}

		$delete_data = rtrim($delete_data,"$op ");
		
		$delete = "DELETE FROM $tblname WHERE $delete_data";
		
		$delete_fire = mysqli_query($this->con, $delete);
		
		$resultado=false;
		
		if($delete_fire){
			
			$resultado= $delete_fire;
			
		}
		
		return $resultado;
		
	}

	public function search($tblname,$search_val,$op="AND"){

		$search = "";
		
		foreach($search_val as $s_key => $s_value){
			
			$search = $search."$s_key LIKE '%$s_value%' $op ";
			
		}
		
		$search = rtrim($search, "$op ");

		$search = "SELECT * FROM $tblname WHERE $search";

		$search_query = mysqli_query($this->con, $search);
		
		if(mysqli_num_rows($search_query) > 0){
			
			$serch_fetch = mysqli_fetch_all($search_query, MYSQLI_ASSOC);
			
			return $serch_fetch;
			
		}
		
	}	

}

?>
