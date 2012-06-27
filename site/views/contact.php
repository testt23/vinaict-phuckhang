<script language="javascript">
    $(document).ready(function(){
        function trim(str){
            var start = 0;
            var end = str.length;
            while (start < str.length && str.charAt(start) == ' ') start++;
            while (end > 0 && str.charAt(end-1) == ' ') end--;
            return str.substr(start, end-start);
        }
        function KiemTra_Email(value) {
            var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!filter.test(value)) {
                return false;
            }
            return true;
        }
        
</script>

<form method="post" action="" id="form_contact">
    <div id="contact-wrapper">
        <div>
            Xin chào <input type="radio" name="gender" value="0"/> Mr
            <input type="radio" name="gender" value="1"/> Ms
            <input type="radio" name="gender" value="1"/> Mrs
        </div>
        <ul id="ul-contact">
            <li class="item">
                <input type="text" value="Tên" name="name"/>
            </li>
            <li class="item">
                <input type="text" value="Địa chỉ nhận hàng" name="address"/>
            </li>
            <li class="item">
                <input type="text" value="Địa chỉ thanh toán" name="address"/>
            </li>
            <li class="item">
                <input type="text" value="Email" name="email"/>
            </li>
            <li class="item">
                <input type="text" value="Điện thoại" name="phone"/>
            </li>
            <li class="item">
                <input type="text" value="YM!" name="yahoo"/>
            </li>
            <li class="item">
                <input type="text" value="Skype" name="skype"/>
            </li>
            <li>
                <textarea id="description" name="description">Tin nhắn</textarea>
            </li>
            <li style="text-align: right;">
                <input  type="submit" value="Contact" id="bnt_contact"/>
            </li>
        </ul>
    </div>

</form>