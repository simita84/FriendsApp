<h2 class="page-header">User profile for  
	 <?php echo $user_details['first_name']." ".$user_details['last_name'];?>
</h2>
 
 <div class="row">
 	<div class="col-md-6">
 		 <ul class="nav">
		 	<li>	ID :		 <?php echo $user_details['id'];?>			</li>
		 	<li>	First Name : <?php echo $user_details['first_name'];?>	</li>
		 	<li>	Last Name :  <?php echo $user_details['last_name'];?>	</li>
		 	<li>	UserName : 	 <?php echo $user_details['username'];?>	</li>
		 	<li>	Created At : <?php echo $user_details['created_at'];?>	</li>
 		</ul>
 	</div>
 </div>

 