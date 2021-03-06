<?php
include("php/config.php");
include("php/onTablefunc.php");
session_start();
	if(!isset($_SESSION['ad_Uname'])) {
		header("Location:/project/index.php");
	}
?>
<!DOCTYPE html>
<html>
<head> 
	<meta charset="utf-8">
	<title></title> 
	<link rel="stylesheet" type="text/css" href="css/all.min.css">
	<link rel="stylesheet" type="text/css" href="css/fontawesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/panel.css">
	<script type="text/javascript" src = "js/jquery.js"></script>
	<link rel="stylesheet" type="text/css" href="css/table.css">
	<script src = "js/panel.js" type="text/javascript">
	</script>
	<!-- DataTable files -->
	<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"> 
	<script type="text/javascript" src="DataTables/datatables.min.js"></script>
</head> 
<body>
	<div class="container">
		<div class="navigation">
		<div class="admin_icon">	
			<a href="">
					<i class="fas fa-user-cog"></i>
				<span class="admin_Text" >Admin</span>
			</a>
		</div>	
			<ul>
				<li>
					<a href="admin.php" class= "dactive">
						<span class="icon">	
							<i class="fas fa-columns"></i>
						</span>
						<span class="title">Dashboard</span>
					</a>
				</li>	
				<li>
					<a href="elections.php">
						<span class="icon">	
							<i class="fas fa-poll"></i>
						</span>
						<span class="title">Election</span>
					</a>
				</li>
				<li>
					<a href="applicants.php">
						<span class="icon">	
							<i class="far fa-sticky-note"></i>
						</span>
						<span class="title">Applicants</span>
					</a>
				</li>
				<li>
					<a href="users.php">
						<span class="icon">	
							<i class="fas fa-users"></i>
						</span>
						<span class="title">Users</span>
					</a>
				</li>
				<li>
					<a href="/project/php/logout.php">
						<span class="icon">	
							<i class="fas fa-sign-out-alt"></i>

						</span>
						<span class="title">Sign Out</span>
					</a>
				</li>
			</ul>
		</div>
		<div class="main">
			<!-- Topbar containing navigation icon and admin image -->
			<div class="topbar">
				<div class="toggle" onclick="minimise()">				
				</div>
				<div class="user">
					<a href="adminacc.php"><img src="images/admin_photo.png"></a>
				</div>
			</div>
			<!-- Display List of Candidate Applicants -->
			<div class="tables_Area">
				<div class="t_Heading" style="display:block;">
					<h2>Candidate Applicants</h2>
					<table id="applicants_Table" class="table Candidates">
						<thead>
							<tr>
								<th>Election</th>
								<th>Name</th>
								<th>Department</th>
								<th>Year</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php 
						$selectQ = "select * from applicant;";
						$result = mysql_query($selectQ,$con);
						while($data = mysql_fetch_array($result)){	
							$eid = $data['Election_id'];
							$e_status = getE_State($eid,$con);
							if($e_status != 0)
								continue;
							else{
								$uid = $data['User_id'];
								$studata = getStuData($uid,$con);
								$name = $studata['First_name']." ".$studata['Last_name'];
								$dept = getDepartment($studata['Department_id'],$con);
								$yr = getyear($studata['Year_id'],$con);
								$eleName = getEleName($eid,$con);
								$appid = $data['id'];
							
							?>
						<tr>
							<td><?php echo $eleName; ?> </td>
							<td><?php echo $name; ?> </td>
							<td><?php echo $dept; ?> </td>
							<td><?php echo $yr; ?> </td>
							<td><a href="applicantView.php?uid=<?php echo $uid; ?>&appid=<?php echo $appid; ?>"  class="button View">View</a></td>
						</tr>	
						</tbody>
					<?php }} ?>
					</table>
				</div>
				<script type="text/javascript">
		$(document).ready(function() {
    $('#applicants_Table').DataTable({
    	'columnDefs': [{
    		'targets':4,
    		'orderable':false,
    	}]
    });
} );	
</script>
			</div>
		</div>
	</div>

</body>
</html>

