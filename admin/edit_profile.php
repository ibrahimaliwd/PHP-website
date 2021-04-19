﻿<?php include("inc/header.php"); ?> 



			<?php 
					if (empty($_GET['id'])){
					}elseif(!isset($_GET['id']) || $_GET['id'] == NULL){
						echo 'Something went to wrong';
					}else{
							$tid= $_GET['id'];
							$id= preg_replace("/[^0-9a-zA-Z]/", "", $tid);
							$rid = $id;
					}
				?>
						
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Profile Information</h2>
                <div class="block">  
				
				<?php 
					if ($_SERVER["REQUEST_METHOD"] =="POST"){
						$fname				        =$fm->validation($_POST['fname']);
						$lname			    		=$fm->validation($_POST['lname']);
						$email				        =$fm->validation($_POST['email']);
						
						
						$fname				        =mysqli_real_escape_string($db->link,$fname);
						$lname						=mysqli_real_escape_string($db->link,$lname);
						$email						=mysqli_real_escape_string($db->link,$email);
					
						
						$permited  = array('jpg', 'jpeg', 'png', 'gif');
						$file_name = $_FILES['image']['name'];
						$file_size = $_FILES['image']['size'];
						$file_temp = $_FILES['image']['tmp_name'];

						$div = explode('.', $file_name);
						$file_ext = strtolower(end($div));
						$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
						$uploaded_image = "img/".$unique_image;

						if (empty($uploaded_image)) {
							 $query="UPDATE admin_user SET
								firstname				='$fname',	
								lastname            	='$lname',
								email                	='$email',
								photo                	='$uploaded_image'
								
								WHERE id                =$id";
							
							$results=$db->insert($query);
							if($results==true){
								echo"<div class='well'> 
								<h2 style='color:green; font-weight:bold; text-align:center; background:#eee;'> 
								Succesfully Update But profile photo not upload<h2> 
								
								</div>";
							}else{
								echo"Not Update";
							}
						} else{
							move_uploaded_file($file_temp, $uploaded_image);
							$query="UPDATE admin_user SET
							firstname				='$fname',	
							lastname            	='$lname',
							email                	='$email',
							photo                	='$uploaded_image'
							
							WHERE id                =$id";
						
						$results=$db->update($query);
						if($results==true){
							echo"<div class='well'> 
							<h2 style='color:green; font-weight:bold; text-align:center; background:#eee;'> 
							Succesfully Update <h2> 
							
							</div>";
						}else{
							echo"Not Update";
						}
					}
					}
					?>
			
				<?php
				$query ="SELECT * FROM admin_user where id=$id";
				   
				$results = $db->select($query);

				if ($results){?>
				<?php while ($showpost = $results->fetch_assoc()) {

				?> 	
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>First Name:</label>
                            </td>
                            <td>
                                <input type="text" class="medium" name="fname" value="<?php echo $showpost['firstname'];?>"/>
                            </td>
                        </tr>
						<tr>
                            <td>
                                <label>Last Name:</label>
                            </td>
                            <td>
                                <input type="text" class="medium" name="lname" value="<?php echo $showpost['lastname'];?>"/>
                            </td>
                        </tr>
						<tr>
                            <td>
                                <label>E-mail:</label>
                            </td>
                            <td>
                                <input type="text" class="medium" name="email" value="<?php echo $showpost['email'];?>"/>
                            </td>
                        </tr>
						<tr>
                            <td>
                                <label>Profile Photo:</label>
                            </td>
                            <td>
								<img src="<?php echo $showpost['photo'];?>" alt="Admin Photo"  style="height:150px; width:150px;"/>
                                <input type="file" class="medium" name="image" />
                            </td>
                        </tr>
                     
                                       
                    
                        <!--<tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <input type="file" />
                            </td>
                        </tr>--> 
                        
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update Information" />
                            </td>
                        </tr>
                    </table>
                    </form>					
					<?php }?> 
					<?php }?> 
                </div>
            </div>
        </div>
		
		
		
<?php include("inc/footer.php"); ?> 