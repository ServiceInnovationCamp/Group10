$(document).ready(function(){ //document ready
	// alert("hello world");
	$('#searchboxx').avro();
	$('#main').swiperight(function(){
		// alert('hello world');
		$.mobile.changePage( "#cats", { transition: "flip"} );
	});
	$('.swipebtn').tap(function(){
		// alert('hello world');
		$.mobile.changePage( "#cats", { transition: "flip"} );
	});
	
	$('#cats').swipeleft(function(){
		$.mobile.changePage("#main",{transition: "flip"});
	});
	$('.swiprvrc').tap(function(){
		$.mobile.changePage("#main",{transition: "flip"});
	});
	$('#search').swipeleft(function(){
		$.mobile.changePage("#main",{transition: "flip"});
	});
	// speech
	$('.speaker').tap(function(){
		// alert('speech');
		window.plugins.speechrecognizer.startRecognize(function(kotha){
			$("#searchboxx").val(kotha);
			//alert('this is good');
		},function(errm){
			// alert(errm);
			alert('আপনার কন্ঠস্বর গ্রহন করা সম্ভব হয়নি');
		},1,"ইংরেজীতে বলুন");
	});
	$('.searchbtn').tap(function(){
		dosearch();
	});
	function dosearch(){
		//this is where the complex search algorithm should be written
		if($('#searchboxx').val()!=""){
		//var url="http://ahmadfiroz.com/bdnow/?q="+$('#searchboxx').val();
		var sq;
		sq=$('#searchboxx').val();
		$.mobile.changePage("#search",{transition: "flip"});
		//alert(url);
		$("#search").html("<p class='loading'>লোড করা হচ্ছে ...</p>");
		$.ajax({
			url: 'http://ahmadfiroz.com/bdnow/index.php',
			type : 'GET',
			data : {'q':sq}
		}).done(function(data){
			// alert(data);
			$("#search").html(data);
		});
	}
	}
	$("#cats table td").tap(function(){
		// alert();
		var kwrd=$(this).find('h1').html();
		//alert(kwrd);
		sq=$('#searchboxx').val(kwrd);
		dosearch();
	});
});
