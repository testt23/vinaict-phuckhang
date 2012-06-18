<?php

class ContactModel extends Model {

    function __construct() {
        parent::__construct();
    }

    public function sendContact() {
        
        require_once('libs/Mailer.php');

        if (isset($_POST['submit-form'])) {
           // $general = $_POST['general'];
            $name = $_POST['name'];
            $address = $_POST['address'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $noidung = $_POST['noidung'];
            
            Session::init();
            if (Session::isHave('giohang')) {
                $tieude = SMTP_TITLE_BUY;
            } else {
                $tieude = SMTP_TITLE;
            }
            $tieude = $name . ' : ' . $tieude;

            $s = '<div style="">
    <div style=" text-align: left;">
        <strong>HỌ TÊN</strong>:  '.$name.' <br/>
        <strong>ĐỊA CHỈ</strong>: '.$address.' <br/>
        <strong>EMAIL</strong>: '.$email.'<br/>
        <strong>ĐIỆN THOẠI</strong>: '.$phone.'<br/>
        <strong>NỘI DUNG</strong>: '.$noidung.'<br/>
    </div>';
            Session::init();
            if (Session::isHave('giohang')):
                $s .= '<div style="margin-top: 30px;">
            <table>
                <tr>
                    <td>TÊN SẢN PHẨM</td>
                    <td>MÃ SẢN PHẨM</td>
                    <td>SỐ LƯỢNG</td>
                </tr>';
                $giohang = Session::get('giohang');
                foreach ($giohang as $item):
                    $s .= '<tr>
                <td>' . $item->getMasanpham() . '</td>
                <td>' . getI18n($item->getTensanpham(), 'vi') . '</td>
                <td>' . $item->getSoluong() . '</td>
            </tr>';
                endforeach;
                $s .= '</table>
        </div>';
                
                /*INSERT DATABASE*/
                
                //$SQL = 'insert into ';
                //$Object = $this->Db->getObject($SQL);
                
                /*END INSERT DATABASE*/
            endif;
            $s .= '</div>';

            $mail = new PHPMailer();
            $body = $noidung;
            $mail->IsSMTP();
            $mail->SMTPDebug = 2;                     // enables SMTP debug information (for testing)
            $mail->SMTPAuth = true;                  // enable SMTP authentication
            $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
            $mail->Host = SMTP_HOST;      // sets GMAIL as the SMTP server
            $mail->Port = SMTP_PORT;                   // set the SMTP port for the GMAIL server
            $mail->Username = SMTP_USER;  // GMAIL username
            $mail->Password = SMTP_PASS;            // GMAIL password
            $mail->SetFrom($email, SMTP_DES);
            $mail->AddReplyTo($email, 'Admin');
            $mail->Subject = $tieude;
            $mail->AltBody = '';

            $mail->MsgHTML($s);
            $email;
            $mail->AddAddress($email, $name);

            if (!$mail->Send()) {
                $mail->ErrorInfo;
            } else {
                
            }
            
            
        }
    }

}