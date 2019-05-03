<?php
/* 
	
	Name	:	数据表结构同步工具
	Version	:	1.0 (Build 20180618231223)
	Author	:	Xlch (http://xlch.me/)
	
 */
class dbSyncTool {
	public $mysql = false;
	public $table = [];
	public $syncData = [];
	public $prefix = '';
	public $option = [];
	
	public $log = [];
	public $logSQL = [];

    public function __construct($mysql, $syncData, $option = ''){
		if(!$mysql){
			return false;
		}
		if($mysql && $syncData){
			$this->mysql = $mysql;
			$this->syncData = $syncData;
			$this->option = $option;
			$this->prefix = isset($option['prefix']) ? $option['prefix'] : '';
		}
		
		$this->query("set sql_mode = ''");
		$this->query("set character set 'utf8'");
		$this->query("set names 'utf8'");
		
		if($this->prefix){
			foreach($this->syncData as $key => $value){
				$this->syncData[$this->prefix . $key] = $value;
				unset($this->syncData[$key]);
			}
		}
    }
	public function fix(){
		$this->log[] = '开始进行数据库结构重构...';
		$this->get_table_list();
		$this->fix_table_list();
	}
	private function get_table_list(){
		$this->log[] = '获取数据库中已存在的表...';
		$result = $this->query('show tables;');
		if($row = $this->fetch($result)){
			$tmp = array_keys($row)[0];
			$this->table[] = $row[$tmp];
			$this->log[] = '找到表[' . $row[$tmp] . ']';
			
			while($row = $this->fetch($result)){
				$this->table[] = $row[$tmp];
				$this->log[] = '找到表[' . $row[$tmp] . ']';
			}
		}
	}
	private function fix_table_list(){
		$this->log[] = '开始重构数据表结构...';
		$tmp = array_keys($this->syncData);
		foreach($tmp as $row){
			if(!in_array($row, $this->table)){ //表不存在
				$this->create_table($row);
			}else{
				$this->fix_table($row);
			}
		}
	}
	private function get_id_sql($id,$breakA_I = false){
		$sql = '`'.$id['id'].'` ';
		$sql .= $this->get_id_type($id);
		$sql .= ' ';
		if($id['isNull'] === FALSE){
			$sql .= 'NOT NULL ';
		}
		if($id['default'] !== FALSE && $id['default'] !== null){
			$sql .= 'DEFAULT ' . (substr($id['default'], 0, 1) === '$' ? substr($id['default'], 1, strlen($id['default'])-1) : '\'' . $id['default'] . '\'') . ' ';
		}
		if($breakA_I === false && $id['A_I'] !== FALSE){
			$sql .= 'AUTO_INCREMENT ';
		}
		if(!empty($id['bewrite'])){
			$sql .= 'COMMENT \''.addslashes($id['bewrite']).'\'';
		}
		return $sql;
	}
	private function get_id_type($id){
		$sql = $id['type'];
		if($id['len'] !== FALSE){
			$sql .= '('.$id['len'].')';
		}
		return $sql;
	}
	private function create_table($table){
		$this->log[] = '创建表[' . $table . ']';
		$tableSync = $this->syncData[$table];
		
		$sql = 'CREATE TABLE `'.$table.'` (';
		foreach($tableSync as $i=>$row){
			$sql .= $this->get_id_sql($row);
			if(count($tableSync) - 1 > $i){
				$sql .= ', ';
			}
		}
		foreach($tableSync as $i=>$row){
			if($row['key'] !== false){
				$sql .= ', ';
				$sql .= implode(', ', $this->get_id_key($row));
			}
		}
		$sql .= ') ';
		$sql .= 'ENGINE='.$this->option['ENGINE'].' ';
		$sql .= 'DEFAULT CHARSET='.$this->option['CHARSET'].' ';
		$sql .= 'COLLATE='.$this->option['COLLATE'].';';
		$this->query($sql);
	}
	private function get_id_key($id,$type = 'create'){
		$return = [];
		$keyList = explode(',',$id['key']);
		foreach($keyList as $row){
			switch($row){
				case 'PRI':
					if($type = 'create')
						$return[] = 'PRIMARY KEY (`'.$id['id'].'`)';
					else
						$return[] = 'PRIMARY KEY (`'.$id['id'].'`)';
				break;
				case 'UNI':
					if($type = 'create')
						$return[] = 'UNIQUE KEY (`'.$id['id'].'`)';
					else
						$return[] = 'UNIQUE(`'.$id['id'].'`)';
				break;
				case 'IND':
					if($type = 'create')
						$return[] = 'KEY (`'.$id['id'].'`)';
					else
						$return[] = 'INDEX(`'.$id['id'].'`)';
				break;
				case 'FUL':
					if($type = 'create')
						$return[] = 'FULLTEXT KEY (`'.$id['id'].'`)';
					else
						$return[] = 'FULLTEXT(`'.$id['id'].'`)';
				break;
			}
		}
		return $return;
	}
	private function fix_table($table){
		$this->log[] = '检测表[' . $table . ']';
		$mysqlIds = [];
		$tableSync = $this->syncData[$table];
		
		$result = $this->query('DESC `'.$table.'`;');
		if($result){
			while($row = $this->fetch($result)){
				$mysqlIds[$row['Field']] = $row;
			}
		}
		
		$idList = array_keys($mysqlIds);
		
		$keyType = $this->get_key_type($table);
		foreach($tableSync as $i=>$row){
			if(isset($keyType[$row['id']])){
				$mysqlIds[$row['id']]['Key'] = $keyType[$row['id']];
			}
			
			if(!in_array($row['id'], $idList)){
				$this->fix_id($table, $i, 'add');
			}else if(!$this->id_compare($mysqlIds[$row['id']], $row) or ($i != array_search($row['id'],$idList))){
				$this->fix_id($table, $i, 'fix');
			}
		}
	}
	private function get_key_type($table){
		$tableSync = $this->syncData[$table];
		$return = [];
		
		$result = $this->query('SHOW INDEX FROM `'.$table.'`');
		if($result){
			while($row = $this->fetch($result)){
				if($row['Key_name'] == 'PRIMARY'){
					$return[$row['Column_name']][] = 'PRI';
				}else if($row['Key_name'] != 'PRIMARY' && $row['Non_unique'] == '0' && $row['Index_type'] == 'BTREE'){
					$return[$row['Column_name']][] = 'UNI';
				}else if($row['Key_name'] != 'PRIMARY' && $row['Non_unique'] == '1' && $row['Index_type'] == 'BTREE'){
					$return[$row['Column_name']][] = 'IND';
				}else if($row['Key_name'] != 'PRIMARY' && $row['Non_unique'] == '1' && $row['Index_type'] == 'FULLTEXT'){
					$return[$row['Column_name']][] = 'FUL';
				}
			}
		}
		
		foreach($return as $i=>$row){
			sort($row);
			$return[$i] = implode(',',$row);
		}

		return $return;
	}
	private function id_compare($mysqlId, $SyncId){
		
		$return = (
			($mysqlId['Type'] === $this->get_id_type($SyncId)) && 
			($mysqlId['Null'] === ($SyncId['isNull'] ? 'YES' : 'NO')) && 
			(($mysqlId['Default'] == NULL ? 'NULL' : $mysqlId['Default']) === (($SyncId['default'] === false or $SyncId['default'] === null) ? 'NULL' : $SyncId['default'])) && 
			(($mysqlId['Extra'] == 'auto_increment') == $SyncId['A_I'])
		);
		
		
		if($return === true){
			$SyncId['key'] = ((!isset($SyncId['key']) or !$SyncId['key']) ? '' : $SyncId['key']);
			$keyList = explode(',',$SyncId['key']);
			sort($keyList);
			$keyList = implode(',',$keyList);
			
			$return = ($mysqlId['Key'] == $keyList);
		}
		return $return;
	}
	private function fix_id($table, $keyIndex, $type = 'add'){
		$idSync = $this->syncData[$table][$keyIndex];
		if($type == 'fix'){
			$this->log[] = '修改表[' . $table . ']字段[' . $idSync['id'] . ']';
			$result = $this->query('SHOW INDEX FROM `'.$table.'` where `Column_name` = \''.$idSync['id'].'\'');
			if($result){
				while($row = $this->fetch($result)){
					$sql = 'DROP INDEX `'.$row['Key_name'].'` ON `'.$table.'`';
					$this->query($sql);
				}
			}
			
			$keyList = $this->get_id_key($idSync, 'add');
			$keyListName = explode(',', $idSync['key']);
			foreach($keyList as $i=>$row){
				if($keyListName[$i] == 'PRI'){
					$sql = 'DROP INDEX `PRIMARY` ON `'.$table.'`';
					$this->query($sql);
				}
				
				$sql = 'ALTER TABLE `'.$table.'` ADD ';
				$sql .= $row;
				$sql .=';';
				$this->query($sql);
			}
			
			$sql = 'ALTER TABLE `'.$table.'` CHANGE `'.$idSync['id'].'` ';
			$sql .= $this->get_id_sql($idSync);
			if($keyIndex !== 0)
				$sql .=' AFTER `'.$this->syncData[$table][$keyIndex - 1]['id'].'`;';
			else
				$sql .=' FIRST;';
			
			$this->query($sql);
		}else if($type == 'add'){
			$this->log[] = '增加表[' . $table . ']字段[' . $idSync['id'] . ']';
			$sql = 'ALTER TABLE `'.$table.'` ADD ';
			$sql .= $this->get_id_sql($idSync);
			$sql .=';';
			
			$this->query($sql);
			
			$this->fix_id($table, $keyIndex, 'fix');
		}
	}
	
	private function query($sql){
		$this->logSQL[] = $sql;
		return mysqli_query($this->mysql, $sql);
	}
	private function fetch($result){
		return mysqli_fetch_assoc($result);
	}
}