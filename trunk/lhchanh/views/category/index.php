<?php
    while ($category->fetchNext()){   
        echo $category->id . ' - ' . $category->name . '<br>' ;
    }
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
