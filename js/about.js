var iam = document.getElementById('i-am');
var ilike = document.getElementById('i-like');

var am_list = ["developer", "creative coder", "web designer", "motion graphics guy", "creative technologist", "folk music connoiseur", "Texan", "GIF-addict", "90's kid", "wildcard"];
var like_list = ["solve problems", "explore the unknown", "drink craft beer", "quote Bob Dylan", "learn", "make things connect", "think critically", "play the drums", "challenge myself"];

var newAm = window.setInterval( function() {
	var num = Math.floor(Math.random() * am_list.length);
	iam.innerHTML = am_list[num];
}, 1400);

var newLike = window.setInterval( function() {
	var num = Math.floor(Math.random() * like_list.length);
	ilike.innerHTML = like_list[num];
}, 1600);