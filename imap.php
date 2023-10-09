<?php
// Check for new messages
$mail = "itiolatsiah@hotmail.com";
$password = "l6cSpa588";
$mailbox = imap_open("{outlook.office365.com:993/imap/ssl}INBOX", $mail, $password);

if (!$mailbox) {
    die('Không thể kết nối đến tài khoản IMAP: ' . imap_last_error());
}

// lấy số lượng mail
$check = imap_check($mailbox);

if ($check->Nmsgs > 0) {
    for($index = 1; $index <= $check->Nmsgs; $index++)
    {
        //nếu để 1 thì lấy cái message của nó, 2 thì lấy source, rỗng thì lấy tất cả phần mã hoá
        $html = imap_fetchbody($mailbox, $index, "2");
        $msg = imap_fetchbody($mailbox, $index, "1");
        $html = quoted_printable_decode($html);
        $msg = quoted_printable_decode($msg);
        // echo $html;
        echo $msg;
        echo "---------------------------------------------\n";
    }
} else {
    echo "Không có email mới.";
}

imap_close($mailbox);
?>
