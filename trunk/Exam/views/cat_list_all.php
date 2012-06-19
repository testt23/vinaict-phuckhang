<html>

    <head>
    </head>




    <style type="text/css">
        *{margin: 0px; padding: 0px;}
        table tr td{
            padding: 5px 10px;}

        tr.title td{
            background: gray;
            color: white;
        }
        input.button{
            background: scroll;
            color: black;
            border: solid 1px;
            -moz-border-radius: 5px 5px 5px 5px;
            cursor: pointer;

        }
        .hidden{
            display: none;
        }
        #wrapper{
            width: 1000px;
            margin: 0px auto;
        }
        #header{
            height: 100px;
            background: #0000FF;
            color: white;
        }
        #header h1{
            text-align: center;
            padding: 30px 0px 0px 0px;
        }
        .margin-left{
            float:left;
            width: 600px;
        }
        .margin-right{
            float:right;
            width: 390px;
        }
    </style>
    <script language="javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script language="javascript">
        (function($){
            messDelete = function(){
                if (confirm('Ban muoun xoa khong? ')){
                    return true;
                }
                return false;
            }
        })(jQuery);
        (function($){
            showDiv = function(obj, id){
                jQuery('.list-item').slideUp(300);
                jQuery('#' + id).slideDown(300);
                $(obj).hide();
            }
        })(jQuery);
        (function($){
            hideDiv = function( id1,id){
            
                jQuery('#' + id).slideUp(300, function(){
                    jQuery('#' + id1).show();
                });
            }
        })(jQuery);
     (function($){
            messInsert = function(){
                if (jQuery('#insertName').val() == ''){
                    alert('Vui long nhap ten');
                    return false;
                }
                return true;
            }
        })(jQuery);
    
    </script>


    <body>
        <div id="wrapper">
            <div id="header">
                <H1>
                    QUAN LY CATEGORY
                </H1>
            </div>
            <div id="main">
                <div class="margin-left">
                    <table cellspacing="0" cellpadding="0" border="1">
                        <tr class="title">
                            <td ALIGN="CENTER">ID</td>
                            <td ALIGN="CENTER">NAME</td>
                            <td ALIGN="CENTER">DELETE</td>
                            <td ALIGN="CENTER">UPDATE</td>
                        </tr>
                        <?php while ($list->fetchNext()): ?>    
                            <tr>
                                <td><?php echo $list->id; ?></td>
                                <td><?php echo $list->name; ?></td>
                                <td>
                                    <form onsubmit="return messDelete();"  method="post" action="http://localhost/trainning/trunk/Exam/category/cat_delete" style="height: AUTO;">
                                        <input type="hidden" value="<?php echo $list->id; ?>" name="id"/>
                                        <input id="form_delete" type="submit" name="sb_delete" value="Click to Delete" class="button" />
                                    </form>
                                </td>
                                <td align="center">
                                    <input id="tttt<?php echo $list->id; ?>" type="button" value="Click to Update" name="s_update" class="button" onclick="showDiv(this, 'show<?php echo $list->id; ?>' )"/>
                                    <div style="margin: 10px; border: solid 1px gray; padding: 10px;" id="show<?php echo $list->id; ?>" class="hidden list-item" >

                                        <form method="post" action="http://localhost/trainning/trunk/Exam/category/cat_update" style="height: AUTO;">
                                            <input type="hidden" value="<?php echo $list->id; ?>" name="id"/>
                                            <input type="text" style="text-align:center;" value="<?php echo $list->name; ?>" name="name"/>
                                            <input type="submit" name="sub_update" value="Update" class="button"/>
                                            <input type="button" name="bnt_update" value="Cancel" class="button" onclick="hideDiv('tttt<?php echo $list->id; ?>','show<?php echo $list->id; ?>');"/>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </table>
                </div>
                <div class="margin-right">

                    <h2>INSERT DATABASE</h2>

                    <form method="post" action="http://localhost/trainning/trunk/Exam/category/cat_insert">
                        Name: <input id="insertName" type="text"    name="name" value=""/> <br/>
                        <br/>
                        <input onclick="return messInsert();" type="submit" name="sub_insert" value="Click to Insert" class="button"/>
                    </form>
                </div>
            </div>

        </div>
    </body>
</html>