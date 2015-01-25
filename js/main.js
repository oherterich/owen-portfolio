var covers = document.getElementsByClassName('cover');

for ( var i = 0; i < covers.length; i++ ) {
	var cover = covers[i];

	cover.addEventListener('mouseover', function(evt) {
		this.childNodes[1].classList.add('projectname-visible');
		this.childNodes[1].classList.remove('projectname-hidden');
		this.childNodes[3].classList.add('projectname-visible');
		this.childNodes[3].classList.remove('projectname-hidden');
	});

	cover.addEventListener('mouseout', function(evt) {
		this.childNodes[1].classList.add('projectname-hidden');
		this.childNodes[1].classList.remove('projectname-visible');
		this.childNodes[3].classList.add('projectname-hidden');
		this.childNodes[3].classList.remove('projectname-visible');
	});
}

//Sorting the projects
$(document).ready( function() {

	$('#sort-all').click( function() {
		$.each($('#projects article'), function(index, project) {
			$(project).fadeIn(200);
		});

		$('#sort-all').removeClass('sort-inactive').addClass('sort-active');
		$('#sort-design').removeClass('sort-active').addClass('sort-inactive');
		$('#sort-technology').removeClass('sort-active').addClass('sort-inactive');
		$('#sort-other').removeClass('sort-active').addClass('sort-inactive');
	});

	$('#sort-design').click( function() {
		$.each($('#projects article'), function(index, project) {
			if ($(project).hasClass('design'))
				$(project).fadeIn(200);
			else
				$(project).fadeOut(200);
		});

		$('#sort-all').removeClass('sort-active').addClass('sort-inactive');
		$('#sort-design').removeClass('sort-inactive').addClass('sort-active');
		$('#sort-technology').removeClass('sort-active').addClass('sort-inactive');
		$('#sort-other').removeClass('sort-active').addClass('sort-inactive');
	});

	$('#sort-technology').click( function() {
		$.each($('#projects article'), function(index, project) {
			if ($(project).hasClass('technology'))
				$(project).fadeIn(200);
			else
				$(project).fadeOut(200);
		});

		$('#sort-all').removeClass('sort-active').addClass('sort-inactive');
		$('#sort-design').removeClass('sort-active').addClass('sort-inactive');
		$('#sort-technology').removeClass('sort-inactive').addClass('sort-active');
		$('#sort-other').removeClass('sort-active').addClass('sort-inactive');
	});

	$('#sort-other').click( function() {
		$.each($('#projects article'), function(index, project) {
			if ($(project).hasClass('other'))
				$(project).fadeIn(200);
			else
				$(project).fadeOut(200);
		});

		$('#sort-all').removeClass('sort-active').addClass('sort-inactive');
		$('#sort-design').removeClass('sort-active').addClass('sort-inactive');
		$('#sort-technology').removeClass('sort-active').addClass('sort-inactive');
		$('#sort-other').removeClass('sort-inactive').addClass('sort-active');
	});
});