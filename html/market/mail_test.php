<?
$recipient = "sinenmin@gmail.com";    // �޴� ����� �����ּ�
$subject = "�ȳ��ϼ���";           // ����
$mail_body = "�̹��� �Ͽ��Ͽ� �ð��Ǽ���? ^^";    // ����


$header = "From:postmaster@wizmro.com\n";
$header .= "Content-type:text/html;\n";    // �ؽ�Ʈ Ÿ�� ���� (text/html ���� ���)
$header .= "charset=euc-kr";              // ĳ���� ����

$email = mail($recipient, $subject, $mail_body, $header);    // ���Ϻ�����
if(!$email) {echo "���� ������ ����"; }        // ���� ������ ���н� ���
else{echo "$recipient ���� ������ ����";}
?>
