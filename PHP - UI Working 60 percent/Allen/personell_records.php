<style>
.login-block input {
    height: 32px;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #47c9af; /* username and password border */
    margin-bottom: 20px;
    font-size: 14px;
    font-family: Montserrat;
    padding: 5px;
	width:225px;
    outline: none;
	margin-right:20px;
}
</style>

<div class="login-block">
<div id='cssmenu_2'>
	<ul>
		<li><a href='index.php?loc=staff'>Personnel List</a></li>
		<li class='active'><a href='index.php?loc=staff_records'>Add Personnel</a></li>
	</ul>
</div>

      <p><span style="font-size:18px;"><span style="font-family:arial,helvetica,sans-serif;"><br /><br />Fill up the informations</span></span></p>

<hr />

<form method="POST" action="index.php?loc=staff_records" >

<br /><br />
<p><span style="font-family:arial,helvetica,sans-serif;"><span style="font-size:14px;">
	Last Name:&nbsp; &nbsp;<input name="ln" maxlength="30" name="activity" type="text" /></span></span>&nbsp; &nbsp;
	First Name:&nbsp;<input name="fn" maxlength="30" name="f_name" type="text" /> &nbsp;
	Middle Name:&nbsp;<input name="mn" maxlength="30" name="m_name" type="text" /></p>

<p><span style="font-family:arial,helvetica,sans-serif;"><span style="font-size:14px;">
	Address:&nbsp; &nbsp; &nbsp; &nbsp;<input name="addr" maxlength="30" name="date" type="text" /></span></span></p>

<p><span style="font-family:arial,helvetica,sans-serif;"><span style="font-size:14px;">
	Contact:&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<input name="cn" maxlength="30" name="loc" type="text" /></span></span></p>

<p><span style="font-family:arial,helvetica,sans-serif;"><span style="font-size:14px;">
	Email:&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input name="em" maxlength="30" name="org_id" type="text" /></span></span></p>

<p><span style="font-family:arial,helvetica,sans-serif;"><span style="font-size:14px;">
	Staff Type:&nbsp; &nbsp;&nbsp;<input name="st" maxlength="30" name="staff_id" type="text" /></span></span></p>

<input type="submit" values="Submit" />

</form>




</div>
</body>
<html>
