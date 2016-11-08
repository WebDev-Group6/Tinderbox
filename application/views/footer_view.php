<footer>
	<div class="footer">
		<div class="social-media">
			<span>Follow us</span>
			<div class="social-media-icons">
				<i class="fa fa-facebook-official" aria-hidden="true"></i>
				<i class="fa fa-instagram" aria-hidden="true"></i>
				<i class="fa fa-twitter" aria-hidden="true"></i>
				<i class="fa fa-spotify" aria-hidden="true"></i>
			</div>
		</div>
		<div class="tuborg">
			<img src="assets/img/tuborg.svg">
		</div>
	</div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="js/scripts.js"></script>

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