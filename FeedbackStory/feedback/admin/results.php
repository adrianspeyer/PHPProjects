<?php
require '../config.php';
require 'login.php';
mysql_select_db("$database", $con);
?>

<?php
//COUNT AREA
//ttl count
$rcount = mysql_query("SELECT COUNT(*) FROM  `$database`.`$table` WHERE  updated_at < now()");
$trcount = mysql_fetch_row(($rcount)); 
$trcount = $trcount[0];

//count last 30 days
$l30days = mysql_query("SELECT COUNT(*) FROM  `$database`.`$table` WHERE DATE_SUB(CURDATE(),INTERVAL 30 DAY) <= updated_at");
$c30days = mysql_fetch_row(($l30days)); 
$c30days = $c30days[0];


//HAPPYSCORE AREA
$happyavg =mysql_query("SELECT AVG(happy) as `happy` FROM  `$database`.`$table`");
$happyscore = mysql_fetch_row(($happyavg)); 
$happyscore = $happyscore[0];
$hapavg2 = $happyscore * 10;
$hapavg = number_format($hapavg2,2);

//SUCCESS AREA
//success in acheving total goals
$totalsuccess =mysql_query("SELECT count(*) as `success` FROM  `$database`.`$table`");
$succesttl = mysql_fetch_row(($totalsuccess)); 
$succesttl =  $succesttl[0];

//total yes
$totalyes =mysql_query("SELECT count(*) as `success` FROM  `$database`.`$table` WHERE `success` = '1'" );
$yepsuccess = mysql_fetch_row(($totalyes)); 
$yepsuccess =  $yepsuccess[0];

//no success
$nosuccess = $succesttl-$yepsuccess;

//succesrate
if ($succesttl>0){
$successrate2 =   ($yepsuccess/$succesttl) * 100;
$successrate  = number_format($successrate2,2);
}


//COUNTRY DATA
/*
$countrycount  = mysql_query("SELECT `country`, count(`country`) FROM  `$database`.`$iptable` group by `country`");
while($ctry = mysql_fetch_array($countrycount)){
echo "['".$ctry ['country']."',".$ctry[ count('country')]."],</br>";
}
*/
//most poular country
$popcountry = mysql_query("SELECT `country`, COUNT(`country`) AS `countcountry` FROM `$database`.`$iptable` group by `country` ORDER BY `countcountry` DESC LIMIT 1");
$mpopcty = mysql_fetch_assoc($popcountry);
$country = $mpopcty['country'];


//IMPRESSION STARTED SURVEY
$attemptcount =mysql_query("SELECT `surveyname`,`surveyview` FROM  `$database`.`$impression` WHERE `surveyview`>0 AND `surveyname` = 'survey_landing' ");
$attemptimp = mysql_fetch_assoc($attemptcount);
$attempts =  $attemptimp['surveyview'];
if ($attempts>0){
$comprateraw = ($succesttl/$attempts)*100;
$comprate = number_format($comprateraw,2);
}

//IMPRESSION SURVEY REQUESTS
$requestcount =mysql_query("SELECT `surveyname`,`surveyview` FROM  `$database`.`$impression` WHERE `surveyview`>0 AND `surveyname` = 'survey_request' ");
$requestimp = mysql_fetch_assoc($requestcount);
$requests =  $requestimp['surveyview'];
if ($requests>0){
$convrateraw = ($attempts/$requests)*100;
$convrate = number_format($convrateraw,2);
}

//Abadonned Survey
$absurvey = mysql_query("SELECT `value1`, `value2`,`value3`,`value4`,`value5` FROM `$database`. $blanks`");
$blnk = mysql_fetch_assoc($absurvey );
$blk1 = 'Happiness Question: '.$blnk ['value1'];
$blk2 = 'Achieve Question: '.$blnk ['value2'];
$blk3 = 'Objective Question: '.$blnk ['value3'];
$blk4 = 'Improvement Question: '.$blnk ['value4'];
$blk5 = 'Country Question: '.$blnk ['value5'];
$blnksum = $blnk ['value1']+$blnk ['value2']+$blnk ['value3']+$blnk ['value4']+$blnk ['value5']
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Dashboard - Visitor Summary Report</title>
<style type="text/css" title="currentStyle">
			@import "../css/data_page.css";
			@import "../css/data_table.css";
		</style>
		


<link rel="stylesheet" type="text/css" href="../css/style.css" />
<link rel="stylesheet" type="text/css" href="../css/print.css" media="print">
<script type="text/javascript" language="javascript" src="../js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="../js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="../js/jquery.dynacloud-5.js"></script>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="../css/ie-sucks.css" />
<![endif]-->
<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#logbox').dataTable();
			} );
</script>



</head>

<body>
	<div id="container">
    	<div id="header">
        	<h2>Web Visitor Feedback Admin</h2>
    <div id="topmenu">
            	<ul>
                    	<li class="current"><a href="<?php echo $domain?>/admin/results.php">Dashboard</a></li>
                <?php if ($OKE5[0] ==1){echo '<li><a href="'.$domain.'/useradmin/users.php">Users</a></li>';}?>
                 <?php if ($OKE4[0] ==1){if ($piwikan=='1') {echo '<li><a href="'.$domain.'admin/analytics.php">Site Analytics</a></li>';}}?> 
				   <?php if ($OKE6[0] ==1){echo '<li><a href="'.$domain.'/admin/settings.php">Settings</a></li>';}?>
				   <li><a href="<?php echo $domain ?>admin/logout.php" onclick="return confirm('Are You Ready To Logout?');" >Log Out</a></li>
              </ul>
          </div>
      </div>
        <div id="top-panel">
            <div id="panel">
                <ul>			
					<?php if  ($OKE2[0] ==1) {echo '<li><a href="javascript:window.print()" class="print"> Print Report</a></li>';} else {echo '';}?>
					<?php if  ($OKE1[0] ==1) {echo '<li><a href="'.$domain.'/admin/export.php" class="report">Export Visitor Log</a></li>';} else {echo '';}?>
					<?php if  ($OKE3[0] ==1) {echo ' <li><a href="'.$domain.'/admin/delete.php"  class="delete_report"  onclick="return confirm(\'Are You Ready To Delete All Records?\');">Clear All Records</a></li>';} else {echo '';}?>
					</ul>
            </div>
      </div>
        <div id="wrapper">

<?php
if ($trcount ==0) {
echo '<div id="deletecontent"><img style="width: 97px; height: 100px;" alt="sad" title="sad"
src="'.$domain.'/images/tango-face-sad-th.png"></br>We seem to have no data yet? Your reports will show up when we get your first results, so make 
sure your campaigns are up.';

if(isset($firstinstall) && $firstinstall==1)
{echo '<b><p>Make sure you set up your <a href="'.$domain.'/admin/settings.php">settings</a></div><b>';}


exit;}
?>
		<div id="content">


			<div id="rightnow">
                    <h3 class="reallynow">
                        <span>Summary About Data</span>
                       <br />
                    </h3>
				    <p class="youhave">
					<?php echo "The most popular country for feedback is " . $country . ". Right now you have a total of " . $trcount. " records submitted, which is good";?> 
					<?php if  ($trcount = $c30days) {echo ", but it's still too early to get a full picture because it's been less than 30 days of data.";}
					elseif ( $c30days < 15) {echo ", but you should encourage users to  provide feedback so you have greater accuracy in your reports.";}
					elseif ( $c30days > 45) {echo ", because it looks like at the rate you are getting feedback, you should have no problem getting insights into your visitors.";}
					else   {echo ", and hope to continue to see a positive trend.";} 
					?>
					<?php echo "There are also two areas which can give you quick insight to how users perceive visits to your website. It's what we call the 'Happiness Score' and 
					the 'Visitor Goal Score'. These are values that determine how people felt about their experience on your site and if they were able to acheive their goals.";?>
				
				
					</br></br>
					<?php echo "Let's look first at your 'Happiness Score', your current score is ".$hapavg."%.";?>
					<?php if  ($hapavg<40) {echo " It looks like your users are really not happy with your site. You need to really spend some time 
					trying to address user issues.";}
					elseif ( $hapavg >= 40 && $hapavg < 50) {echo "It looks like your users are really not happy with your site. While a majority seem unhappy, 
					hopefully in the logs below there are some insights that can help you acheive better results.";}
					elseif ( $hapavg >= 50 && $hapavg < 51 ) {echo "It looks like most users are okay with your site, but they feel relatively neutral. There might
					still be some changes to consider to improve thier experience. ";}
					elseif ( $hapavg >= 51 && $hapavg <= 65 ) {echo "It looks for the majority of users are happy, but there is still room for improvement";} 
					elseif ( $hapavg >= 66 && $hapavg <= 80 ) {echo "This is a solid 'Happinesss Score', but while not perfect, this is a definite positive";} 
					elseif ( $hapavg >80 ) {echo "It looks like your website visitors are extremly happy. Keep up the good work!";} 
					?>
					
				
					</br></br>
					<?php echo "Now, let's look at your 'Visitor Goal Score'. This is a most crucial metric. Simply stated, this
					percentage tells you how successful users were in achieving their goals when visiting your site.";?>
					<?php echo "Your current success rate for user to achieve their objectives was ".$successrate."%.";?>
					
					<?php if  ($successrate <50) {echo " The majority of users were not able to acheive their objectives. This is a serious issue that needs 
					to be examined to make sure your offer meets user expecation.";}
					elseif ( $successrate >= 50 && $successrate <= 55 ) {echo "On the positvie side, a slight majortiy of web visitors were able 
					to meet the objectives of their visit. Nevertheless, this is not as strong reult as it could be. You should examine ways to ensure your site meets 
					your visitors needs.";} 
					elseif ($successrate >= 56 && $successrate <= 65 ) {echo "This is an okay 'Visitor Goal Score', nevertheless, it makes sense to examine 
					ways to ensure your site continues to meet your visitors needs";} 
					elseif ($successrate >66 ) {echo "It looks like a good majority of users were able to acheive the objective of their visit. Keep up the good work!";} 
					?>
					
					
					</br></br>
					<?php if ( $hapavg <= 50 && $successrate >= 50){echo "Interestingly, it seems users are not 
					happy with your site, but they are still able to acheive their objectives. Short term this may work, but
					we highly recommend you study user opinions to address those issues that may impact their happiness";}
					?>
					
				
					<?php  echo "Don't forget to also study the visitor logs for detailed commentary which can provide even greater insights.";?>
					</br>
					
					
			  </div>
              <div id="infowrap">
            
			<div id="happybox">
                    <h3>Happiness Score</h3>
                    <p>
					<!--Site Happiness Score-->
					<?php
					echo '<div id="happy_avg"><b>'.$hapavg.'%</b></div>';
					echo '<div id="happy_face">';
					if ($happyscore < 5.0){
					echo '<img style="width: 97px; height: 100px;" alt="sad" title="sad"
					src="'.$domain.'/images/tango-face-sad-th.png"></br>';
					echo 'It looks like people are having issues with your site</br>';
					}
					elseif  ($happyscore >= 5.5)
					{
					echo '<img style="width: 97px; height: 100px;" alt="smile" title="smile"
					src="'.$domain.'/images/tango-face-smile-th.png"></br>';
					echo 'Things look great. Visitors are really happy!</br>';
					}
					else
					{
					echo '<img style="width: 97px; height: 100px;" alt="neutral" title="neutral"
					src="'.$domain.'/images/tango-face-plain-th.png"></br>';
					echo 'Visitors really don\'t care one way or the other</br>';
					}
					echo '</div>';
					?>
					<!--End Site Happiness Score-->

					</p> 
					
                  </div>
				  
				  
				  
					<!--REPORT LEVEL-->

				  <div id="reportbox" class="margin-left">
					<h3>Report Level</h3>  
					 <div id="reportboxformat">
					<?php  
					echo '<b>Total Number of Records:</b><p> '.$trcount.'</p>';
					echo '</br>';
					echo '<b>Number of Records Last 30 days:</b><p>'.$c30days.'</p>';?>
				  </div>
				  </div>
				  
		
			  
				 
				  
                  <div id="successbox" class="margin-right">
                    <h3>Success in Acheiving Visit Goals</h3> 
                    <p>
				<!--Site Goal Success Score-->

			
		
				<?php
				echo '<div id="successsumbox"><b>Summary: </b>';
				//percentage
				$yeppers =   ($yepsuccess/$succesttl) * 100;
				if ($yeppers < 50) {
				echo "Based on the data collected it looks like the majority of users were not successful in achieving thier objectives. Check objective log for hints";
				} elseif ($yeppers <=55) {
				echo "While most people seem to have success in acheving the objective on the site, there is still lots of room for improvement.";
				} else {
				echo "It looks like your site is achieving great success in meeting your visitor needs.";
				} 
				echo '</div>';
				?>
			
				<!--PIE CHART SUCCESS-->
				<div id="chart_div"></div>
				<!--END PIE CHART SUCCESS-->

				<!--End of Site Goal Success Score-->
					
								</p>
							  </div>
							  
		 
							
				<div id="mapbox" class="margin-left">
				   <h3>Feedback Map</h3>       
				   <p>   
				   <!--FEEDBACK MAP -->
					  <div id='map_canvas'></div>
					
					<!--END FEEDBACK MAP -->				  
						</p>
						</div> 

				<div id="cloudbox" class="margin-left">
				<h3>Feedback Cloud</h3> 
				<div id="dynacloud">
				<script type="text/javascript">$('#text').dynaCloud('#tagCloud');</script></div>
				</div></div>


				<div id="logtable">
				<h2>Visitor Objective Log </h2>
				<div id="text" class="dynacloud">
				<table cellpadding="0" cellspacing="0" border="0" class="display" id="logbox" width="100%">
						<thead>
							<tr>
								<th> Happiness Level </th>
								<th> Success In Goals </th>
								<th> Objective Of Visit </th>
								<th> How Can We Improve </th>
								<th> Referring Page </th>
								<th> Date </th>
                            </tr>
						</thead>
						<tbody>
							<tr>					
			<?php
			$allresults = mysql_query("SELECT `happy`,`success`,`objective`,`getbetter`,`page`, `updated_at` FROM  `$database`.`$table` ORDER BY `updated_at` DESC");
			while($row = mysql_fetch_array($allresults)){

				//happiness
				echo "<td><center>";
				if ($row['happy'] == 1) {
				echo "Unhappy ";
				} elseif ($row['happy'] == 10) {
				echo "Happy ";
				} else {
				echo "Neutral ";
				}
				echo "</center></td>";
				
				//success
				echo "<td><center>";
				if ($row['success'] == 1) {
				echo "Successful ";
				} else {
				echo "Not Successful ";
				} 
				 echo "</center></td>";
				  
				
				//Objective
				echo "<td>". $row['objective']." </td>";

				
				//how we get better
				echo "<td>". $row['getbetter']." </td>";
				
				//page user was on
				echo "<td><center><a href=". $row['page']." title=". $row['page']." target=\"_blank\">link</a></center></td>";
								
				//record updated
				$row['updated_at'] = date("Y-m-d");//removes timestamp
				echo "<td>". $row['updated_at']."</td>";
				echo "</tr>";
				
				}
				?>		 
						</tbody>
					</table>   
			
				</div>
					
                  </div>
			  
                  </div>
              </div>
       


		<div id="sidebar">
  				<ul>
                	               
                    <li><h3><a href="#" class="house">Manage</a></h3>
          				<ul>
						<?php if  ($OKE2[0] ==1) {echo '<li><a href="javascript:window.print()" class="print"> Print Report</a></li>';} else {echo '';}?>
						<?php if  ($OKE1[0] ==1) {echo '<li><a href="/export.php" class="report">Export Visitor Log</a></li>';} else {echo '';}?>
						<?php if  ($OKE3[0] ==1) {echo '<li><a href="/delete.php" class="delete_report">Clear All Records</a></li>';} else {echo '';}?>
					    </ul>
                    </li>
                  <li><h3><a href="<?php echo $domain ?>/useradmin/users.php" class="user">Users</a></h3>
          				<ul>
                            <li><a href="<?php echo $domain ?>/useradmin/users.php#addnew" class="useradd">Add user</a></li>
                            <li><a href="<?php echo $domain ?>/useradmin/users.php#edit" class="useredit">Edit User</a></li>
                        </ul>
                    </li>	
					
					<li><h3><a href="<?php echo $domain ?>admin/logout.php" class="log_out" onclick="return confirm('Are You Ready To Logout?');" >Log Out</a></h3>

				</ul>    
					
          </div>
		
		
					<?php if (!empty($blnk)){?>		
					<div id="sidebar2">	
					<div id="abadontable">	
					<h3>Question Abandoment</a></h3>
					<p>A count of which question was left blank before a user abandoned your survey.</p>
					<table border="1">
					<thead>
					<tr>
					<th>Question</th>
					<th>Abandons</th>
					</tr>
					</thead>
					<tfoot>
					<tr>
					<td>Sum</td>
					<td><?php echo $blnksum ?></td>
					</tr>
					</tfoot>
					<tbody>
					<tr>
					<td>Happiness</td>
					<td><?php echo $blnk ['value1']?></td>
					</tr>
					<tr>
					<td>Achieve</td>
					<td><?php echo $blnk ['value2']?></td>
					</tr>
					<tr>
					<td>Objective</td>
					<td><?php echo $blnk ['value3']?></td>
					</tr>
					<tr>
					<td>Improvement</td>
					<td><?php echo $blnk ['value4']?></td>
					</tr>
					<tr>
					<td>Country</td>
					<td><?php echo $blnk ['value5']?></td>
					</tr>
					</tbody>
					</table>
					</div>
					</div>
					<?php }?>
		
		
		<?php if (!empty($convrate)){?>
		<div id="sidebar2">	
		<h3>Conversion Rate</a></h3>
		<p>The rate of conversion from survey request pop-up to survey landing page.</p>	
		<center>
		 <!--SURVEY CONVERSION RATE GAUGE-->
				<div id="visualizationreq" style="width: 100px; height: 100px;"></div>	
		 <!--END SURVEY CONVERSION RATE GAUGE-->
		<h6><b>Survey's Attempted:  <? echo $attempts;?></b></h6>
		<h6><b>Survey's Requested: <?php echo $requests; ?></b></h6>
		<div id="crbox">
		<?php echo '<b>Current Completion Rate:</b><center><b>'.$convrate.'%</b></center>'; ?>
		<b>Summary:</b></br>
		<?php if  ($convrate<1) {echo "Conversion rate is very low. Make sure your users are not getting too many survey request in your install.";}
		elseif ( $convrate >= 2 && $convrate < 10) {echo "You may want target the survey to certain pages or review frequency. ";}
		elseif ( $convrate>= 11 && $convrate <= 25 ) {echo "This is an slighty above average conversion rate.";} 
		elseif ( $convrate>= 26 && $convrate <= 49 ) {echo "This is a very solid rate of conversion.";} 
		elseif ( $convrate >=50 && $convrate <= 100 ) {echo "Great job in targeting users who want to give feedback.";}  
		elseif ( $convrate >=101) {echo "<b style=\"color:red;\">This means users are accessing your survey outside of the pop-up.</b>";}  
		?>
			<div>
		</center>
		</div>
		<!--[if lt IE 9]>
		</div></div>
		<![endif]-->		
		<?php }?>
		

				<div id="sidebar2">	
				<h3>Completion Rate</a></h3>
				
				<p>The rate of survey attempted versus completed survey.</p>		
				<center>
				    <!--SURVEY RATE GAUGE-->
				<div id="visualization" style="width: 100px; height: 100px;"></div>	
				    <!--END SURVEY RATE GAUGE-->
				<h6><b>Survey's Completed:  <? echo $succesttl;?></b></h6>
				<h6><b>Survey's Attempted: <?php echo $attempts; ?></br></b></h6>
				<div id="crbox">	
				<p><? echo '<b>Current Completion Rate:</b><center><b>'.$comprate.'%</b></center>';?><p>
				
				 <b>Summary:</b></br>
					<?php if  ($comprate<5) {echo "Lots of users started to give feedback, but abandoned the proccess. Make sure there are no issues with the delivery method of the survey within your install";}
					elseif ( $comprate >= 5 && $comprate < 20) {echo "Your completion rate is very low. You may want to review the survey delivery methods to website visitors. You may wish to consider a promotion. ";}
					elseif ( $comprate>= 20 && $comprate <= 35 ) {echo "More than half of users abandoned your survey. Take special notice of complaints, because if the user took the time to share, you might uncover major roadblocks on your site.";} 
					elseif ( $comprate>= 36 && $comprate <= 51 ) {echo "This is a soft feedback rate, but you are headed in the right direction. Make sure you make it easy for users to share feedback.";} 
					elseif ( $comprate >= 52 && $comprate <= 74 ) {echo "This is a solid rate of feedback and you may find some gems in how to improve your website.";} 
					elseif ( $comprate >=75 ) {echo "It looks like your website visitors are extremly happy to share their feedback with you. Make sure you don't waste the valuable insights you have received.";} 
					?>
				
				
				<div>
				
				</center>
				</div>

	</div>	</div>

				</div> 
				<div id="footer">
				<!--Template inspired by Bloganje-->
				Created by Adrian Speyer.
				</div>

        
</div>


<!--GOOGLE CHARTS JAVASCRIPT-->

	<!--Google API to Create Success Chart-->
				<script type="text/javascript">
				google.load("visualization", "1", {packages:["corechart"]});
				google.setOnLoadCallback(drawChart);
				function drawChart() {
				var data = google.visualization.arrayToDataTable([
				['Success', 'count'],
				['Yes',     <?php echo $yepsuccess;?> ],
				['No',      <?php echo $nosuccess;?> ]
				]);

			
				 var options = {};
			options['backgroundColor'] = '#f3f9ff';
			options['backgroundColor.stroke'] = '#f3f9ff';
			options['backgroundColor.Width'] = '0px';


				var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
				chart.draw(data, options);
				}
				</script>

<!--FEEDBACK MAPS-->
<!--https://developers.google.com/chart/interactive/docs/gallery/geomap-->
				    <script type='text/javascript'>
   google.load('visualization', '1', {'packages': ['geomap']});
   google.setOnLoadCallback(drawMap);

    function drawMap() {
      var data = google.visualization.arrayToDataTable([
        ['Country', 'Feedback'],
        <!--Maps data from MYSQL-->
		<?php	$countrycount  = mysql_query("SELECT `country`, count(`country`) FROM  `$database`.`$iptable` group by `country`");
		while($ctry = mysql_fetch_array($countrycount)){
		//$maptable =  "['".$ctry ['country']."',".$ctry[ count('country')]."]";
		$maptable =  "['".$ctry ['country']."',".$ctry[ count('country')]."]";
		$mapcount[]= $maptable;
		}
	$comma_separated = implode(",", $mapcount);
		echo $comma_separated;
		?>

      ]);

      var options = {};
      options['dataMode'] = 'regions';
	  options['width'] = '450px';
	  options['height'] = '255px';

      var container = document.getElementById('map_canvas');
      var geomap = new google.visualization.GeoMap(container);
      geomap.draw(data, options);
  };
  </script>
  <!--END OF FEEDBACK MAPS-->


    <!--SURVEY RATE GAUGE-->
  
  <script type="text/javascript">
				google.load('visualization', '1', {packages: ['gauge']});
				</script>
				<script type="text/javascript">

				function drawVisualization() {
				// Create and populate the data table.
				var data = google.visualization.arrayToDataTable([
				['Label', 'Value'],
				['', <?php echo $comprate ?>]
				]);
				
				var options = {
				width: 100, height: 100,
				redFrom: 0, redTo: 25,
				yellowFrom: 25, yellowTo: 75,
				greenFrom:75, greenTo: 100,
				minorTicks: 5
				};

				// Create and draw the visualization.
				new google.visualization.Gauge(document.getElementById('visualization')).
				draw(data,options);
				}
				google.setOnLoadCallback(drawVisualization);
				</script>
      <!--END OF SURVEY RATE GAUGE-->
	  
	  
	  
	  
	  
	  
    <!--SURVEY CONVERSIONRATE GAUGE-->
  
  <script type="text/javascript">
				google.load('visualization', '1', {packages: ['gauge']});
				</script>
				<script type="text/javascript">

				function drawVisualization() {
				// Create and populate the data table.
				var data = google.visualization.arrayToDataTable([
				['Label', 'Value'],
				['', <?php echo $convrate ?>]
				]);
				
				var options = {
				width: 100, height: 100,
				redFrom: 0, redTo: 10,
				yellowFrom: 10, yellowTo: 50,
				greenFrom:50, greenTo: 100,
				minorTicks: 5
				};

				// Create and draw the visualization.
				new google.visualization.Gauge(document.getElementById('visualizationreq')).
				draw(data,options);
				}
				google.setOnLoadCallback(drawVisualization);
				</script>
      <!--END OF CONVERSIONRATE GAUGE-->
	  
	  
	 
<!--END GOOGLE CHARTS JAVASCRIPT-->
</body>
</html>

