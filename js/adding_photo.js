//===================================== Adding photo ============================================

  //if user write sth in new-category field, disable list of existing categories 
  const new_category = document.getElementById("new-category");
  const list_of_categories = document.getElementById("list-of-categories");

	new_category.addEventListener("blur", enableList);
	new_category.addEventListener("input", disableList);

  //if user chooses category from list, disable new-category field
  list_of_categories.addEventListener("click", disableNewCategory);
  list_of_categories.addEventListener("blur", enableNewCategory);
	
	function disableList(){
		list_of_categories.disabled = true;
	}
	
	function enableList(){
		if(new_category.value.length == 0){
			list_of_categories.disabled = false;
		}
	}

  function disableNewCategory(){
    new_category.disabled = true;
  }

  function enableNewCategory(){
    if(list_of_categories.value.length == 0){
      new_category.disabled = false;
    }
  }


//=================================================== Drag $ drop ==============================================================
function readFile(input) {
	
	//Display photo preview
  if (input.files && input.files[0]) {
    let reader = new FileReader();
    reader.onload = function(e) {
      let htmlPreview =
        '<img width="200" src="' + e.target.result + '" />' +
        '<p>' + input.files[0].name + '</p>';
      let wrapperZone = $(input).parent();
      let previewZone = $(input).parent().parent().find('.preview-zone');
      let boxZone = $(input).parent().parent().find('.preview-zone').find('.box').find('.box-body');
 	
      wrapperZone.removeClass('dragover');
      previewZone.removeClass('hidden');
      boxZone.empty();
      boxZone.append(htmlPreview);
    };
    reader.readAsDataURL(input.files[0]);
  }
}
 
function reset(e) {
  e.wrap('<form>').closest('form').get(0).reset();
  e.unwrap();
}


//-----------------Detect browsers-----------------

// Internet Explorer 6-11
var isIE = /*@cc_on!@*/false || !!document.documentMode;
// Edge 20+
var isEdge = !isIE && !!window.StyleMedia; 

//--------------------------- Drag & drop upload for Edge and IE ------------------------------
 if(isIE || isEdge){
 	const form = $("#fileupload");

 	//delete type=submit attribute from button to avoid sending form 
 	$(".submitButton").removeAttr("type");
 	//when user drop file display preview (readfile function)
    $('.dropzone').on('drop', function (e) {
        e.stopPropagation();
        e.preventDefault();

        fileInput = document.getElementById('fileInput');
        fileInput.files[0] = e.originalEvent.dataTransfer.files[0];
       	readFile(this);
    }); 


    // when user press submit button send data through ajax and go to gallery
    $(".submitButton").on("click", function(){
    	
    	const ajaxData = new FormData(form.get(0));
    	ajaxData.append( $('.dropzone').attr('name'), fileInput.files[0] );
    	
		    $.ajax({
		    url: "https://s03.labwww.pl/index.php?page=add_photo",
		    type: "POST",
		    method: "POST",
		    data: ajaxData,
		    cache: false,
		    contentType: false,
		    processData: false,
		    success: function(data, textStatus, xhr) {
		    	window.location.href = "/gallery";
		    },
		    error: function(jqXHR, textStatus, errorThrown) {

		    	window.location.href = "/gallery";
		    }
		 	 }); 	

    })
    } 


//----------------------------- Uploading file through drag&drop for other browsers ----------------------------

//display preview
 $(".dropzone").change(function() {
  readFile(this);
});

//prevent default browser reaction for drag and drop
 $('.dropzone-wrapper').on('dragover', function(e) {
  e.preventDefault();
  e.stopPropagation();
  $(this).addClass('dragover');
});
 
$('.dropzone-wrapper').on('dragleave', function(e) {
  e.preventDefault();
  e.stopPropagation();
  $(this).removeClass('dragover');
});


//reset preview when user click reset button 
$('.remove-preview').on('click', function() {
  var boxZone = $(this).parents('.preview-zone').find('.box-body');
  var previewZone = $(this).parents('.preview-zone');
  var dropzone = $(this).parents('.form-group').find('.dropzone');
  boxZone.empty();
  previewZone.addClass('hidden');
  reset(dropzone);
});
























