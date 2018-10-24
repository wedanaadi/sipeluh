<?php
    include_once("config/database.php");
    class Model extends database
    {
        public function __construct()
        {
            parent:: __construct();
        }

        public function get($table, $where=null, $select = "*")
        {
            $sql = "SELECT $select FROM $table";
            if($where != null)
            {
                $sql .= " WHERE $where";
            }
            $result = $this->connection->query($sql);
            if ($result == false) 
            {
                return $this->connection->error;
            } 
            
            $rows = array();
            
            while ($row = $result->fetch_assoc()) 
            {
                $rows[] = $row;
            }
            
            return $rows;
        }

        public function db_query($sql)
        {
            $result = $this->connection->query($sql);
            if ($result == false) 
            {
                return $this->connection->error;
            } 
            
            $rows = array();
            
            while ($row = $result->fetch_assoc()) 
            {
                $rows[] = $row;
            }
            
            return $rows;
        }

        public function insert($table, $rows=null)
        {
            $sql   = "INSERT INTO $table";
            $row   = null;
            $value = null;

            foreach ($rows as $key => $nilai) 
            {
                $row .= ",".$key;
                $value .= ",'".$nilai."'";
            }
            $sql  .= "(".substr($row,1).")";
            $sql  .= "VALUE(".substr($value,1).")";
            return $this->execute($sql);
            
        }

        public function update($table, $field=null, $where=null)
        {
            $sql = "UPDATE $table SET";
            $set = null;
            foreach ($field as $key => $value) 
            {
                $set .= ", ".$key." = '".$value."'";    
            }
            $sql .= substr($set,1). " WHERE $where";
            return $this->execute($sql);
        }

        public function execute($query) 
        {
            $result = $this->connection->query($query);
            
            if ($result == false) {
                return $this->connection->error;
                // return 'false';
            } else {
                return 'true';
            }		
        }

        public function delete($id, $table) 
        { 
            $query = "DELETE FROM $table WHERE id = $id";
            
            $result = $this->connection->query($query);
        
            if ($result == false) {
                // echo 'Error: cannot delete id ' . $id . ' from table ' . $table;
                return $this->connection->error;
            } else {
                return true;
            }
        }
	
        public function escape_string($value)
        {
            return $this->connection->real_escape_string($value);
        }
    }
?>