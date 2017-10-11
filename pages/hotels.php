<?php
include_once ('functions.php');
connect();
?>
    <h1>Admin</h1>
    <hr>

    <div class="row">
    <div class="col-md-12">
        <h2>Hotels</h2>
        <div class="form">
            <?php
            echo '<form action="index.php?page=5" method="post">';
            $sel='SELECT ho.id, ho.hotel, ho.stars, ho.cost, ci.city, co.country FROM hotels ho, cities ci, countries co WHERE ho.cityid=ci.id AND ho.countryid=co.id';
            $res=mysql_query($sel);
            echo '<table class="table table-striped">';
            echo '<thead style="font-weight: bold"><td>№</td><td>Hotel</td><td>Stars</td><td>Price</td><td>City</td><td>Country</td><td>Del</td>
       </thead>';

            while ($row=mysql_fetch_array($res))
            {
                echo '<tr>';
                echo '<td>'.$row['id'].'</td><td>'.$row['hotel'].'</td><td>'.$row['stars'].'</td><td>'.$row['cost'].'</td><td>'.$row['city'].'</td><td>'.$row['country'].'</td>';
                echo '<td><input type="checkbox" name="cb'.$row['id'].'"></td>';
                echo '</tr>';
            }

            echo '<tr>';
            echo '<td></td><td></td><td></td><td></td><td></td>';
            echo '<td><div class="text-right"><input type="submit" name="delhotel" value="DEL HOTEL" class="del width3 btn btn-danger"></div></td>';
            echo '</tr>';

            echo '</table>';

            mysql_free_result($res);
            $res=mysql_query('SELECT * FROM countries ORDER BY country');
            $res2=mysql_query('SELECT * FROM cities ORDER BY city');
            ?>
        </div>
    </div>
    <div class="col-md-8">
        <?php
        echo '<div class="form-inline">';
       echo '<select name="countryname" onchange="getCities(this.value)">';
        echo '<option value="0">Select country...</option>';
        while ($row=mysql_fetch_array($res))
        {
            echo '<option value="'.$row['id'].'">'.$row['country'].'</option>';
        }
        echo '</select>';

        echo'<span id="cityid"></span>';

        echo '<input type="text" name="hotel" placeholder="Hotel name" class="inputwidth">';
        echo '<input type="text" name="stars" placeholder="Stars 0.5 - 5" class="inputwidth">';
        echo '<input type="text" name="cost" placeholder="Price" class="inputwidth"><br>';
        echo '<textarea style="width: 100%; height: 100px" name="info" placeholder="Hotel info"></textarea><br>';
        echo '<input type="submit" name="addhotel" value="ADD HOTEL" class="add width3 btn btn-success">';
        echo '</div>';
        echo '</form>';
        if (isset($_POST['addhotel']))
        {
            $hotel=trim(htmlspecialchars($_POST['hotel']));
            if($hotel == "") exit();
            $cityname=$_POST['cityname'];
            $countryname=$_POST['countryname'];
            $hotel_info=$_POST['info'];
            $stars=$_POST['stars'];
            $cost=$_POST['cost'];
            $ins='INSERT INTO hotels (hotel, countryid, cityid, stars, cost, info) 
				VALUES ("'.$hotel.'", "'.$countryname.'", "'.$cityname.'", "'.$stars.'", "'.$cost.'", "'.$hotel_info.'")';
            mysql_query($ins);
            echo '<script>window.location.href=document.URL;</script>';
        }
        if (isset($_POST['delhotel'])) {
            foreach ($_POST as $k => $v) {
                if (substr($k, 0, 2)== "cb")
                {
                    $idc=substr($k, 2);
                    $del='DELETE FROM hotels WHERE id='.$idc;
                    mysql_query($del);
                }
            }
            echo '<script>window.location.href=document.URL;</script>';
        }
        ?>
    </div>
    <div class="col-md-4">
        <form action="index.php?page=5" method="post" enctype="multipart/form-data">
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

        if (isset($_REQUEST['addimage'])) {
            foreach ($_FILES['file']['name'] as $k => $v) {
                if ($_FILES['file']['error'][$k] !=0) {
                    echo '<script>alert("Wrong file size: '.$v.'")</script>';
                    continue;
                }
                if (move_uploaded_file($_FILES['file']['tmp_name'][$k], 'images/hotels/'.$v)) {
                    $ins='INSERT INTO images(hotelid, imagepath) 
						VALUES ('.$_REQUEST['hotelid'].', "images/hotels/'.$v.'")';
                    mysql_query($ins);
                }
            }
        }

        ?>
    </div>

        <script>
            function getCities(countryid)
            {
                if(countryid == "0")
                {
                    document.getElementById('cityid').innerHTML="";
                }

                if(window.XMLHttpRequest)
                {
                    ao=new XMLHttpRequest();
                }
                else
                {
                    ao=new ActiveXObject('Microsoft.XMLHTTP');
                }
                //creating callback function accepting result
                ao.onreadystatechange=function()
                {
                    if(ao.readyState==4 && ao.status==200)
                    {
                        document.getElementById('cityid').
                            innerHTML = ao.responseText;
                    }
                }
                //creating and sending AJAX request
                ao.open('GET',"pages/ajax.php?coid="+countryid,true);//send to ajax.php countryid
                ao.send(null);
            }
        </script>
