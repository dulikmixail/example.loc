<?



#����

$a = $_REQUEST['a'];
$id_page = $_REQUEST['id_page'];

#���������� �������� � ����
if($a=='addpage'){
	$query = mysql_query("SELECT * FROM tbl_menu WHERE id_page='" .$id_page. "'");
	if(mysql_num_rows($query)==0&&$id_page){
		$query = mysql_query("SELECT PageName, PageTitle, isuser FROM tbl_page WHERE PageID='" .$id_page. "'");
		$PageName = mysql_result($query, '0', 'PageName');
		$PageTitle = mysql_result($query, '0', 'PageTitle');
		$isuser = mysql_result($query, '0', 'isuser');
		if($isuser){
			$PageName = '/pages/'.$PageName;
			}
		$query = mysql_query("INSERT INTO tbl_menu SET id_page='" .$id_page. "', pos='0', link='" .$PageName. "', name='" .$PageTitle. "'");
		}
	}
#�������������� �������
if($a=='edit'){
	$query = mysql_query("SELECT * FROM tbl_menu");
	while($result = mysql_fetch_array($query)){
		$query2 = mysql_query("UPDATE tbl_menu SET pos='" .$_REQUEST['pos'.$result['id_page']]. "', link=(SELECT PageName FROM tbl_page WHERE PageID='" .$result['id_page']. "') WHERE id_page='" .$result['id_page']. "'");
		}
	}
#�������� �������
if($a=='del'){
	$query = mysql_query("DELETE FROM tbl_menu WHERE id_page='" .$id_page. "'");
	}

#������� �������� � ����
$i=0;
$query = mysql_query("SELECT *, (SELECT PageTitle FROM tbl_page WHERE tbl_page.PageID=tbl_menu.id_page) AS name FROM tbl_menu ORDER BY pos");
while($result = mysql_fetch_array($query)){
	$i++;
	if($i%2){$cls=" class=TableRow1";}else{$cls=" class=TableRow2";}
	$list_fotmenu .= '
	<tr height=20>
		<td ' .$cls. '><input class="txt" style="width: 30px;" type="text" name="pos' .$result['id_page']. '" value="' .$result['pos']. '"> ' .$result['name']. '</td>
		<td align="center" ' .$cls. ' nowrap><a class=Table href="/adm/menu?a=del&id_page=' .$result['id_page']. '" onClick="return confirm(\'�� �������, ��� ������ ������� �������� �� ����?\')"><img border="0"  title="�������" src="/cfg/adm/img/del.png" width=11 height=10></a></td>	
	</tr>';
	}
if(!$list_fotmenu){
	$list_fotmenu = '
	<tr height=20>
		<td colspan="2">�� ��������� �������</td>
	</tr>
	';
	}

#������� ������ �������
$query = mysql_query("SELECT * FROM tbl_page WHERE PageID NOT IN (SELECT id_page FROM tbl_menu) ORDER BY PageTitle");
while($result = mysql_fetch_array($query)){
	$list_pages .= '<option value="' .$result['PageID']. '">' .$result['PageTitle']. '</option>';
	}








?>