<?php
require '../config.php';
require 'group_perm.php';
require '../admin/login.php';
mysql_select_db("$database", $con);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
		<meta http-equiv="Content-type" content="text/html; charset=UTF-8">
		<title>Dashboard - User Control Area</title>
		
		<link rel="shortcut icon" type="image/ico" href="/media/images/favicon.ico">
	
		<link rel="stylesheet" type="text/css" href="../css/style.css" />
 


		<style type="text/css" media="screen">
			@import "../css/data_page.css";
			@import "../css/data_table.css";
			@import "../css/data_table_jui.css";
			@import "../css/jquery-ui.css";
			@import "../css/jquery-ui-1.7.2.custom.css";
			.dataTables_info { padding-top: 0; }
			.dataTables_paginate { padding-top: 0; }
			.css_right { float: right; }
			#example_wrapper .fg-toolbar { font-size: 0.8em }
			#theme_links span { float: left; padding: 2px 10px; }
		</style>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		
		<script type="text/javascript" src="../js/complete.js"></script>
        <script src="../js/jquery.dataTables.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="../js/jquery.dataTables.editable.js"></script>
		<script src="../js/jquery.jeditable.js" type="text/javascript"></script>
        	<script src="../js/jquery-ui.js" type="text/javascript"></script>
        	<script src="../js/jquery.validate.js" type="text/javascript"></script>

		<script type="text/javascript" charset="utf-8">
			$(document).ready( function () {
					var id = 0;//simulation of id
					$('#example').dataTable({ bJQueryUI: true,
					
							"sPaginationType": "full_numbers"
							 		}).makeEditable({
									sUpdateURL: "UpdateData.php",
									//sUpdateURL: function(value, settings){return value;  },
									fnOnAdded: function() { window.location.reload();},
									sAddURL: "AddData.php",
									sAddHttpMethod: "POST",
                                    sDeleteHttpMethod: "POST",
									sDeleteURL: "DeleteData.php",
									fnOnDeleted: function() {
                                      window.location.reload();
                                    },
                    							"aoColumns": [
															{
															sName: "fullname",
                									        indicator: 'Saving Full Name...',
                                                            tooltip: 'Click to Edit Full Name',
															type: 'textarea',
															cssclass: 'required',
                                                 			submit:'Save changes'
                    									},
														
														{
														sName: "password",
														indicator: 'Saving Password...',
                                                       tooltip: 'Click to Edit Password',
														type: 'textarea',
														cssclass: 'required',
                                                 		submit:'Save changes'
                    									},

														
											{			sName: "email",
														indicator: 'Saving Email...',
														tooltip: 'Click to Edit Email',
														type: 'textarea',
														cssclass: 'email',
                                                 		submit:'Save changes'
                    									},
                    									{						
														sName: "groupname",
                                                         indicator: 'Saving User Group...',
                                                         tooltip: 'Select User Group',
                                                         loadtext: 'loading...',
                           					             type: 'select',
														 cssclass: 'required',
                               						     submit:'Save changes',
                                                         data: "{'':'Please select...',	'Limited':'Limited','Marketing':'Marketing','Report': 'Report','Admin': 'Admin','SuperAdmin':'SuperAdmin'}" },
															null 
											],
									oAddNewRowButtonOptions: {	label: "Add...",
													icons: {primary:'ui-icon-plus'} 
									},
									oDeleteRowButtonOptions: {	label: "Remove", 
													icons: {primary:'ui-icon-trash'}
									},

									oAddNewRowFormOptions: { 	
                                                    title: 'Add A New User',
													show: "blind",
													hide: "explode",
                                                    modal: true 
													
									}	,
sAddDeleteToolbarSelector: ".dataTables_length"								

										});
				
			} );
		</script>
	
<script type="text/javascript">
$(document).ready(function(){
 
        $(".slidingDiv").hide();
        $(".show_hide").show();
 
    $('.show_hide').click(function(){
    $(".slidingDiv").slideToggle();
    });
 
});
</script>

<!--[if IE]>
<link rel="stylesheet" type="text/css" href="css/ie-sucks.css" />
<![endif]-->

</head>

<body>
	<div id="container">
    	<div id="header">
        	<h2>User Admin Area</h2>
<div id="topmenu">
            	<ul>
                	<li><a href="<?php echo $domain?>/admin/results.php">Dashboard</a></li>
                 	<?php if ($OKE5[0] ==1){echo '<li class="current"><a href="'.$domain.'/useradmin/users.php">Users</a></li>';}?>
                    <?php if ($OKE4[0] ==1){if ($piwikan=='1') {echo '<li><a href="'.$domain.'admin/analytics.php">Site Analytics</a></li>';}}?> 
                   <?php if ($OKE6[0] ==1){echo '<li><a href="'.$domain.'/admin/settings.php">Settings</a></li>';}?>
				   <li><a href="<?php echo $domain ?>admin/logout.php" onclick="return confirm('Are You Ready To Logout?');" >Log Out</a></li>
              </ul>
          </div>
      </div>
	  
	
	  
        <div id="wrapper">
	
            <div id="usercontent">
                <div id="box">
                	<h3>Users</h3>
                							<div class="full_width">
											
											
											<?php if  ($OKE5[0] ==0){echo 'You do not have permission to access'; exit;} ?>
<a name="addnew"></a>										
<form id="formAddNewRow" action="#" title="Add A User" style="width:600px;min-width:600px">



        <label for="fullname">Full Name</label><br />
	<input type="text" name="fullname" id="fullname" class="required" rel="0" />
        <br />
    
    <label for="password">Password</label><br />
	<input type="textarea" name="password" id="password"  class="required" rel="1" />
            <br />

    <label for="email">Email</label><br />
	<input type="text" name="email" id="email"  class="required" rel="2" />
            <br />
			<label for="groupname">Group</label><br />
	<select name="groupname" id="groupname" class="required" rel="3">
                <option>Limited</option>
				<option>Marketing</option>
                <option>Report</option>
                <option>Admin</option>
				 <option>SuperAdmin</option>
        </select>
		
		<input type="hidden" name="created_at" id="created_at"  value="<?php echo $fdate; ?>" rel="4" />
        <br />
</form>
<a name="edit"></a>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
			<thead>
					<tr>
					
					<th>fullname</th>
					<th>password</th> 
					<th>email</th>
					<th>groupname</th>
					<th>Date Added</th>
				</tr>
			</thead>
			<tbody>
			
			<?php
			$userlist = mysql_query("SELECT `id`,`fullname`,`password`,`email`,`groupname`, `created_at`, `updated_at` FROM  `$database`.`$utable`  ");
			while($userdata = mysql_fetch_array($userlist)){
			
			$usercheck [] = $userdata['fullname'];
			
			echo "<tr id='".$userdata['id']."'>";
			//echo "<td class=\"read_only\">". $userdata['id']." </td>";
			echo "<td class=\"center\">". $userdata['fullname']." </td>";
			echo "<td class=\"center\">********* </td>"; //fix the way pasword is displayed
			echo "<td class=\"center\">". $userdata['email']." </td>";
			echo "<td class=\"center\">". $userdata['groupname']." </td>";
			echo "<td class=\"read_only\">". $userdata['created_at']." </td>";
			echo '</tr>';
			}
			?>
			

			</tbody>
			</table>
				</div>
                 
                </div>
				
				
                <br />
                
		
			<div class="slidingDiv">
			<h2>User Group Settings</h2> 
			</br>
			<h4>Below you can select which areas to give your users access</h4>
			</br>

			
<form name ="form-perm" id="form-perm" action="group_insert.php" method="post"> 					
<table id="usergroup">
  <tbody>
  			<thead>
					<tr>
					
					<th>User Group</th>
					<th>Export Report</th> 
					<th>Print Report</th>
					<th>Clear Records</th>
					<th>Analytics</th>
					<th>User Settings</th>
					<th>Survey Settings</th>
				</tr>
			</thead>

    <tr >
		<td>Limited</td>
		<td> <input type="checkbox"  name="Limited[1]"  <?php if($L1[0] == 1) echo 'checked="checked"'; else echo '';?>  value="1"></td>
		<td> <input type="checkbox"  name="Limited[2]"  <?php if($L2[0] == 1) echo 'checked="checked"'; else echo '';?>  value="1"></td>
		<td> <input type="checkbox"  name="Limited[3]"  <?php if($L3[0] == 1) echo 'checked="checked"'; else echo '';?>  value="1"></td>
		<td> <input type="checkbox"  name="Limited[4]"  <?php if($L4[0] == 1) echo 'checked="checked"'; else echo '';?>  value="1"></td>
		<td> <input type="checkbox"  name="Limited[5]"  <?php if($L5[0] == 1) echo 'checked="checked"'; else echo '';?>  value="1"></td>
		<td> <input type="checkbox"  name="Limited[6]"  <?php if($L6[0] == 1) echo 'checked="checked"'; else echo '';?>  value="1"></td>
		
    </tr>    
    <tr >
      <td>Marketing User</td>
		<td> <input type="checkbox"  name="Marketing[1]" <?php if($m1[0] == 1) echo 'checked="checked"'; else echo '';?>  value="1"></td>
		<td> <input type="checkbox"  name="Marketing[2]" <?php if($m2[0] == 1) echo 'checked="checked"'; else echo '';?>  value="1"></td>
		<td> <input type="checkbox"  name="Marketing[3]" <?php if($m3[0] == 1) echo 'checked="checked"'; else echo '';?>  value="1"></td>
		<td> <input type="checkbox"  name="Marketing[4]" <?php if($m4[0] == 1) echo 'checked="checked"'; else echo '';?>  value="1"></td>
		<td> <input type="checkbox"  name="Marketing[5]" <?php if($m5[0] == 1) echo 'checked="checked"'; else echo '';?>  value="1"></td>
		<td> <input type="checkbox"  name="Marketing[6]" <?php if($m6[0] == 1) echo 'checked="checked"'; else echo '';?>  value="1"></td>
		  
    </tr> 
    <tr >
      <td>Report User</td>
     <td> <input type="checkbox"  name="Reporter[1]"  <?php if($r1[0] == 1) echo 'checked="checked"'; else echo '';?>  value="1"></td>
	  <td> <input type="checkbox"  name="Reporter[2]" <?php if($r2[0] == 1) echo 'checked="checked"'; else echo '';?>  value="1"></td>
	  <td> <input type="checkbox"  name="Reporter[3]" <?php if($r3[0] == 1) echo 'checked="checked"'; else echo '';?>  value="1"></td>
	  <td> <input type="checkbox"  name="Reporter[4]" <?php if($r4[0] == 1) echo 'checked="checked"'; else echo '';?>  value="1"></td>
	  <td> <input type="checkbox"  name="Reporter[5]" <?php if($r5[0] == 1) echo 'checked="checked"'; else echo '';?>  value="1"></td>
	  <td> <input type="checkbox"  name="Reporter[6]" <?php if($r6[0] == 1) echo 'checked="checked"'; else echo '';?>  value="1"></td>
    </tr>      
  
  <tr>
     <td>Admin</td>
     <td> <input type="checkbox"  name="Admin[1]"  <?php if($ra1[0] == 1) echo 'checked="checked"'; else echo '';?>  value="1"></td>
	<td> <input type="checkbox"  name="Admin[2]" 	<?php if($ra2[0] == 1) echo 'checked="checked"'; else echo '';?>  value="1"></td>
	<td> <input type="checkbox"  name="Admin[3]"  <?php if($ra3[0] == 1) echo 'checked="checked"'; else echo '';?>  value="1"></td>
	<td> <input type="checkbox"  name="Admin[4]"  <?php if($ra4[0] == 1) echo 'checked="checked"'; else echo '';?>  value="1"></td>
	<td> <input type="checkbox"  name="Admin[5]"  <?php if($ra5[0] == 1) echo 'checked="checked"'; else echo '';?>  value="1"></td>
	<td> <input type="checkbox"  name="Admin[6]"  <?php if($ra6[0] == 1) echo 'checked="checked"'; else echo '';?>  value="1"></td>
		 
    </tr>    
	<tr>
     <td>Super Admin</td>
	 <td> <input type="checkbox"  name="SuperAdmin[1]" disabled="disabled" checked="checked" value="1" ></td>
     <td> <input type="checkbox"  name="SuperAdmin[2]" disabled="disabled" checked="checked" value="1" ></td>
    <td> <input type="checkbox"  name="SuperAdmin[3]" disabled="disabled" checked="checked" value="1" ></td>
     <td> <input type="checkbox"  name="SuperAdmin[4]" disabled="disabled" checked="checked" value="1" ></td>
	 <td> <input type="checkbox"  name="SuperAdmin[5]" disabled="disabled" checked="checked" value="1" ></td>
     <td> <input type="checkbox"  name="SuperAdmin[6]" disabled="disabled" checked="checked" value="1" ></td>
	</tr>   
	
  </tbody>
</table>
  <input type="submit" value="Update Permissions" id="form-perm" onclick = "return showMessage()"/> <!--update withoutleaving-->
</form>

<script type = "text/javascript">
function showMessage() {
alert ("Group Permissions Updated!");
return true;
}
</script>



			</div>
				
				
            </div>
			
			 
		   <div id="sidebar">
  				<ul>
                	             
                  <li><h3><a href="users.php" class="user">Users</a></h3>
          				<ul>
                           	<li><a href="#" class="show_hide" >User Groups</a></li>
							<li><a href="#" class="online">Users online</a></li>
                        </ul>
                    </li>
				</ul>       
          </div>
           
						
		   
      </div>
	  
        <div id="footer">
				<!--Template inspired by Bloganje-->
				Created by Adrian Speyer.
				</div>
</div>
</body>
</html>