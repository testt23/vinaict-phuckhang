<?php

$localhost = "localhost";
$username = "root";
$password = "";
$db_name_ma = "magento";                               // Name database Magento
$db_name_ser = "temp_server";                           // Name database Temp Server

mysql_connect($localhost, $username, '') or die("Could not connect: " . mysql_error());
mysql_select_db($db_name_ma) or die('Could not connect Magento database');
mysql_select_db($db_name_ser) or die('Could not connect temp server database ');


transferData($db_name_ma, $db_name_ser, 'sales_flat_order_temp', 'entity_id');
transferData($db_name_ma, $db_name_ser, 'sales_flat_order_payment_temp', 'entity_id');
transferData($db_name_ma, $db_name_ser, 'sales_flat_order_item_temp', 'item_id');
transferData($db_name_ma, $db_name_ser, 'sales_flat_order_address_temp', 'entity_id');
transferData($db_name_ma, $db_name_ser, 'cataloginventory_stock_item_temp', 'item_id');

//Function transfer database from magento to temp server ( or from temp server to magento )              
function transferData($dbFrom, $dbTo, $nameTable, $primaryKey) {
    $result = mysql_query("SELECT * FROM `$dbFrom`.`$nameTable` where `is_deleted` = '0'");
    if (mysql_num_rows($result) > 0) {
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            $sql = "INSERT INTO `$dbTo`.`$nameTable`( ";
            $value_string = " VALUES (";
            $totalField = count($row);
            $i = 1;
            foreach ($row as $key => $value) {
                if ($totalField > $i) {
                    $sql .= "`$key`, ";
                    $value_string .= "'$value',";
                    $i++;
                } else {
                    $sql.="`$key` )";
                    $value_string .= "'$value' )";
                }
            }

            $sql = $sql . ' ' . $value_string;

            if (mysql_query($sql)) {
                $sql = "UPDATE  `$dbFrom`.`$nameTable` 
                         SET `is_deleted` = '1' 
                         WHERE `$primaryKey` = '$row[$primaryKey]'";

                $temp = mysql_query($sql);
            }
        }

        return TRUE;
    }else
        return FALSE;
}

?>
