<?
  $tablet_size     = "1.0"; // ȭ�� ������ ����
  $url = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ko" xml:lang="ko">
<head>
<title>����ü���ս�������</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<meta http-equiv="Cache-Control" content="No-Cache">
<meta http-equiv="Pragma" content="No-Cache">
<meta name="viewport" content="width=device-width, user-scalable=<?=$tablet_size?>, initial-scale=<?=$tablet_size?>, maximum-scale=<?=$tablet_size?>, minimum-scale=<?=$tablet_size?>">
<link href="css/style.css" rel="stylesheet" type="text/css" id="cssLink"/>
<link href="css/payment.css" type="text/css" rel="stylesheet" />

    <script type="text/javascript">
        function chk_frm()
        {
			var frm = document.order_info;
			if(frm.buyr_name.value ==""){
				alert('������ �Է��� �ּ���.');
			}else if(frm.buyr_mail.value ==""){
				alert('�̸����� �Է��� �ּ���.');
			}else if(frm.buyr_tel1.value ==""){
				alert('��ȭ��ȣ�� �Է��� �ּ���.');
			}else{	
				frm.submit();
			}
		}
		function mny_input()
		{
			var frm = document.order_info;
			var good_mny2 = "";
			if(frm.good_name1.value==190000 && frm.good_name2.value == "Y"){
				good_mny2 = 100000;
			}else if(frm.good_name1.value==50000 && frm.good_name2.value == "Y"){
				good_mny2 = 10000;
			}
			frm.good_mny.value = Number(frm.good_name1.value)+Number(good_mny2);
		}
	</script>
</head>

<body>

<form name="order_info" method="post" action="./order_mobile1.php">
  <!-- Ÿ��Ʋ -->
	<div class="title">
	   ����ü ���� �������� ���
	</div>
	<div class="payform_div">
		<table class="payform_wrap" width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
				<td>
					<table class="payform" width="100%" border="0" cellspacing="0" cellpadding="0" >
						<tr>
							<td>
								<table class="payform_inner" width="100%" align="center" >					
								  <tr>
									<td>
								<!-- �ֹ��ڸ�(buyr_name) -->
										<br/><b>����</b>
										<br/><input type="text" name="buyr_name" class="w100" value=""/>
										
								<!-- �ֹ��� E-mail(buyr_mail) -->
										<br/><b>�̸���</b>
										<br/><input type="text" name="buyr_mail" class="w200" value="" maxlength="30" />
										
								<!-- �ֹ��� ����ó1(buyr_tel1) -->
										<br/><b>��ȭ��ȣ</b>
										<br/><input type="text" name="buyr_tel1" class="w100" value=""/>
								
								<!-- �޴�����ȣ(buyr_tel2) -->
										<br/><b>�޴�����ȣ</b>
										<br/><input type="text" name="buyr_tel2" class="w100" value=""/>
									</td>
								  </tr>
								</table>
							</td>
						</tr>				
					</table>
				</td>
			</tr>		
		</table>
	
		<!-- ���� ��û/ó������ �̹��� -->
		<div class="btnset" id="display_pay_button" style="display:block">
			<div class="paybtn">
				<input name="" type="button"  class="pay_start" value="�� ��" onclick="chk_frm();" />
				<?/*<a href="../" class="back" >ó������</a>	*/?>			
			</div>
		</div>
		<br>
		<div class="footer" style="text-align:center;">
		����ü ���� ��������.
		</div>
	</div>
</form>

						  <!--footer-->
						  <div class="footer">
							Copyright (c) NHN KCP INC. All Rights reserved.
						  </div>
						  <!--//footer-->


</body>
</html>
