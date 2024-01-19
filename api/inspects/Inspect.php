<?php

/**
 * 
 */

include_once '../../Database.php';

class Inspect
{	
	protected $conn;
	protected $table = 'tblProdLotDetail';
	
	function __construct()
	{
		# code...
		// instantiate database and product object
		$this->database = new Database();
		$this->conn = $this->database->getConnection();
	}

	public function find($mecha_serial){
		$query = "select 
				mechaserial
				,[status_mch]
				,[proc1]
				,[proc2]
				,[proc3]
				,[proc4]
				,[proc5]
				,[proc6]
				,[proc7]
				,[proc8]
				,[proc9]
				,[proc10]
				,[proc11]
				,[proc12]
				,[proc13]
				,[proc14]
				,[proc15]
				,[proc16]
				,[proc17]
				,[proc18]
				,[proc19]
				,[proc20]
			from tblProdLotDetail where mechaserial='{$mecha_serial}'
			and status_mch='AKTIF'
			and ((proc1 not like 'NG' and proc1 not like 'WAITING')
			and (proc2 not like 'NG' and proc2 not like 'WAITING')
			and (proc3 not like 'NG' and proc3 not like 'WAITING')
			and (proc4 not like 'NG' and proc4 not like 'WAITING')
			and (proc5 not like 'NG' and proc5 not like 'WAITING')
			and (proc6 not like 'NG' and proc6 not like 'WAITING')
			and (proc7 not like 'NG' and proc7 not like 'WAITING') 
			and (proc8 not like 'NG' and proc8 not like 'WAITING') 
			and (proc9 not like 'NG' and proc9 not like 'WAITING')
			and (proc10 not like 'NG' and proc10 not like 'WAITING')
			and (proc11 not like 'NG' and proc11 not like 'WAITING')
			and (proc12 not like 'NG' and proc12 not like 'WAITING')
			and (proc13 not like 'NG' and proc13 not like 'WAITING')
			and (proc14 not like 'NG' and proc14 not like 'WAITING')
			and (proc15 not like 'NG' and proc15 not like 'WAITING')
			and (proc16 not like 'NG' and proc16 not like 'WAITING') 
			and (proc17 not like 'NG' and proc17 not like 'WAITING') 
			and (proc18 not like 'NG' and proc18 not like 'WAITING')
			and (proc19 not like 'NG' and proc19 not like 'WAITING')
			and (proc20 not like 'NG' and proc20 not like 'WAITING'))
		";
		// return $query;
		$statement = $this->conn->prepare($query);
		$statement->execute();
		$result = $this->get($statement);
		if(count( $result) == 0){
			return [];
		}
		// only return the first index
		return $result[0];
	}

	private function get(PDOStatement $query ){
		$result = [];
		while ($row = $query->fetch(PDO::FETCH_ASSOC) ) {
			$newRow = [];
			foreach ($row as $key => $value) {
				$newRow[$key] = trim( $value);
			}
			$result[] = $newRow;
		}
		return $result;
	}
}