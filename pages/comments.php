<form action="index.php?page=2" method="post">
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
<?php
        echo '<div id="comment"><br><input type="text" name="yourname" placeholder="Your name" class="inputwidth"><br>';
        echo '<textarea style="width: 50%; height: 100px" name="comment" placeholder="Your comment"></textarea><br>';
        echo '<input type="submit" name="addcomment" value="Add comment" class="add width btn btn-success">';

?>
</form>
<?php
if (isset($_REQUEST['addcomment']))
{
    connect();
    $yourname = trim(htmlspecialchars($_POST['yourname']));

    $comment=trim(htmlspecialchars($_POST['comment']));

    $comment=$yourname.': '.$comment;

    $hotelid = $_REQUEST['hotelid'];//true

    if ($comment=="")
    {
        exit();
    }

    $ins='INSERT INTO Comments (hotelid,comment) VALUES ('.$_REQUEST['hotelid'].','.$comment.')';

    mysql_query($ins);
}
?>