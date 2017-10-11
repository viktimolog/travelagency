<?php
function connect($host='localhost',$user='root',$pass='654321',$dbname='08714')
{
	$link=mysql_connect($host,$user,$pass) or die('connection error');
	mysql_select_db($dbname) or die('select db error');
	mysql_query("set names 'utf8'");
}

function register($name,$pass,$email){
	$name=trim(htmlspecialchars($name));
	$pass=trim(htmlspecialchars($pass));
	$email=trim(htmlspecialchars($email));
	if ($name=="" || $pass=="" || $email=="")
	{
		echo "<h3/><span style='color:red;'>Fill All Required Fields!</span><h3/>";
		return false;
	}
	if (strlen($name)<3 || strlen($name)>30 || 
		strlen($pass)<3 || strlen($pass)>30)
	{
		echo "<h3/><span style='color:red;'>Values Length Must Be Between 3 And 30!</span><h3/>";
		return false;
	}
	$ins='insert into users (login,pass,email,roleid)
			values("'.$name.'","'.md5($pass).'","'.$email.'",2)';//2 - default all new users is customer
	connect();
	mysql_query($ins);
	$err=mysql_errno();
	if ($err)
	{
		if($err==1062)
			echo "<h3/><span style='color:red;'>This Login Is Already Taken!</span><h3/>";
		else
			echo "<h3/><span style='color:red;'>Error code:".$err."!</span><h3/>";
		return false;
		}
		return true;
	}
function login($name,$pass)
{
    $name=trim(htmlspecialchars($name));
    $pass=trim(htmlspecialchars($pass));
    if ($name=="" || $pass=="")
    {
        echo "<h3/><span style='color:red;'>Fill All Required Fields!</span><h3/>";
        return false;
    }
    if (strlen($name)<3 || strlen($name)>30 || strlen($pass)<3 || strlen($pass)>30)
    {
        echo "<h3/><span style='color:red;'>Value Length Must Be Between 3 And 30!</span><h3/>";
        return false;
    }
    connect();
    $sel='select * from users where login="'.$name.'" and pass="'.md5($pass).'"';
    $res=mysql_query($sel);
    if($row=mysql_fetch_array($res,MYSQL_NUM))
    {
        $_SESSION['ruser']=$name;
        if($row[5]==1)
        {
            $_SESSION['radmin']=$name;
        }
        return true;
    }
    else
    {
        echo "<h3/><span style='color:red;'>No Such User!</span><h3/>";
        return false;
    }
}
?>

<?php
connect();
$ins='update users set roleid=2 where id =2';
mysql_query($ins);
?>
