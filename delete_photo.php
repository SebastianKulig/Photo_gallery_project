<?php
if (isset($_GET['delete'])) {

    $path = ($_GET['delete']);
    try{
    	// delete photo from database and upload folder. Then reload page.
        $stmt = $dbh->prepare("DELETE FROM photos WHERE path = :path");
        $stmt->execute([':path' => $path]);
        unlink("uploads/".$path);
        header("Location: /gallery");

    }catch(PDOException $e){
    	print '<span style="color: red;">Cannot delete photo</span>';
    	header("Location: /gallery");
 	}    
}
