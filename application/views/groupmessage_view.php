	<div class="headline container-fluid">
		<div class="row">
			<div class="col-xs-4 nopadding">
				<button id="back-link" class="backbutton">Back</button>
			</div>
			<div class="col-xs-8 nopadding headline">
				<h1>Group Messages</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-offset-1 col-xs-11 nopadding">
				<img class="underline" src="<?php echo base_url('/assets/img/tinderbox_single_line.svg'); ?>">
			</div>
		</div>
	</div>


	<div class="container">
		<img class="image-size" src="<?php echo base_url('/assets/img/group.png'); ?>">
	</div>

<footer>
  <div class="footer">
    <div class="social-media">
      <span headline>Follow us</span>
      <div class="social-media-icons">
        <i class="fa fa-facebook-official" aria-hidden="true"></i>
        <i class="fa fa-instagram" aria-hidden="true"></i>
        <i class="fa fa-twitter" aria-hidden="true"></i>
        <i class="fa fa-spotify" aria-hidden="true"></i>
      </div>
    </div>
    <div class="tuborg">
      <img src="images/tuborg.svg">
    </div>
  </div>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="js/scripts.js"></script>
<script type="text/javascript"> 
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

window.onclick = function(event) {
  if (event.target.matches('.dropdown')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>

<script type="text/javascript">
$( document ).ready(function() {
	$("#toc").append('<h2>Table of contents</h2><ul></ul>');
	$("h2").each(function(i) {
	    var current = $(this);
	    current.attr("id", "title" + i);
	    $("#toc ul").append("<li><a id='link" + i + "' href='#title" +
	        i + "' title='" + current.attr("tagName") + "'>" + 
	        current.html() + "</a></li>");
	});
});
</script>
 </body>
</html>