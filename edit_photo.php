 
<!--============================================== Display photo to edit ==================================================== -->
 <div class="container" id="edit_photo_container">	
<?php
if (isset($_GET['edit']) && intval($_GET['edit']) > 0) {
	
	//select from database photo that user wants to edit
	 $id = intval($_GET['edit']);
	 $stmt = $dbh->prepare("SELECT * FROM photos WHERE id = :id");
	 $stmt->execute([':id' => $id]);
	    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

	    			//display image and text editor (TinyMCE) to edit photo category or description
	                print '<img class="photo_from_edit" src="uploads/'.htmlspecialchars($row['path']).'" alt="photo">	               
		            		<form id="edit_form" action="index.php?page=edit_photo&edit='.htmlspecialchars($row['id']).'" method="POST">
		               			 <input id="input_edit_category"  type="textarea" name="category" value="'.htmlspecialchars($row['category']).'" >
		               			 <input class = "art-editor input_edit" type="textarea" style="width: 730px" name="description" value="'.htmlspecialchars($row['description']).'">		 
	       						 <input class="submitButton" type="submit" value="Save">
       						</form>';  
	    }   
}
?>	
</div>


<!--============================================ Send changes to database ==================================================== -->
<?php

    if (isset($_POST['category']) || isset($_POST['description'])) {
    	$id = intval($_GET['edit']);
        
        try{
             $stmt = $dbh->prepare("UPDATE photos SET category = :category, description = :description WHERE id = :id");
             $stmt->execute([':category' => $_POST["category"], ':description' => $_POST["description"], ':id' => $id]);
             header("Location: /gallery");

         }catch(PDOException $e){
            print '<span style="color: red;"> Fail </span>';
        }
    }

?>



