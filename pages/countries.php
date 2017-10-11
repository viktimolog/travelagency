<h1>Admin</h1>
<hr>
<div class="row">
	<div class="left col-md-6">
		<h2>Countries</h2>
		<div class="form">
			<?php 
			connect();
			$sel='SELECT * FROM countries ORDER BY country';
			$res=mysql_query($sel);
			echo '<form action="index.php?page=4" method="post">';
			echo '<table width="50%" class="table table-striped">';
			echo '<thead style="font-weight: bold"><td>№</td><td>Country</td><td>Del</td></thead>';
			while ($row=mysql_fetch_array($res,MYSQL_NUM)) {
				echo '<tr>';
				echo '<td>'.$row[0].'</td><td>'.$row[1].'</td>';
				echo '<td><input type="checkbox" name="cb'.$row[0].'"></td>';
				echo '</tr>';
			}
			echo '</table><br>';

			mysql_free_result($res);
			?>
		</div>
		<div class="col-md-6">
			<?php  echo '<input type="text" name="country" class="width">'; ?>
		</div>
		<div class="col-md-6">
			<?php  
			echo '<input type="submit" name="addcountry" value="ADD COUNTRY" class="add width btn btn-success"><br>';
			echo '<input type="submit" name="delcountry" value="DEL COUNTRY" class="del width btn btn-danger">';
			echo '</form>';
			?>
		</div>
		<?php
		if (isset($_POST['addcountry']))
		{
			$country=trim(htmlspecialchars($_POST['country']));
			if ($country=="")exit();
			$ins='INSERT INTO Countries (country) VALUES ("'.$country.'")';
			mysql_query($ins);
			echo '<script>window.location.href=document.URL;</script>';
		}

		if (isset($_POST['delcountry']))
		{
			foreach ($_POST as $k => $v)
			{
				if (substr($k, 0, 2)== "cb")
				{
					$idc=substr($k, 2);
					$del='DELETE FROM countries WHERE id='.$idc;
					mysql_query($del);
				}
			}
			echo '<script>window.location.href=document.URL;</script>';
		} 
		?>
	</div>

	<div class="right col-md-6">
		<h2>Cities</h2>
		<div class="form">
			<?php 
			echo '<form action="index.php?page=4" method="post">';
			$sel='SELECT ci.id,ci.city,co.country FROM cities ci, countries co WHERE ci.countryid=co.id ORDER BY city';
			$res=mysql_query($sel);
			echo '<table width="50%" class="table table-striped">';
			echo '<thead style="font-weight: bold"><td>№</td><td>City</td><td>Country</td><td>Del</td></thead>';
			while ($row=mysql_fetch_array($res, MYSQL_NUM)) {
				echo '<tr>';
				echo '<td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td>';
				echo '<td><input type="checkbox" name="cb'.$row[0].'"></td>';
				echo '</tr>';
			}
			echo '</table><br>';
			mysql_free_result($res);
			$res=mysql_query('SELECT * FROM countries ORDER BY country');
			?>
		</div>
		<div class="col-md-6">
		<?php 
			echo '<select name="countryname" class="width">';
			while ($row=mysql_fetch_array($res, MYSQL_NUM)) {
				echo '<option value="'.$row[0].'">'.$row[1].'</option>';
			}
			echo '</select><br>';

			echo '<input type="text" name="city" class="width">';
		?>
		</div>
		<div class="col-md-6">
			<?php  
			echo '<input type="submit" name="addcity" value="ADD CITY" class="add width btn btn-success">';
			echo '<input type="submit" name="delcity" value="DEL CITY" class="del width btn btn-danger">';
			echo '</form>';
			?>
		</div>
		<?php 
		if (isset($_POST['addcity'])) {
			$city=trim(htmlspecialchars($_POST['city']));
			if($city == "") exit();
			$countryid=$_POST['countryname'];
			$ins='INSERT INTO cities (city, countryid) VALUES ("'.$city.'", '.$countryid.')';
			mysql_query($ins);
			echo '<script>window.location.href=document.URL;</script>';
		}
		if (isset($_POST['delcity'])) {
			foreach ($_POST as $k => $v) {
				if (substr($k, 0, 2)== "cb") {
					$idc=substr($k, 2);
					$del='DELETE FROM cities WHERE id='.$idc;
					mysql_query($del);
				}
			}
			echo '<script>window.location.href=document.URL;</script>';
		}


		?>
	</div>
</div>

<hr>
<?php
// }
?>