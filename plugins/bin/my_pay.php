<?


if(!$_SESSION['user_id']){
header('Location: /client/enter');
exit();
}


$id = $_REQUEST['id'];
 
$query = mysql_query("select * from tbl_user where id='" .$_SESSION['user_id']. "'");
$result = mysql_fetch_array($query);

$a = $_REQUEST['a'];
$unn = $result['unn'];
$dogovor = $result['dogovor'];
$name = stripslashes($result['name']);
$email = $result['email'];
$company = stripslashes($result['company']);
$pass = $result['pass'];
$login = $result['login'];
$phone = $result['phone'];
$city = $result['city'];
$adress = $result['adress'];
$bank_code = $result['bank_code'];
$bank_name = $result['bank_name'];
$bank_adress = $result['bank_adress'];
$bank_schet = $result['bank_schet'];



$query = mysql_query("SELECT * FROM tbl_orders WHERE id='" .$id. "'");
$result = mysql_fetch_array($query);
$date_add = date("d.m.Y", strtotime($result['date_add']));
#$num_dogovor = date("d", strtotime($result['date_add'])).date("m", strtotime($result['date_add'])).date("y", strtotime($result['date_add'])).$id;
$num_dogovor = $unn;

$barcode = substr('0000000000', 0, 13-strlen($num_dogovor)).$num_dogovor;


$total_summ = 0;
$total_count = 0;

$query2 =  mysql_query("SELECT *,
	(SELECT tbl_products.name FROM tbl_products WHERE tbl_products.id=tbl_orders_details.id_product) AS product_name FROM tbl_orders_details WHERE id_order='" .$id. "'");
while($result2 = mysql_fetch_array($query2)){
	$total_summ += $result2['total_price'];
	$total_count += $result2['product_count'];
	$result2['total_price_nds'] = round($result2['total_price']*1.2);
	$result2['nds'] = $result2['total_price_nds']-$result2['total_price'];
	$content_orders .= "
	<tr style='mso-yfti-irow:1;height:3.65pt'>
	  <td width=180 nowrap valign=bottom style='width:134.95pt;border-top:none;
	  border-left:solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;
	  border-right:none;mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:
	  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-bottom-alt:
	  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:3.65pt'>
	  <p class=MsoNormal><span style='font-size:10.0pt;mso-ansi-language:RU'>" .$result2['product_name']. "</span><span style='font-size:10.0pt;
	  mso-ansi-language:RU'><o:p></o:p></span></p>
	  </td>
	  <td width=76 nowrap valign=bottom style='width:2.0cm;border-top:none;
	  border-left:solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;
	  border-right:none;mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:
	  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-bottom-alt:
	  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:3.65pt'>
	  <p class=MsoNormal align=center style='text-align:center'><span class=GramE><span
	  lang=EN-US style='font-size:10.0pt'>��</span></span><span lang=EN-US
	  style='font-size:10.0pt'>.<o:p></o:p></span></p>
	  </td>
	  <td width=57 nowrap valign=bottom style='width:42.5pt;border-top:none;
	  border-left:solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;
	  border-right:none;mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:
	  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-bottom-alt:
	  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:3.65pt'>
	  <p class=MsoNormal align=center style='text-align:center'><span lang=EN-US
	  style='font-size:10.0pt'>" .$result2['product_count']. "<o:p></o:p></span></p>
	  </td>
	  <td width=114 nowrap valign=bottom style='width:85.2pt;border-top:none;
	  border-left:solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;
	  border-right:none;mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:
	  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-bottom-alt:
	  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:3.65pt'>
	  <p class=MsoNormal align=center style='text-align:center'><span lang=EN-US
	  style='font-size:10.0pt'>" .$result2['price']. "<o:p></o:p></span></p>
	  </td>
	  <td width=72 nowrap valign=bottom style='width:54.0pt;border-top:none;
	  border-left:solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;
	  border-right:none;mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:
	  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-bottom-alt:
	  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:3.65pt'>
	  <p class=MsoNormal align=center style='text-align:center'><span lang=EN-US
	  style='font-size:10.0pt'>" .$result2['total_price']. "<o:p></o:p></span></p>
	  </td>
	  <td width=126 nowrap valign=bottom style='width:94.7pt;border-top:none;
	  border-left:solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;
	  border-right:none;mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:
	  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;mso-border-bottom-alt:
	  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:3.65pt'>
	  <p class=MsoNormal align=center style='text-align:center'><span lang=EN-US
	  style='font-size:10.0pt'>" .$result2['nds']. "<o:p></o:p></span></p>
	  </td>
	  <td width=105 nowrap valign=bottom style='width:79.0pt;border:solid windowtext 1.0pt;
	  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
	  padding:0cm 5.4pt 0cm 5.4pt;height:3.65pt'>
	  <p class=MsoNormal align=center style='text-align:center'><span lang=EN-US
	  style='font-size:10.0pt'>" .$result2['total_price_nds']. "<o:p></o:p></span></p>
	  </td>
	 </tr>
	";
	}


$total_summ_nds = round($total_summ*1.2);
$total_nds = $total_summ_nds-$total_summ;

$mt = new ManyToText();
$total_summ_text = $mt->Convert($total_summ_nds);
$total_nds_text = $mt->Convert($total_nds);



class NumToText
{
   var $Mant = array(); // �������� �������
   // � ������� ('�����', '�����', '������')
   // ��� ('����', '�����', '������')
   var $Expon = array(); // �������� ���������
   // � ������� ('�������', '�������', '������')

   function NumToText()
   {
   }

   // ��������� �������� �������
   function SetMant($mant)
   {
      $this->Mant = $mant;
   }

   // ��������� �������� ���������
   function SetExpon($expon)
   {
      $this->Expon = $expon;
   }

   // ������� ���������� ����������� ������ �������� �������
   // ('�������', '��������', '���������') ��� ����� $ins
   // �������� ��� 29 �������� 2 (���������)
   // $ins �������� ��� �����
   function DescrIdx($ins)
   {
      if(intval($ins/10) == 1) // ����� 10 - 19: 10 ���������, 17 ���������
      return 2;
      else
      {
         // ��� ��������� �������� ������� �������
         $tmp = $ins%10;
         if($tmp == 1) // 1: 21 �������, 1 �������
         return 0;
         else if($tmp >= 2 && $tmp <= 4)
         return 1; // 2-4: 62 ��������
         else
         return 2; // 5-9 48 ���������
      }
   }

   // IN: $in - �����,
   // $raz - ������ ����� - 1, 1000, 1000000 � �.�.
   // ������ ������� ����� $in ��������
   // $ar_descr - ������ �������� ������� ('�������', '��������', '���������') � �.�.
   // $fem - ������� �������� ���� ������� ����� (true ��� ������)
   function DescrSot(&$in, $raz, $ar_descr, $fem = false)
   {
      $ret = '';

      $conv = intval($in / $raz);
      $in %= $raz;

      $descr = $ar_descr[ $this->DescrIdx($conv%100) ];

      if($conv >= 100)
      {
         $Sot = array('���', '������', '������', '���������', '�������',
         '��������', '�������', '���������', '���������');
         $ret = $Sot[intval($conv/100) - 1] . ' ';
         $conv %= 100;
      }

      if($conv >= 10)
      {
         $i = intval($conv / 10);
         if($i == 1)
         {
            $DesEd = array('������', '�����������', '����������', '����������',
            '������������', '����������', '�����������', '����������',
            '������������', '������������' );
            $ret .= $DesEd[ $conv - 10 ] . ' ';
            $ret .= $descr;
            // ������������ �����
            return $ret;
         }
         $Des = array('��������', '��������', '�����', '���������', '����������',
         '���������', '�����������', '���������' );
         $ret .= $Des[$i - 2] . ' ';
      }

      $i = $conv % 10;
      if($i > 0)
      {
         if( $fem && ($i==1 || $i==2) )
         {
            // ��� �������� ���� (��� ���� ������)
            $Ed = array('����', '���');
            $ret .= $Ed[$i - 1] . ' ';
         }
         else
         {
            $Ed = array('����', '���', '���', '������', '����',
            '�����', '����', '������', '������' );
            $ret .= $Ed[$i - 1] . ' ';
         }
      }
      $ret .= $descr;
      return $ret;
   }

   // IN: $sum - �����, �������� 1256.18
   function Convert($sum)
   {
      $ret = '';

      // ����� ������ ��������� �������� �� ���������� ������
      // ����� ������ ������������� ������ �������� �����
      $Kop = 0;
      $Rub = 0;

      $sum = trim($sum);
      // ������ ������� ������ �����
      $sum = str_replace(' ', '', $sum);

      // ���� �������������� �����
      $sign = false;
      if($sum[0] == '-')
      {
         $sum = substr($sum, 1);
         $sign = true;
      }

      // ������� ������� �� �����, ���� ��� ����
      $sum = str_replace(',', '.', $sum);

      $Rub = intval($sum);
      $Kop = $sum*100 - $Rub*100;

      if($Rub)
      {
         // �������� $Rub ���������� ������ ������� DescrSot
         // ����� ��������: $Rub %= 1000000000 ��� ���������
         if($Rub >= 1000000000)
         $ret .= $this->DescrSot($Rub, 1000000000,
         array('��������', '���������', '����������')) . ' ';
         if($Rub >= 1000000)
         $ret .= $this->DescrSot($Rub, 1000000,
         array('�������', '��������', '���������') ) . ' ';
         if($Rub >= 1000)
         $ret .= $this->DescrSot($Rub, 1000,
         array('������', '������', '�����'), true) . ' ';

         $ret .= $this->DescrSot($Rub, 1, $this->Mant) . ' ';

         // ���� ���������� �������� ������� ������ �����
         $ret[0] = chr( ord($ret[0]) + ord('A') - ord('a') );
         // ��� ��������� �������������� ������ ����� ������� ������� ������
         // � ����������������� ��������� (��� �������� �������������)
         // $ret[0] = strtoupper($ret[0]);
      }

      // ���� ����� ���� ������������� ������� �����
      if($sign)
      $ret = '-' . $ret;
      return $ret;
   }
}

class ManyToText extends NumToText
{
   function ManyToText()
   {
      $this->SetMant( array('�����', '�����', '������') );
   }
}

class MetrToText extends NumToText
{
   function MetrToText()
   {
      $this->SetMant( array('����', '�����', '������') );
      $this->SetExpon( array('���������', '����������', '�����������') );
   }
}


?>