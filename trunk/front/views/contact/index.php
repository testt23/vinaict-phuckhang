<form method="post" action="<?php echo URL; ?>/contact/send">
    <table width="400" cellspacing="30" id="form">
        <tr>
            <td>Xin chào</td>
            <td id="contact-table">
                <input type="radio" value="mr" name="general"/> 
                Mr
                <input type="radio" value="mrs" name="general" /> 
                Mrs
                <input type="radio" value="miss" name="general" /> 
                Miss</td>
        </tr>
        <tr>
            <td colspan="2">vui lòng điền thông tin của bạn vào đây.</td>
        </tr>

        <tr>
            <td>HỌ TÊN</td>
            <td><input type="text" name="name" value="" /></td>
        </tr>
        <tr>
            <td>ĐỊA CHỈ</td>
            <td><input type="text" name="address" value=""/></td>
        </tr>
        <tr>
            <td>EMAIL</td>
            <td><input type="text" name="email" value="" /></td>
        </tr>
        <tr>
            <td>SỐ ĐIỆN THOẠI</td>
            <td><input type="text" name="phone" value=""/></td>
        </tr>
        <tr>
            <td>NỘI DUNG</td>
            <td>
                <textarea name="noidung" style="border: solid 1px;"></textarea>
            </td>
        </tr>
        <tr >
            <td colspan="2" align="center" style="text-align: center;" >
                <input class="button-s" type="reset" value="Nhập lại" name="reset-form" />
                <input class="button-s" type="submit" value="Gữi" name="submit-form" style="margin-left: 20px;" />
            </td>
        </tr>
    </table>
</form>