/*THIS IS FOR Organizer page ONLY*/
function showResult(str)
{
if (str.length==0)
  {
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("org_records_table").innerHTML=xmlhttp.responseText;
    //document.getElementById("contact-info").style.border="1px solid #A5ACB2";
    }
  }
var limit = document.getElementById("limit_org_records").value;
xmlhttp.open("GET","Organizer.php?search="+str+"&limit="+limit,true);
xmlhttp.send();
}