<?php
connect();
echo '<div class="form-inline">';
echo '<select name="countryid" id="countryid" onchange="getCities(this.value)">';
echo '<option value="0">select country...</option>';
$res=mysql_query('select * from countries');//get countries in res
while( $row=mysql_fetch_array($res,MYSQL_ASSOC) )
{
    echo '<option value="'.$row['id'].'">'.$row['country'].'</option>';//load countries in option
}
echo '</select>';
echo'<span id="cityid"></span>';
echo '</div>';
echo '<div id="hotelid"></div>';
?>
<script>
    function getCities(countryid)
    {
        if(countryid == "0")
        {
            document.getElementById('cityid').innerHTML="";
        }

        if(window.XMLHttpRequest){
            ao=new XMLHttpRequest();
        }
        else{
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
    function getHotels(cityid)
    {
        if(cityid=="0")
        {
            hotelid.innerHTML="";
        }
        //creating AJAX object
        if(window.XMLHttpRequest)
        {
            ao=new XMLHttpRequest();
        }
        else
        {
            ao=new ActiveXObject('Microsoft.XMLHTTP');
        }
        //creating callback function accepting result
        ao.onreadystatechange=function(){
            if(ao.readyState==4 && ao.status==200)
            {
                hotelid.innerHTML=ao.responseText;
            }
        }
        //creating and sending AJAX request
        ao.open("POST","pages/ajax.php",true);
        ao.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
        ao.send("cid="+cityid);
    }
</script>