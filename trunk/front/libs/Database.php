<?php
class Database 
 {

     var $_connection;
 
    function __construct()
    {


    }
    function __destruct()
    {
        
    }    
    function &getDatabase()
    {
        static $Db;
        if(!isset($Db)){ $Db = new Database(); }
        return $Db;
    }
    function removeCharSpec($ten)
    {
        return addslashes(mysql_escape_string($ten));
    }  
    function query($sql)
    { 
       	
       $this->_connection =  mysql_connect(DB_HOST, DB_USER, DB_PASS,true,65536);
       mysql_select_db(DB_NAME, $this->_connection);
       mysql_query("SET NAMES 'UTF8'",$this->_connection); 
       return mysql_query($sql,$this->_connection);
    }  
    function getList($sql)
    {

        $arr = array();
		$o = $this->query($sql)  ;
    	   if(is_resource($o)){ 
               	while($row = mysql_fetch_object($o))
        		{
        			$arr[] =  $row;
        		}
                 mysql_free_result($o);
                 if(is_resource($this->_connection))
                {
                    mysql_close($this->_connection);
                }
                
                 return $arr;
    	   }else{ return ''; }
    }
    function getObject($sql)
    {

        $arr = "";
		$o = $this->query($sql)  ;
        $s= "";
        $arr = array(); 
        if(is_resource($o))
        {
                while($row = mysql_fetch_object($o))
        		{
        			$arr[] =  $row;
        		}   
                mysql_free_result($o); 
                if(is_resource($this->_connection))
                {
                    mysql_close($this->_connection);
                }
                if(!empty($arr))
                {
                     $s = $arr[0];
                }
        }else{
           $s =$o;
        }
        return $s ;
  
    }
 }

?>