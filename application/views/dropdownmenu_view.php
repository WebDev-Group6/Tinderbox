	<div class="headline container-fluid">
		<div class="row">
			<h1>Headline</h1>
			<div class="underline"><img src="images/tinderbox_single_line.svg"></div>
		</div>
	</div>


 <div class="dropdown">
  <button onclick="myFunction()" class="dropbtn"><i class="fa fa-bars" aria-hidden="true"></i>
</button>
  <div id="myDropdown" class="dropdown-content">
    <a href="#">SCHEDULE</a>
    <a href="#">MESSAGES</a>
    <a href="#">QR CODES</a>
    <a href="#">FYI</a>
    <li class="call"><a href="#">CALL SECURITY</a></li>
  </div>
</div>
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