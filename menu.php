<?php
	$q="select distinct menu.menuid,menuname from permissions left join menu on permissions.menuid=menu.menuid where gid=".$thisgroupid;
	//echo "<br><br>".$q;
	$result=$conn->query($q);
	if ($conn->connect_error) {
		die("Connect Error (" . $conn->connect_errno . ") ". $conn->connect_error);
	}
	
?>
<nav class="navbar navbar-default">
Default
</nav>
<nav class="navbar fixed-top navbar-expand-md navbar-dark bg-primary  py-0" rounded>
	<a class="navbar-brand small" href="#">
		<img src="img/marinelogo.png" width="30" alt="">
		MAPIS
	</a>
	<button class="navbar-toggler" 
	type="button" 
	data-toggle="collapse" 
	data-target="#navbarTogglerMarine" >
	<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarTogglerMarine">
		<ul class="navbar-nav mr-auto">
		<?php
			while($row=$result->fetch_assoc()){
				?>
				<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="qmDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<?=$row["menuname"]?>
				</a>
				<div class="dropdown-menu" area-labelledby="qmDropdown">
					<?php 
						//$q="select permissions.submenuid, menuname from permissions left join submenu on permissions.submenuid= submenu.submenuid where permissions.menuid=".$row["menuid"];
						$q="select submenuid, menuname from submenu where menuid=".$row["menuid"];
						//echo $q;
						$result2=$conn->query($q);
						if ($conn->connect_error) {
    						die("Connect Error (" . $conn->connect_errno . ") ". $conn->connect_error);
						}
						while($row2=$result2->fetch_assoc()){
							?>
							<a class="dropdown-item" href="index.php?id=<?=$thisuserid?>&app_id=<?=$row2["submenuid"]?>">
							<?=$row2["menuname"]?>
							</a>	
							<?php 
						}
						$result2->free();
					?>
				</div>
			</li>
		<?php
			}
			$result->free();
		
		?>
		
		</ul>
		<ul class="navbar-nav ml-auto">
			<li class="nav-item">
				<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<?=$thisusername?>
				</a>
				<div class="dropdown-menu" area-labelledby="userDropdown">
					<?php
					if($thisgroupid==1){
					?>
					<a class="dropdown-item" href="index.php?id=<?=$thisuserid?>&app_id=-1">Users</a>
					<a class="dropdown-item" href="index.php?id=<?=$thisuserid?>&app_id=-2">Groups</a>
					<a class="dropdown-item" href="index.php?id=<?=$thisuserid?>&app_id=-3">Permissions</a>
					<a class="dropdown-item" href="index.php?id=<?=$thisuserid?>&app_id=-4">Menus</a>
					<a class="dropdown-item" href="index.php?id=<?=$thisuserid?>&app_id=-5">Submenus</a>
					<?php
					}
					?>
					<a class="dropdown-item">Email</a>
					<a class="dropdown-item">Contact Admin</a>
				</div>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="signout.php?id=<?=$thisuserid?>">Logout
				</a>
			</li>
		</ul>
	</div>
</nav>