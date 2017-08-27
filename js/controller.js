


	$(document).ready(function(){

		$('#sun').addClass("active");
		$.ajax({url:"load.php?day=sun" ,success:function(result){
              document.getElementById('bodyof').innerHTML = result;
		}})
		
	});


    
	$('#sun').click(function(){
    	$('#sun').addClass("active");
    	$('#mon').removeClass("active");
    	$('#tue').removeClass("active");
    	$('#wed').removeClass("active");
    	$('#thu').removeClass("active");
    	$('#tot').removeClass("active");
    	$('#fri').removeClass("active");
    	$('#sat').removeClass("active");
    	$.ajax({url:"load.php?day=sun" ,success:function(result){
              document.getElementById('bodyof').innerHTML = result;
		}})

	});

	$('#mon').click(function(){
    	$('#mon').addClass("active");
    	$('#sun').removeClass("active");
    	$('#tue').removeClass("active");
    	$('#wed').removeClass("active");
    	$('#thu').removeClass("active");
    	$('#fri').removeClass("active");
    	$('#sat').removeClass("active");
    	$('#tot').removeClass("active");
    	$.ajax({url:"load.php?day=mon" ,success:function(result){
              document.getElementById('bodyof').innerHTML = result;
		}})

	});

	$('#tue').click(function(){
    	$('#tue').addClass("active");
    	$('#mon').removeClass("active");
    	$('#sun').removeClass("active");
    	$('#wed').removeClass("active");
    	$('#thu').removeClass("active");
    	$('#fri').removeClass("active");
    	$('#sat').removeClass("active");	
    	$('#tot').removeClass("active");
    	$.ajax({url:"load.php?day=tue" ,success:function(result){
              document.getElementById('bodyof').innerHTML = result;
		}})

	});

	$('#wed').click(function(){
    	$('#wed').addClass("active");
    	$('#mon').removeClass("active");
    	$('#tue').removeClass("active");
    	$('#sun').removeClass("active");
    	$('#thu').removeClass("active");
    	$('#fri').removeClass("active");
    	$('#sat').removeClass("active");
    	$('#tot').removeClass("active");	
    	$.ajax({url:"load.php?day=wed" ,success:function(result){
              document.getElementById('bodyof').innerHTML = result;
		}})

	});

	$('#thu').click(function(){
    	$('#thu').addClass("active");
    	$('#mon').removeClass("active");
    	$('#tue').removeClass("active");
    	$('#wed').removeClass("active");
    	$('#sun').removeClass("active");
    	$('#fri').removeClass("active");
    	$('#sat').removeClass("active");
    	$('#tot').removeClass("active");	
    	$.ajax({url:"load.php?day=thu" ,success:function(result){
              document.getElementById('bodyof').innerHTML = result;
		}})

	});

	$('#fri').click(function(){
    	$('#fri').addClass("active");
    	$('#mon').removeClass("active");
    	$('#tue').removeClass("active");
    	$('#wed').removeClass("active");
    	$('#thu').removeClass("active");
    	$('#sun').removeClass("active");
    	$('#sat').removeClass("active");
    	$('#tot').removeClass("active");	
    	$.ajax({url:"load.php?day=fri" ,success:function(result){
              document.getElementById('bodyof').innerHTML = result;
		}})

	});

	$('#sat').click(function(){
    	$('#sat').addClass("active");
    	$('#mon').removeClass("active");
    	$('#tue').removeClass("active");
    	$('#wed').removeClass("active");
    	$('#thu').removeClass("active");
    	$('#fri').removeClass("active");
    	$('#sun').removeClass("active");
    	$('#tot').removeClass("active");	
    	$.ajax({url:"load.php?day=sat" ,success:function(result){
              document.getElementById('bodyof').innerHTML = result;
		}})

	});

	$('#tot').click(function(){
    	$('#tot').addClass("active");
    	$('#mon').removeClass("active");
    	$('#tue').removeClass("active");
    	$('#wed').removeClass("active");
    	$('#thu').removeClass("active");
    	$('#fri').removeClass("active");
    	$('#sun').removeClass("active");
    	$('#sat').removeClass("active");	
    	$.ajax({url:"load.php?day=allday" ,success:function(result){
              document.getElementById('bodyof').innerHTML = result;
		}})

	});









