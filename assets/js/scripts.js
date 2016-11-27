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

function toggleDropdown() {
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
};

// jQuery(document).ready(function() {
//   jQuery('#back-link').click(function() {
//      history.go(-1) 
//    });
// });