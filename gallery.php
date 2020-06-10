<div class="container"  id="photoGalleryDiv">


<?php
//===================================================== Display all photos from database =============================================

            //select all photos from database
            $stmt = $dbh->prepare("SELECT * FROM photos ORDER BY id DESC");
            $stmt->execute();
            $category = array();
            

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                //save all not empty categories (we use it later to display category buttons)
                if(!in_array($row['category'], $category) && ($row['category'] != "")){
                    array_push($category, $row['category']);
                }

                //display all photos from database (in cards from bootstrap)
                print' <div class="photo-card-container "> <!--col-sm-12 col-md-4 col-lg-3 id="photo-card" -->
                            <div class="card ">
                                <div class="viewport">
                                 <img  class="myImg" src="uploads/'.$row['path'].'" alt='.$row['category'].'  >
                                 </div>
                                        <div class="card-body">

                                            <div class="image_descryption"><p class="card-text"><span>Description:</span> '.$row['description'].'</p></div>
                                            <div class="image_category"><p class="card-text"><span>Category:</span> '.$row['category'].'</p></div>
                                         
                                            <div class="btn-group">
                                                  <a href = "index.php?page=edit_photo&edit='.intval($row['id']).'"  class="btn btn-secondary btn-sm btn-outline-secondary">Edit</a>
                                                  <a href = "index.php?page=delete_photo&delete='.($row['path']).'" class="btn btn-secondary btn-sm btn-outline-secondary">Delete</a> 
                                            </div>
                                        
                                    </div>
                            </div>
                        </div>



                <!-- ------------ The Modal - display an image in full size in modal window ------------- -->

                            <div  class="modal myModal">

                              <!-- The Close Button -->
                              <span class="close">&times;</span>

                              <!-- Modal Content (The Image) -->
                              <img  class="modal-content img01" >

                              <!-- Modal Caption (Image Text) -->
                              <div class="caption"></div>
                            </div>';             
            }


//------------------------------------ Display "category" buttons and "delete category" buttons -------------------------------

            //for each category from $category, create "category button" and "delete category button"
            foreach ($category as $cat) {
                print'
                <script>
                    
                    buttons_div = document.createElement("div");
                    buttons_div.classList.add("buttons_div");
                    
                    category = document.createElement("a");
                    category.href ="index.php?page=filter_category&category='. $cat.'";
                    category.classList.add("category_buttons");
                    category.classList.add("btn");
                    category.classList.add("btn-primary");
                    category.innerHTML = "'.$cat.'";

                    buttons_div.appendChild(category);
                   
                    delete_category_button = document.createElement("a");
                    delete_category_button.href = "index.php?page=delete_category&delete='. $cat.'";
                    delete_category_button.classList.add("delete_category_buttons");

                    buttons_div.appendChild(delete_category_button);

                    $("#category_buttons_container").append(buttons_div);
                </script>';
                
            } 
                                 
    ?>
</div>
        <!--script that display photos in full size afer click -->
<script src="/js/displayInFullSize.js"></script>




                
