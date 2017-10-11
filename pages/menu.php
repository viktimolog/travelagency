<ul class="nav nav-pills">
	<?php
		if(!isset( $_GET['page'] )){
			echo '<li><a href="index.php?page=1" class="amenu">Tours</a></li>';
			echo '<li><a href="index.php?page=2" class="amenu">Comments</a></li>';
			echo '<li><a href="index.php?page=3" class="amenu">Register</a></li>';

           if(isset($_SESSION['radmin']))
           {
               echo '<li><a href="index.php?page=4" class="amenu">Countries</a></li>';
               echo '<li><a href="index.php?page=5" class="amenu">Hotels</a></li>';
               echo '<li><a href="index.php?page=6" class="amenu">Admin page</a></li>';
               echo '<li><a href="index.php?page=7" class="amenu">Private</a></li>';
           }

		}
		else{
	?>
		<li <?php echo ($page==1)? "class='active'":"" ?>>
			<a href="index.php?page=1" class="amenu">Tours</a>
		</li>
		<li <?php echo ($page==2)? "class='active'":"" ?>>
			<a href="index.php?page=2" class="amenu">Comments</a>
		</li>
		<li <?php echo ($page==3)? "class='active'":"" ?>>
			<a href="index.php?page=3" class="amenu">Register</a>
		</li>

            <?php
            if(isset($_SESSION['radmin']))
            {
                if($page==4)
                    $c='active';
                else
                    $c="";
                echo '<li class="'.$c.'"><a href="index.php?page=4">Countries</a></li>';

                if($page==5)
                    $c='active';
                else
                    $c="";
                echo '<li class="'.$c.'"><a href="index.php?page=5">Hotels</a></li>';

                if($page==6)
                    $c='active';
                else
                    $c="";
                echo '<li class="'.$c.'"><a href="index.php?page=6">Admin page</a></li>';

                if($page==7)
                    $c='active';
                else
                    $c="";
                echo '<li class="'.$c.'"><a href="index.php?page=7">Private</a></li>';
            }
            ?>
	<?php
	}
	?>
</ul>