
//----------------------------------------- Changing size of thumbnails---------------------------------------------

  //an immediately invoked function that checks to see if the size is in local storage already (for example when page was refreshed)
  (function(){
     //user cannot set the size of thumbnail smaller than 200px. Default value = 300px
    if(localStorage.getItem("thumbnail_height") < 200){
      localStorage.setItem("thumbnail_height", 300);
    }
    if(localStorage.getItem("thumbnail_width") < 200){
      localStorage.setItem("thumbnail_width", 300);
    }

    //check which style of thumbnails user want to
    if(localStorage.getItem("thumbnail_style") == "cut"){
      const img = document.querySelectorAll(".myImg");
      
      const image_container_to_resize = document.querySelectorAll(".photo-card-container");
      
    	for (let i = 0; i < image_container_to_resize.length; i++) {
        
        

        //change size of card with photo, category, description, buttons.
        image_container_to_resize[i].style.width = localStorage.getItem("thumbnail_width") + "px";
        image_container_to_resize[i].style.height = 1.5*localStorage.getItem("thumbnail_height") + "px";
        
        //when photos will be ready cut the thumbnail and change size of div
        if(img[i].complete){
 
          setViewport(image_container_to_resize[i], img[i], img[i].width, img[i].height, localStorage.getItem("thumbnail_width"), localStorage.getItem("thumbnail_height") );
        }else{
              img[i].addEventListener("load", function(){
                setViewport(image_container_to_resize[i], this, this.width, this.height, localStorage.getItem("thumbnail_width"), localStorage.getItem("thumbnail_height") );
              });
        }
      

        }
               
    }else{
      //if user choosed squeezed we just change width and height of photo and div
      changeSizeHeight(localStorage.getItem("thumbnail_height"));
      changeSizeWidth(localStorage.getItem("thumbnail_width"));
    }
  	
    })();

    // cut a piece of photo for thumbnail (by changing size of container with photo)
    function setViewport(container, img, x, y, width, height) {
      //choose the central part of photo as thumbnail

          if(x >= width){
            offsetX = (x-width)/2;
          }else{
            offsetX = 0;
          }

          if(y >= height){ 
            offsetY = (y-height)/2;
          }else{
            offsetY = 0;
          }

			    img.style.left = "-" + offsetX + "px";
          img.style.top  = "-" + offsetY + "px";
          //change size of container with photo
			    if (width !== undefined) {
			        img.parentNode.style.width  = width  + "px";
			        img.parentNode.style.height = height + "px";
		       }
		 }
	

    //method that change height of thumbnails and divs with them on page 
    function changeSizeHeight(height){
      if(height != 0){
        const image_to_resize = document.querySelectorAll(".myImg");
        const image_container_to_resize = document.querySelectorAll(".photo-card-container");
        const image_viewport_to_resize = document.querySelectorAll(".viewport");
        
          for (let i = 0; i < image_to_resize.length; i++) {
               image_to_resize[i].style.height = localStorage.getItem("thumbnail_height")+ "px";
               image_viewport_to_resize[i].style.height = localStorage.getItem("thumbnail_height")+ "px";
               image_container_to_resize[i].style.height = 1.5*localStorage.getItem("thumbnail_height")+ "px";
          }
      }
    }

      //method that change width of thumbnails and divs with them on page 
      function changeSizeWidth(width){
        if(width != 0){
          const image_to_resize = document.querySelectorAll(".myImg");
          const image_container_to_resize = document.querySelectorAll(".photo-card-container");
          const image_viewport_to_resize = document.querySelectorAll(".viewport");
          
            for (let i = 0; i < image_to_resize.length; i++) {
                 image_to_resize[i].style.width = localStorage.getItem("thumbnail_width") +  "px";
                 image_viewport_to_resize[i].style.width = localStorage.getItem("thumbnail_width") +  "px";
                 image_container_to_resize[i].style.width = localStorage.getItem("thumbnail_width")+ "px";
            }
        }
      }
       

                   

	
       