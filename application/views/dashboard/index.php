
<!--<h1 class="page-header">Profile</h1>-->
<?php //var_dump($current_user);?>
<?php //var_dump($current_user_friends );?>
<?php //var_dump($all_users)?>
<h2 class="page-header">
	Welcome !! <?php echo $current_user['first_name']." ".$current_user['last_name'];?>
</h2>
<div class="row">
	<div class="col-md-6">
		<h3 class="page-header">Your friends</h3> 
		
				<?php 
					if( count($current_user_friends) == 0 )
					{
							echo "No friends added yet!!, Please add!!";
					}
					else
					{?>
						<table class="table well table-bordered">
							<thead>
								<th>Full Name</th>
								<th>Email</th>
								<th>Action</th>
							</thead>
							<tbody>
 			<?php		for ($count = 0; $count < count($current_user_friends); $count++) 
							 { 				?>				
							 	<?php 
						 		foreach ($all_users as $user)
								 {
									 if($user['id'] == $current_user_friends[$count])
									 {       ?>
									 	<tr>
									     <td><?php echo $user['first_name']." ".$user['last_name'];?></td>
										   <td><?php    echo $user['username']; ?></td>
										   <td><a href="/dashboard/view_profile/<?=$user['id']?>" class="btn btn-success">View Profile</a></td>
										   <td><a href="/dashboard/remove_friend/<?=$current_user['user_id']?>/<?=$user['id']?>" class="btn btn-danger">Remove friend</a></td>
	 									</tr> 	
	 <?php           
									 }
								 }       
						}?>
							</tbody>
						</table>
<?php 		}								?>	 
			
	</div>
	
	<div class="col-md-6">
		<h3 class="page-header">Users not in your friends list</h3> 
		<?php 
			if(count($other_users)==1 && $other_users[0]['id']==$current_user['user_id'])
			{
				echo "You have added all the users to ur friends list....";
			}
			else
				{ ?>
						<table class="table well table-bordered">
							<thead>
								<th>Full Name</th>
								<th>Email</th>
								<th>Action</th>
							</thead>
							<tbody>
							 <?php 
							 	 foreach ($other_users as $key => $user) 
							 	 	if($user['id'] != $current_user['user_id'])
									 	  {
							 	 	{?>
							 		<tr>
							 				<td> <?php echo $user['first_name']." ".$user['last_name'];?></td>
							 	  		<td> <?php echo $user['username'];?> </td>
							 	  		<td><a href="/dashboard/view_profile/<?=$user['id']?>" class="btn btn-success">View Profile</a></td>
							 	  		<td>
											<a href="/dashboard/add_friend/<?=$current_user['user_id']?>/<?=$user['id']?>" class="btn btn-primary">Add friend</a>
										</td>
									</tr>
							 <?php	 } }
							 ?>	
							</tbody>
						</table>
<?php				}
		?>
	</div>
</div>

 