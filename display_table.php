<style type="text/css">
	/*參考資料: 
		Data Tables and Cascading Style Sheets Gallery:
			http://icant.co.uk/csstablegallery/tables/36.php
		CSS Table 表格
				http://www.eion.com.tw/Blogger/?Pid=1070
		[藍森林-自由軟件] - 請問這個th屬性是什麼作用？scope="col" 
			http://www.lslnet.com/linux/f/docs1/i46/big5320004.htm
	*/
	table,th,td {
	border: 1px solid #000000;
	border-collapse: collapse;
	}
	th {
	background-color: #e5e5e5;}
	th[scpoe] {
	background-color: #add8e6;
	/*font-weight:bold;*/}
</style>
<?php
/********** 連結資料庫 **********/
require_once("db_info.php"); //連結db_info.php裡的變數，讀取連結資料庫資訊
$db = mysql_connect($DB_SERV,$DB_USER,$DB_PASS) or die(mysql_error());
 
//********** 指定這個資料庫 **********
mysql_select_db($DB_NAME,$db); //指定這個資料庫

//********** 顯示這個資料表的內容 **********
print "資料表內容: <br>";
print "<table>";
$db_table = mysql_query("SELECT * FROM ".$DB_FORM) or die(mysql_error());
print "<thead>";
print "<tr>";
while($db_tablecol = mysql_fetch_field($db_table))
{
	print "<th scpoe='col'>";
	print $db_tablecol->name; //顯示Field
	print "</th>";
}
print "</tr>";
print "</thead>";
print "<tbody>";
while($db_tablerow = mysql_fetch_array($db_table))
{
	/*//寫法1: 
	print "<tr>";
	print "<th scrope='row'>".$db_tablerow[$DB_FROM_1COL]."</th>"; //陣列變數的[]處，也可以填入"資料表的欄位名稱"
	print "<td>".$db_tablerow[1]."</td>";
	print "<td>".$db_tablerow[2]."</td>";
	print "<td>".$db_tablerow[3]."</td>";
	print "<td>".$db_tablerow[4]."</td>";
	print "<td>".$db_tablerow[5]."</td>";
	print "<td>".$db_tablerow[6]."</td>";
	print "<td>".$db_tablerow[7]."</td>";
	print "<td>".$db_tablerow[8]."</td>";
	print "<td>".$db_tablerow[9]."</td>";
	print "<td>".$db_tablerow[10]."</td>";
	print "<td>".$db_tablerow[11]."</td>";
	print "</tr>";*/
	
	//寫法2:
	print "<tr>";
	print "<th scrope='row'>";
	print $db_tablerow[0];
	print "</th>";
	for($i=1; $i<mysql_num_fields($db_table);$i++){
		print "<td>";
		print $db_tablerow[$i]."&nbsp;";
		print "</td>";
	}
	print "</tr>";
}
print "<tbody>";
print "</table>";


//********** 中斷資料庫 **********
print "<br>";
if(!mysql_close($db)){print mysql_error();}
?>
