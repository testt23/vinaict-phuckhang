<?php
define('BASEPATH', null);
require_once(dirname(__FILE__).'/../config/database.php');

$all_tables = array();
foreach ($db as $key => $db_item) {
	$host_name	= $db[$key]['hostname'];
	$user_name	= $db[$key]['username'];
	$password	= $db[$key]['password'];
	$db_name	= $db[$key]['database'];
	$prefix		= $db[$key]['dbprefix'];
	
	$conn = mysql_connect($host_name,$user_name,$password);
	$seldb = mysql_select_db($db_name, $conn);
	
	$sql='show tables';	
	$result=mysql_query($sql,$conn);

	while($row=mysql_fetch_row($result)) {
		$all_tables[strtolower($row[0])] = strtolower($row[0]);
	}
	
	mysql_close($conn);
}

foreach ($db as $key => $db_item) {
	$host_name	= $db[$key]['hostname'];
	$user_name	= $db[$key]['username'];
	$password	= $db[$key]['password'];
	$db_name	= $db[$key]['database'];
	$prefix		= $db[$key]['dbprefix'];
	
	$tmppwd = '';
	
	for ($i = 0; $i < strlen($password); $i++) {
		$tmppwd .= '*';
	}
	
	echo 'Test database connection ...';
	echo PHP_EOL;
	echo PHP_EOL;
	echo 'Hostname: '.$host_name;
	echo PHP_EOL;
	echo 'Username: '.$user_name;
	echo PHP_EOL;
	echo 'Password: '.$tmppwd;
	echo PHP_EOL;
	echo 'Database: '.$db_name;
	echo PHP_EOL;
	echo 'Prefix: '.$prefix;
	echo PHP_EOL;
	
	$conn = mysql_connect($host_name,$user_name,$password);
	$seldb = mysql_select_db($db_name, $conn);
	
	if (!$conn) {
		echo 'Could not connect database server.';
		echo PHP_EOL;
		echo PHP_EOL;
	}
	elseif (!$seldb) {
		echo 'Database server connected but can not open database \''.$db_name.'\'.';
		echo PHP_EOL;
		echo PHP_EOL;
	}
	else {
		echo 'Connect successful.';
		echo PHP_EOL;
		echo PHP_EOL;
		
		if(!is_dir($db_name))
		{
			mkdir($db_name);
		}
		$c_path=$db_name ."/controllers";
		$m_path=$db_name ."/models";
                $b_path=$db_name ."/business";

		
		if(!is_dir($c_path))
		{
			mkdir($c_path);
		}
		
		if(!is_dir($m_path))
		{
			mkdir($m_path);
		}

                if(!is_dir($b_path))
		{
			mkdir($b_path);
		}
		
		$sql='show tables';
		
		$result=mysql_query($sql,$conn);
                $tables = array();

        while($row=mysql_fetch_row($result))
		{
			$table_name = strtolower($row[0]);
			$tables[$table_name] = array();

			$sql="desc `$table_name`";
			$resultrow=mysql_query($sql,$conn);

			while($fld=mysql_fetch_array($resultrow))
			{
				$tables[$table_name][$fld['Field']] = array();
				$tables[$table_name][$fld['Field']]['Field'] = $fld['Field'];
				$tables[$table_name][$fld['Field']]['Key'] = $fld['Key'];
				$tables[$table_name][$fld['Field']]['Null'] = $fld['Null'];
				$tables[$table_name][$fld['Field']]['Type'] = $fld['Type'];
				$tables[$table_name][$fld['Field']]['Default'] = $fld['Default'];
				$tables[$table_name][$fld['Field']]['Extra'] = $fld['Extra'];
			}

		}

		foreach ($tables as $tbname => $table) {
			//$fname=str_replace($prefix,'',$tbname);
			$fname = substr($tbname, strlen($prefix), strlen($tbname) - strlen($prefix));

			echo 'Creating controller \''.$fname.'_controller.php\''.PHP_EOL;
			$file=fopen($c_path.'/'.$fname.'_controller.php','w+');

			$content="<?php\n\n";
			$content.="\tclass " .ucfirst($fname) . "_controller extends CI_Controller{\n\n";
			$content.="\t\tfunction __construct(){\n";
			$content.="\t\t\tparent::__construct();\n";
			$content.="\t\t\t// Your own construction code here\n";
			$content.="\t\t}\n\n";

			$content.="\t\tfunction index(){\n";
			$content.="\t\t\t// Your own code here\n";
			$content.="\t\t}\n";
			$content.="\n";
			$content.="\t\t// You can place some more methods code here\n";
			$content.="\n";
			$content.="\t}\n";

			fwrite($file,$content);
			fclose($file);

			echo 'Creating model \''.$fname.'_model.php'.'\''.PHP_EOL;
			$file=fopen($m_path.'/'.$fname.'_model.php','w+');
			$content="<?php\n\n";
			$content.="\tclass " .ucfirst($fname) . "_model extends CI_Model {\n\n";

			$table_name=strtolower($prefix.$fname);
			$content.="\t\tprotected \$__tbname = '".$table_name."';\n";
			$content.="\t\tprotected \$__dbconf = '".$key."';\n\n";

			$foreign_keys = array();

			foreach ($table as $field) {
				$content.= "\t\tvar \$".$field['Field'].
                                        (
                                            $field['Default'] == "NULL" || $field['Default'] == "" ? "" : " = ".
                                            (
                                                (
                                                    $field['Default'] == "CURRENT_TIMESTAMP" 
                                                    || strpos($field['Type'], 'varchar') !== FALSE 
                                                    || strpos($field['Type'], 'text') !== FALSE
                                                ) ? ("'".$field['Default']."'") : $field['Default']
                                            )
                                        ).";\t//".$field['Type']."\t".($field['Key'] == 'PRI' ? "Primary Key" : ($field['Key'] == 'UNI' ? "Unique Key" : ""))."\t".($field['Extra'] == "auto_increment" ? "Auto Increment" : "")."\t".($field['Null'] == "YES" ? "NULL" : "NOT NULL")."\n";

				if (substr($field['Field'], 0, 3) == 'id_') {
					if (array_key_exists($prefix.substr($field['Field'], 3, strlen($field['Field']) - 3), $all_tables)) {
						$foreign_keys[] = $field['Field'];
					}
				}
			}
			
			$content.="\n\t\tprotected \$__validation_rule = array(";
			$string_type = array('varchar', 'char');
			$i = 0;
			foreach ($table as $field) {
				if ($i > 0) {
					$content.= ",";
				}
				$content.="\n\t\t\t'".$field['Field']."' => array(";
				$type = explode('(', $field['Type']);
				$ftype = trim($type[0]);
				if (sizeof($type) > 1) {
					$fsize = explode(')', $type[1]);
					$fsize = trim($fsize[0]);
				}
				$content.= ($field['Key'] != "" ? "'key' => '".$field['Key']."', " : "")."'type' => '".$ftype."', ".(in_array($ftype, $string_type) ? "'size' => ".$fsize.", " : "")."'null' => ".($field['Null'] == "YES" ? "TRUE" : "FALSE").($field['Extra'] == "auto_increment" ? ", 'auto_increment' => TRUE" : "").")";
				$i++;
			}
			$content.="\n\t\t);\n";

			if (sizeof($foreign_keys) > 0) {
				$i = 1;
				$content.="\n\t\tprotected \$__relation = array(\n";
				foreach ($foreign_keys as $fkey) {
					$content.="\t\t\tarray('table' => '".substr($fkey, 3, strlen($fkey) - 3)."', 'foreign_key' => '".$fkey."')".($i == sizeof($foreign_keys) ? "\n" : ",\n");
					$i++;
				}
				$content.="\t\t);\n";
			}

			$content.="\t}\n";

			fwrite($file,$content);
			fclose($file);

			$temp_name = explode('_', $fname);
			$temp_name1 = array();

			foreach($temp_name as $tname) {
				$temp_name1[] = ucfirst($tname);
			}
			
			$bname = implode('', $temp_name1);
			echo 'Creating business \''.$bname.'.php'.'\''.PHP_EOL;
			
			$file=fopen($b_path.'/'.$bname.'.php','w+');

			$content="<?php\n\n";
			$content.="\tclass " .$bname . " extends ".ucfirst($fname)."_model {\n\n";
			$content.="\t\tfunction __construct() {\n";
			$content.="\t\t\tparent::__construct();\n";
			$content.="\t\t}\n";
			$content.="\t}\n";

			fwrite($file,$content);
			fclose($file);
		}

		mysql_close($conn);
		echo 'Done.'.PHP_EOL.PHP_EOL;
	}
}

?>