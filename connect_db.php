<!-- 參考資料: 
	PHP mysql_ 的指令表
	http://www.ncu.edu.tw/~center23/mysql/mysql_co.htm
-->

<?php
/********** 連結資料庫 **********/
require_once("db_info.php"); //連結db_info.php裡的變數，讀取連結資料庫資訊
$db = mysql_connect($DB_SERV,$DB_USER,$DB_PASS) or die("Uh~OH~資料庫連結失敗");
print "SQL連結成功<br><br>";
 
//********** 顯示所有資料庫 **********
//PS. 有些免費網頁空間會不讓我執行"show databases"指令
print "目前有的資料庫: <br>";
$db_showdatabases = mysql_query("show databases") or die(mysql_error());
while($db_showdatabases_row = mysql_fetch_array($db_showdatabases))
{
	print $db_showdatabases_row[0]."<br />";
}

//********** 指定這個資料庫 **********
mysql_select_db($DB_NAME,$db); //指定這個資料庫
//mysql_query("use ".$DB_NAME); //指定這個資料庫（另一種寫法）

//********** 顯示所有資料表 **********
print "目前有的資料表: <br>";
$db_showtables = mysql_query("show tables") or die(mysql_error());
while($db_showtablesrow = mysql_fetch_array($db_showtables)) //mysql_fetch_array: 取得這一行的資料到$db_showtablesrow陣列
{
	print $db_showtablesrow[0]."<br />";
}

//********** 顯示這個資料表的欄位 **********
print "資料表欄位1: <br>";
//寫法1: 
$db_table = mysql_query("desc ".$DB_FORM) or die(mysql_error());
while($db_tablecol = mysql_fetch_array($db_table))
{
	print $db_tablecol[0]."&nbsp;&nbsp;&nbsp;&nbsp;"; //顯示Field
	print $db_tablecol[1]."&nbsp;&nbsp;&nbsp;&nbsp;"; //顯示Type
	print $db_tablecol[2]."&nbsp;&nbsp;&nbsp;&nbsp;"; //顯示Null
	print $db_tablecol[3]."&nbsp;&nbsp;&nbsp;&nbsp;"; //顯示Key
	print $db_tablecol[4]."&nbsp;&nbsp;&nbsp;&nbsp;"; //顯示Default
	print $db_tablecol[5]."<br />"; //顯示Extra
}
//寫法2: 
//參考資料: http://www.php5.idv.tw/modules.php?mod=books&act=show&shid=451 mysql_fetch_field --- 取得欄位資訊
print "資料表欄位2: <br>";
$db_table = mysql_query("SELECT * FROM ".$DB_FORM) or die(mysql_error());
while($db_tablecol = mysql_fetch_field($db_table))
{
	print $db_tablecol->name.",&nbsp;&nbsp;&nbsp;&nbsp;"; //顯示Field
	print $db_tablecol->type.",&nbsp;&nbsp;&nbsp;&nbsp;"; //顯示Type
	print $db_tablecol->max_length.",&nbsp;&nbsp;&nbsp;&nbsp;"; //欄位的最大長度
	print $db_tablecol->not_null.",&nbsp;&nbsp;&nbsp;&nbsp;"; //1表示欄位不能為空(null)的
	print $db_tablecol->primary_key.",&nbsp;&nbsp;&nbsp;&nbsp;"; //1表示欄位是主要鍵(primary key)
	print $db_tablecol->unique_key.",&nbsp;&nbsp;&nbsp;&nbsp;"; //1表示欄位是唯一鍵(unique key)
	print $db_tablecol->multiple_key.",&nbsp;&nbsp;&nbsp;&nbsp;"; //1表示欄位非唯一鍵(non-unique key)
	print $db_tablecol->numeric.",&nbsp;&nbsp;&nbsp;&nbsp;"; //1表示欄位為數值的
	print "<br />";
}
	print "<br />";

//********** 顯示這個資料表的內容 **********
//參考資料: http://www.php5.idv.tw/bb-2382.htm mysql_fetch_array   如何在輸入查詢值後顯示多筆資料出來
print "資料表內容: <br>";
$db_table = mysql_query("SELECT * FROM ".$DB_FORM) or die(mysql_error());
//print mysql_fetch_lengths($db_table);
//print mysql_num_fields($db_table);
while($db_tablerow = mysql_fetch_array($db_table))
{
	//寫法1: 
	/*print $db_tablerow[$DB_FROM_1COL]."&nbsp;&nbsp;&nbsp;&nbsp;"; //陣列變數的[]處，也可以填入"資料表的欄位名稱"
	print $db_tablerow[1]."&nbsp;&nbsp;&nbsp;&nbsp;";
	print $db_tablerow[2]."&nbsp;&nbsp;&nbsp;&nbsp;";
	print $db_tablerow[3]."&nbsp;&nbsp;&nbsp;&nbsp;";
	print $db_tablerow[4]."&nbsp;&nbsp;&nbsp;&nbsp;";
	print $db_tablerow[5]."&nbsp;&nbsp;&nbsp;&nbsp;";
	print $db_tablerow[6]."&nbsp;&nbsp;&nbsp;&nbsp;";
	print $db_tablerow[7]."&nbsp;&nbsp;&nbsp;&nbsp;";
	print $db_tablerow[8]."&nbsp;&nbsp;&nbsp;&nbsp;";
	print $db_tablerow[9]."&nbsp;&nbsp;&nbsp;&nbsp;";
	print $db_tablerow[10]."&nbsp;&nbsp;&nbsp;&nbsp;";
	print $db_tablerow[11]."<br />";*/
	
	//寫法2:
	for($i=0; $i<mysql_num_fields($db_table);$i++){
		print $db_tablerow[$i].",&nbsp;&nbsp;&nbsp;&nbsp;";
	}
	print "<br />";
}

//********** 中斷資料庫 **********
print "<br>";
if(mysql_close($db)){print "成功中斷";}
else{print "中斷失敗";};
?>
