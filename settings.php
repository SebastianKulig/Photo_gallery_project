
<!-- ------------------------------------ Settings form ------------------------------------------- -->
<div class="container"  id="settings-container">
	<form id="settings-form">
		<div id="settings-title">
			<p>Thumbnails</p>
		</div><hr>

		<div>
  			<input type="radio" id="squeeze" name="thumbnails_style" value="squeeze" checked>
  			<label for="squeeze">squeeze - the photo will be squeezed to chosen measurements</label>
		</div>

		<div>
 			 <input type="radio" id="cut" name="thumbnails_style" value="cut">
 			 <label for="cut">cut - the central part of photo will be a thumbnail, the rest will be cut off</label>
		</div>

  		
        <label for="sizeHeight">Height</label><br>
        <input type="number" placeholder="Type height of thumbnails" id="thumbnail_height"><br>
        <label for="sizeWidth">Width</label><br>
        <input type="number" placeholder="Type width of thumbnails" id="thumbnail_width"><br>
             
        <button class="submitButton" type="button" onclick="getInputValue();">Change</button>
        

</form>
	</div>
</div>
<!-- -------------------------------------------------------------------------------------------------------------- -->

<script type="text/javascript">
  //set radio button 
	(function(){
		if(localStorage.getItem("thumbnail_style") == "cut"){
			document.getElementById("cut").checked = true;
		}else{
			document.getElementById("squeeze").checked = true;
		}
	})();

	
	function getInputValue(){
    // save user preference in local storage (height, width and style). Values from local storage are later used to display gallery in right style
        let input_height = document.getElementById("thumbnail_height").value;      
        localStorage.setItem("thumbnail_height", input_height);
                     	
        let input_width = document.getElementById("thumbnail_width").value;
       	localStorage.setItem("thumbnail_width", input_width);

        let style_radio_button = document.getElementsByName("thumbnails_style");
        for (let i = 0, length = style_radio_button.length; i < length; i++) {
    			if (style_radio_button[i].checked) {
      			localStorage.setItem("thumbnail_style", style_radio_button[i].value);
      			window.location.href = "/gallery";
      			break;// only one radio can be logically checked, don't check the rest
    				}
  		  }
    }

</script>