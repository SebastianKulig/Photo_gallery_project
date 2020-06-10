<?php
if (isset($_GET['delete'])) {
	try{
			//delete choosen category from database. Then reload page
			$stmt = $dbh->prepare("UPDATE photos SET category = :empty WHERE category = :category");
			$stmt->execute([':empty' => "", ':category' => $_GET['delete'] ]);
			header("Location: /gallery"); 
			             	            
	}catch(PDOException $e){
			            print '<span style="color: red;"> Fail </span>';
	}	
}


?>	