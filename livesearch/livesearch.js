$(document).ready(function(){
	var resultBox=0; //0-closed 1-open
	var itemIndex=0;
	var boxLength;
	var itemValue;
	$("#search input").keyup(function(event){
		//console.log("key pressed");
		//check if keycode is not ESC(27) / RIGHT(37) / UP(38) / LEFT(39) / BOTTOM(40)
		if(event.keyCode == 27){
			$("#livesearch").hide();
		}
		else if(event.keyCode == 40 && resultBox == 1){
			console.log("down key pressed " + itemIndex +" "+ boxLength);
			$(".live-item").removeClass("live-select");
			var item = $("#livesearch .live-item").eq(itemIndex);
			$(item).addClass("live-select");
			itemValue = $(item).text();
			$("#searh-input").val(itemValue);
			itemIndex = (+itemIndex + 1)%boxLength;
			//console.log(itemIndex);
		}
		else{
			var q = $(this).val();
			if(q){
				$.ajax({
        url: 'livesearch.php',
        type: 'post',
        data: {query:q},
        dataType: 'json',
        success: function(data){
        	boxLength = data.length;

        	//console.log(data);            	
        	$("#livesearch").empty();
        	//check that the returned obj is not empty
        	if(!$.isEmptyObject(data)){
        		//console.log(data);
        		$("#livesearch").show();
							resultBox = 1;
        		//loop to print all obj values to #livesearch
        		$.each(data, function(index, value) {
							  $("#livesearch").append('<div class="live-item">'+data[index]+'</div>');
							});
							//close #livesearch when clicked anywhere else
						  $(document).click(function(event){
						  	//console.log("closing");
						  	event.stopPropagation();
						  	$("#livesearch").hide();
						  });
						  itemIndex = 0;
							
        	}
        	else{
        		$("#livesearch").hide();
        		resultBox=0;
        	}
          }                  	                  
			});
			}
			else{
				$("#livesearch").empty();
				$("#livesearch").hide();
				resultBox=0;
			}										
		}

	});

	$("#livesearch").on('click','.live-item',function(){					
		var choice = $(this).text();
		$("#searh-input").val(choice);
		$("#search-form").submit();
	});
});			