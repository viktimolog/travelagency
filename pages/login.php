<?php
session_start();
?>
<?php
if (isset($_SESSION['ruser']))
{
echo '<form action="index.php';
    if (isset($_GET['page'])) echo '?page='.$_GET['page'];
echo '" class="form-inline pull-right" method="post">';
echo '<h4>Hello, <span>'.$_SESSION['ruser'].'</span>&nbsp;';
echo '<input type="submit" value="Logout" id="ex" name="ex" class="btn btn-default btn-xs"></h4>';
echo '</form>';
if (isset($_POST['ex']))
{
    unset($_SESSION['ruser']);
    unset($_SESSION['radmin']);
    echo '<script>window.location.reload()</script>';
}
}
else
{
    if (isset($_POST['press']))
    {
        if(login($_POST['login'],$_POST['pass']))
        {
            echo '<script>window.location.reload()</script>';
        }
    }
    else
    {
        echo '<form action="index.php';
        if (isset($_GET['page'])) echo '?page='.$_GET['page'];
        echo '" class="input-group input-group-sm pull-right" method="post">';
        echo '<input type="text" name="login" size="10" class="" placeholder="login">
<input type="password" name="pass" size="10" class="" placeholder="password">
<input type="submit" id="press" value="Login" class="btn btn-default btn-xs" name="press">
</form>';
    }
}