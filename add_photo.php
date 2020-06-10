<?php
    
            //------------------- Prepare list of existing categories (for drop down list in form) -----------------------
          $stmt = $dbh->prepare("SELECT * FROM photos ORDER BY id DESC");
          $stmt->execute();
          $category = array();
            
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              if(!in_array($row['category'], $category)){
                   array_push($category, $row['category']);
              }
          }
         //-------------------------------------------------------------------------------- 

    ?>




<!--======================================================== Upload form ===================================================== -->
<section>
  <form id="fileupload" action="https://s03.labwww.pl/index.php?page=add_photo" method="POST" enctype="multipart/form-data"> 
    <div class="container" id="drag-and-drop-container">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
                <div id="error"></div>
                <div id="success"></div>
            <div class="preview-zone hidden">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <div><b>Preview</b></div>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-danger btn-xs remove-preview">
                      <i class="fa fa-times"></i> Reset The Field
                    </button>
                  </div>
                </div>
                <div class="box-body"></div>
              </div>
            </div>
            <div class="dropzone-wrapper">
              <div class="dropzone-desc">
                <i class="glyphicon glyphicon-download-alt"></i>
                <p>Choose an image file or drag it here.</p>
              </div>
            
              <input type="file" name="fileInput" class="dropzone" id="fileInput" aria-describedby="fileInput" >
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
      <label >Description</label><br/>
         <input type="text" name="photoDescription"><br/>
         <label >Create own category ...</label><br/>
         <input type="text" id="new-category" name="photoCategoryNew"><br/> 
         <label >or choose one of this</label><br/>
         <select id="list-of-categories"name="photoCategory">
             <option value="" >Choose category</option>
                       <!-- print all existing categories -->
               <?php
                 foreach ($category as $cat) {
                 	if($cat != ""){
                   		print ' <option value="'.$cat.'">'.$cat.'</option>';
                   	}
                 }
               ?>
           </select>
       </div>
   </div>
 
      <div class="row">
        <div class="col-md-12">
         <input class="submitButton" type="submit"  value="Submit"> 
        </div>
      </div>
    </div>
  </form>
</section>

 <!--script that is responsible for drag&drop upload -->
        <script src="/js/adding_photo.js"></script>
        


<?php

 if (isset($_FILES['fileInput']) and ($_SERVER["REQUEST_METHOD"] == "POST") ){	
  //=============================== input validation ===========================================
        
        //----------------------Check image extension-------------------------------------
        $alloweFileExtensions = array("jpg", "png", "jpeg");
        $file = $_FILES['fileInput'];
        $fileName = $file["name"];
        $fileExtension = explode(".", $fileName);
        $fileExtension = strtolower(end($fileExtension));

        
        if(!in_array($fileExtension, $alloweFileExtensions)){

            print '<script> document.getElementById("error").innerHTML = "Uploaded file is not a valid image. Only jpg, png and jpeg files are allowed"; </script>';

            exit();
        }
        //--------------------------------------------------------------------------------



        //----------------------Check image size------------------------------------------
        $fileSize = $file["size"];
        if($fileSize > 21000000){         //20MB
          print '<script> document.addEventListener("load", function() { document.getElementById("error").innerHTML = "File is too big"}); </script>';

          exit();
        }
        //--------------------------------------------------------------------------------


        //--------------------- Check image category--------------------------------------
        if(strlen($_POST['photoCategoryNew']) != 0 and strlen($_POST['photoCategory']) != 0){
              print '<script> document.addEventListener("load", function() { document.getElementById("error").innerHTML = "Choose only one category"}); </script>';
             
              exit();     
        }elseif(strlen($_POST['photoCategory']) == 0){
              $categoryToUpload =  $_POST['photoCategoryNew'];
        }else{
              $categoryToUpload = $_POST['photoCategory'];
        }
        //--------------------------------------------------------------------------------

        //----------------------- Upload photo -------------------------------------------
        $targetFile = time() . basename($_FILES['fileInput']['name']);

          if ( move_uploaded_file($_FILES['fileInput']['tmp_name'], "uploads/" . $targetFile)){          
              $stmt = $dbh->prepare(" INSERT INTO photos (path, description, category) VALUES (:path, :description, :category)");
              $stmt->execute( [':path' => $targetFile, ':description' => $_POST['photoDescription'], ':category' => $categoryToUpload] );
               print '<script> document.addEventListener("DOMContentLoaded", function() { document.getElementById("success").innerHTML = "Photo uploaded successfully"});  </script>';
               echo json_encode(array('success'=>'true'));

          }else{
               print '<script> document.addEventListener("DOMContentLoaded", function() { document.getElementById("error").innerHTML = "Server error"}); </script>';
          } 
    }
        //--------------------------------------------------------------------------------
    ?>