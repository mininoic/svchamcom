  	
    function loadPage(id){
  			$("#page-wrapper").load(id+".html #page-wrapper");
  		};

/*
var links = $('[mininoic-click]');
	for (var i = links.length - 1; i >= 0; i--) {
		links[i].onClick(funciton(){
			$.ajax('/'+$(links[i]).attrs('mininoic-click'),function(data){
				$('[mininoic-view').html(data.data);
			})		
		})
	};
	something.onClick(function(){
		
	});*/