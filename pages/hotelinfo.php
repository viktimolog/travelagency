<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hotel Info</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php
include_once ("functions.php");
if(isset($_GET['hotel']))
{
    $hotel=$_GET['hotel'];//get hotelid from GET
    connect();
    $sel='select * from hotels where id='.$hotel;
    $res=mysql_query($sel);
    $row=mysql_fetch_array($res,MYSQL_NUM);
    $hname=$row[1];
    $hstars=$row[4];
    $hcost=$row[5];
    $hinfo=$row[6];
    mysql_free_result($res);
    echo '<h2 class="text-uppercase text-center">'.$hname.'</h2>';
    echo '<div class="row"><div class="col-md-12 text-center">';
    connect();
    $sel='select imagepath from images where hotelid='.$hotel;
    $res=mysql_query($sel);
    $sel1='select imagepath from images where hotelid='.$hotel;
    $res1=mysql_query($sel1);
    echo '<span class="label label-warning">Watch a few pictures of the hotel</span>';
    $i=0;
    $j=0;
}
?>
<main class="container">
    <section class="row">
            <article class="col-xs-12 col-md-12">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <?php
                    while($row=mysql_fetch_array($res,MYSQL_NUM)){
                        if($i == 0)
                        {
                            echo '<div class="item active">';
                            $i++;
                        }
                        else
                            echo '<div class="item">';
                        echo '<img width="640" height="460" class="img-responsive center-block" src="../'.$row[0].'">';
                        echo '<div class="carousel-caption"></div>';
                        echo '</div>';
                        $j++;
                    }
                    mysql_free_result($res);
                    ?>
                </div>

                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <?php
                    for($i=1; $i<$j; $i++)
                    {
                        echo ' <li data-target="#carousel-example-generic" data-slide-to="'.$i.'"></li>';
                    }
                    ?>
                </ol>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </article>
        <aside class="col-xs-12 col-md-12">
            <br/>
            <?php
            for ($i=0; $i<$hstars; $i++)
            {
                echo '<span class="glyphicon glyphicon-star"></span>';
            }
            ?>
            <div>
                <h3>Cost: <span class="label label-info"><?php echo $hcost.' $'; ?></span></h3>
            </div>


            <div class="panel panel-default">
                <div class="panel-heading">Краткая информация об отеле:</div>
                <div class="panel-body">
                    <section class="info"><?php echo $hinfo; ?></section>
                </div>
                <div class="panel-footer">Наша компания рекомендует этот отель!</div>
            </div>

            <?php
            connect();
            $sel='select comment from Comments where hotelid='.$hotel;
            $res=mysql_query($sel);

            ?>
                        <?php
                        $count=0;
                        while($row=mysql_fetch_array($res,MYSQL_NUM))
                        {
                            $count++;
                            echo'<div class="panel panel-default">';
                            echo'<div class="panel-heading">';
                            echo'Comment '."$count";
                            echo'</div>';
                            echo'<div class="panel-body">';
                            echo'<section>';
                            echo "$row[0]";
                            echo'</section>';
                            echo'</div>';
                            echo'</div>';
                        }
                        mysql_free_result($res);
                        ?>
        </aside>
    </section>
</main>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../js/bootstrap.min.js"></script>
</body>
</html>