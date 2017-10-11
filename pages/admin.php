<?php
session_start();
?>
<?php
if (!isset($_SESSION['radmin']))
{
echo "<h3/><span style='color:red;'>For Administrators Only!
</span><h3/>";
exit();
}
?>

<div class="row">
<div class="col-sm-6 col-md-6 col-lg-6 left">
<!-- section A: for form Countries -->
<?php
include_once ('functions.php');
    connect();
    $sel='select * from countries';
    $res=mysql_query($sel);
//echo '<form action="admin.php"

echo '<form action="index.php?page=6" method="post" class="input-group" id="formcountry">';
echo '<table class="table table-striped">';
while($row=mysql_fetch_array($res,MYSQL_NUM))
{
        echo '<tr>';
        echo '<td>'.$row[0].'</td>';
        echo '<td>'.$row[1].'</td>';
        echo '<td><input type="checkbox"
 name="cb'.$row[0].'"></td>';
        echo '</tr>';
    }
echo '</table>';
mysql_free_result($res);
echo '<input type="text" name="country"
 placeholder="Country">';
echo '<input type="submit" name="addcountry"
 value="Add"
class="btn btn-sm btn-info">';
echo '<input type="submit" name="delcountry"
 value="Delete"
class="btn btn-sm btn-warning">';
echo '</form>';

if (isset($_POST['addcountry']))
{
$country=trim(htmlspecialchars($_POST['country']));
if($country=="") exit();
$ins='insert into countries(country) values("'.$country.'")';
mysql_query($ins);
echo "<script>";
echo "window.location=document.URL;";
echo "</script>";
}
if(isset($_POST['delcountry']))
{
    foreach ($_POST as $k => $v)
    {
        if (substr($k,0,2)=="cb")
        {
            $idc=substr($k,2);
            $del='delete from countries where id='.$idc;
mysql_query($del);
 }
    }
echo "<script>";
 echo "window.location=document.URL;";
echo "</script>";
}
?>
</div>
<div class="col-sm-6 col-md-6 col-lg-6 right">
<!-- section B: for form Cities -->
<?php
echo '<form action="index.php?page=6" method="post" class="input-group" id="formcity">';
$sel='SELECT ci.id, ci.city, co.country
from countries co, cities ci
WHERE ci.countryid=co.id';
$res=mysql_query($sel);
echo '<table class="table table-striped">';
while ($row=mysql_fetch_array($res,MYSQL_NUM))
{
    echo '<tr>';
    echo '<td>'.$row[0].'</td>';
    echo '<td>'.$row[1].'</td>';
    echo '<td>'.$row[2].'</td>';
    echo '<td><input type="checkbox"
 name="ci'.$row[0].'"></td>';
    echo '</tr>';
}
echo '</table>';
mysql_free_result($res);
$res=mysql_query('select * from countries');
echo '<select name="countryname" class="form-control">';
while ($row=mysql_fetch_array($res,MYSQL_NUM))
{
    echo '<option value="'.$row[0].'">'.
        $row[1].'</option>';
}
echo '</select>';
echo '<input type="text" name="city"  placeholder="City">';
echo '<input type="submit" name="addcity"  value="Add" class="btn btn-sm btn-info">';
echo '<input type="submit" name="delcity" value="Delete" class="btn btn-sm btn-warning">';
echo '</form>';

if(isset($_POST['addcity']))
{
$city=trim(htmlspecialchars($_POST['city']));
if ($city=="") exit();
$countryid=$_POST['countryname'];
$ins='insert into cities (city,countryid) values ("'.$city.'",'.$countryid.')';
mysql_query($ins);
$err=mysql_errno();
if ($err)
{
    echo 'Error code:'.$err.'<br>';
    exit();
}
echo "<script>";
echo "window.location=document.URL;";
echo "</script>";
}

if(isset($_POST['delcity']))
{
    foreach ($_POST as $k => $v)
    {
        if (substr($k,0,2)=="ci")
        {
            $idc=substr($k,2);
            $del='delete from cities where  id='.$idc;
            mysql_query($del);
        }
    }
echo "<script>";
echo "window.location=document.URL;";
echo "</script>";
 }
?>

</div>
</div>
<hr/>
<div class="row">
<div class="col-sm-6 col-md-6 col-lg-6 left">
<!-- section C: for form Hotels -->
<?php
echo '<form action="index.php?page=6" method="post" class="input-group" id="formhotel">';
$sel='SELECT ci.id, ci.city,
ho.id, ho.hotel, ho.cityid, ho.countryid,
 ho.stars, ho.info,
co.id, co.country
from cities ci, hotels ho, countries co
WHERE ho.cityid=ci.id and ho.countryid=co.id';
$res=mysql_query($sel);
$err=mysql_errno();
echo '<table class="table" width="100%">';
while ($row=mysql_fetch_array($res,MYSQL_NUM))
{
    echo '<tr>';
    echo '<td>'.$row[2].'</td>';
    echo '<td>'.$row[1]."-".$row[9].'</td>';
    echo '<td>'.$row[3].'</td>';
    echo '<td>'.$row[6].'</td>';
    echo '<td><input type="checkbox"
 name="hb'.$row[2].'"></td>';
    echo '</tr>';
}
echo '</table>';
mysql_free_result($res);
$sel='SELECT ci.id, ci.city, co.country, co.id
from countries co, cities ci
WHERE ci.countryid=co.id';
$res=mysql_query($sel);
$csel=array();
echo '<select name="hcity" class="">';
while ($row=mysql_fetch_array($res,MYSQL_NUM))
{
    echo '<option value="'.$row[0].'">'.$row[1]."
 : ".$row[2].'</option>';
    $csel[$row[0]]=$row[3];
}
echo '</select>';
echo '<input type="text" name="hotel" placeholder="Hotel">';
echo '<input type="text" name="cost" placeholder="Cost">';
echo '&nbsp;&nbsp;Stars: <input type="number" name="stars" min="1" max="5">';
echo '<br><textarea rows="5" cols="100" name="info" placeholder="Description">';
echo '</textarea><br>';
echo '<input type="submit" name="addhotel" value="ADD" class="btn btn-sm btn-info">';
echo '<input type="submit" name="delhotel" value="DEL" class="btn btn-sm btn-warning">';
echo '</form>';
mysql_free_result($res);

if(isset($_POST['addhotel']))
{
$hotel=trim(htmlspecialchars($_POST['hotel']));
$cost=intval(trim(htmlspecialchars($_POST['cost'])));
$stars=intval($_POST['stars']);
$info=trim(htmlspecialchars($POST['info']));
if ($hotel==""||$cost==""||$stars=="")     exit();
$cityid=$_POST['hcity'];
$countryid=$csel[$cityid];
$ins='insert into hotels (hotel,cityid,countryid,stars,cost,info) values("'.$hotel.'",'.$cityid;
$ins.=",".$countryid.','.$stars.','.$cost.',"'.$info;
    $ins.='")';
mysql_query($ins);
echo "<script>";
echo "window.location=document.URL;";
echo "</script>";
}
if(isset($_POST['delhotel']))
{
    foreach ($_POST as $k => $v) {
        if (substr($k,0,2)=="hb")
        {
            $idc=substr($k,2);
            $del='delete from hotels where
 id='.$idc;
            mysql_query($del);
if ($err)
{
    echo 'Error code:'.$err.'<br>';
    exit();
}
 }
    }
echo "<script>";
echo "window.location=document.URL;";
echo "</script>";
}
?>

</div>

    <div class="col-sm-6 col-md-6 col-lg-6 right">
        <!-- section D: for form Images -->
        <form action="index.php?page=6" method="post" enctype="multipart/form-data">
            <select name="hotelid">
                <?php

                $sel = 'SELECT ho.id, co.country, ci.city, ho.hotel 
					FROM countries co, cities ci, hotels ho 
					WHERE co.id=ho.countryid AND ci.id=ho.cityid 
					ORDER BY co.country';
                $res=mysql_query($sel);
                while ($row=mysql_fetch_array($res, MYSQL_NUM))
                {
                    echo '<option value="'.$row[0].'">';
                    echo $row[1].'&nbsp; | &nbsp;'.$row[2].'&nbsp; | &nbsp;'.$row[3].'</option>';
                }
                mysql_free_result($res);
                ?>
            </select>
            <input type="file" multiple accept="image/*" name="file[]">
            <input type="submit" name="addimage" value="ADD IMAGES" class="add width2 btn btn-info">
        </form>
        <?php

        if (isset($_REQUEST['addimage']))
        {
            foreach ($_FILES['file']['name'] as $k => $v)
            {
                if ($_FILES['file']['error'][$k] !=0)
                {
                    echo '<script>alert("Wrong file size: '.$v.'")</script>';
                    continue;
                }
                if (move_uploaded_file($_FILES['file']['tmp_name'][$k], 'images/hotels/'.$v))
                {
                    $ins='INSERT INTO images(hotelid, imagepath) VALUES ('.$_REQUEST['hotelid'].', "images/hotels/'.$v.'")';
                    mysql_query($ins);
                }
            }
        }

        ?>
    </div>
</div>