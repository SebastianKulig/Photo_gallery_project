
//================================= display image in full size after click =============================
$().ready(function() {
    var modal = $('.myModal');
    modal.each(function(index) {

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        let img = $('.myImg')[index]; 
        let modalImg = $('.img01')[index];
        let captionText = $('.caption')[index];
        
        img.onclick = function(){      
          modal[index].style.display = "block";
          modalImg.src = this.src;
          captionText.innerHTML = this.alt;

                  // Get the <span> element that closes the modal
        }
        let span = $('.close')[index];
        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {

          modal[index].style.display = "none";
        }
       
    })
});




