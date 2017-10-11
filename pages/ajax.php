<?php
include_once('functions.php');
connect();
if(isset( $_GET['coid'] ))
{
    $coid=$_GET['coid'];// get countryid from GET
	$sel='select * from cities where countryid='.$coid;
	$res=mysql_query($sel);
    echo '<select name="cityid" id="cityid" onchange="getHotels(this.value)">';
	echo '<option value="0">select city</option>';
	while ($row=mysql_fetch_array($res,MYSQL_NUM))
    {
		echo '<option value="'.$row[0].'">'.$row[1].'</options>';
	}
	mysql_free_result($res);
}

if(isset( $_POST['cid'] ))
{
	$cid=$_POST['cid'];//get cityid from POST
	$sel='select id, hotel, stars, cost from hotels where cityid='.$cid;
	$res=mysql_query($sel);
	echo '<table class="table table-stripped" id="table1">';
	echo '<thead><tr><th>Hotel</th><th>Cost</th><th>Stars</th><th>Details</th></thead><tbody>';
	while ($row=mysql_fetch_array($res,MYSQL_NUM))
    {
		echo '<tr><td>'.$row[1].'</td><td>'.$row[3].'$</td><td>'.$row[2];
		echo '<td><a href="pages/hotelinfo.php?hotel='.$row[0].'" target="_blank" class="btn btn-primary btn-xs">more info</a></td></tr>';
	}
	echo '</tbody></table>';
	mysql_free_result($res);
}

if(isset( $_POST['cidCom'] ))
{
    $cid=$_POST['cidCom'];//get cityid from POST
    $sel='select id, hotel, stars, cost from hotels where cityid='.$cid;
    $res=mysql_query($sel);

//    echo '<select name="hotelid" id="hotelid" onchange="getHotelid(this.value)">';
    echo '<select name="hotelid" id="hotelid">';
    echo '<option value="0">select hotel</option>';
    while ($row=mysql_fetch_array($res,MYSQL_NUM))
    {
        echo '<option value="'.$row[0].'">'.$row[1].'</options>';
    }
    mysql_free_result($res);
}
?>