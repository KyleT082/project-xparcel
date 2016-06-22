/*
	Document is responsible for handeling the ADD function to the 
	managePackage.php page. Ajax used to post information to the 
	server. All functionality in the 
*/

$(document).ready(function(){

	//windows tab layout
	$('#table').tabs({
		event: "click",
	    // Effects: fadeIn, fadeOut, slideDown, slideUp, animate
	    show: "fadeIn",
	    hide: "fadeOut",
	    // Starting panel
	    active: 1,
	    // Collapse by clicking the current tab
	    collapsible: false,
	    // Height based on content (content) or largest (auto)
	    heightStyle: "auto"
	});

	$("[title]").tooltip();

	//dialgo box for add button
	$("#Cdialog").dialog({

    	draggable:true,
    	resizable:false,
    	height: 300,
    	width: 300,
    	modal: true,
    	position:{
    		my:'center',
    		of: '#packages'
      	} ,
      	show: 500,
      	hide: 500,
      	autoOpen: false,
      	buttons:{
        	"OK": function(){
	       	
				sendTrackNum();
	            $(this).dialog("close");
	        
	      	},
	       "CANCEL": function(){
	        
	       		$(this).dialog("close");  
	        }
    	}
    });
    //if ad button clicked open dialog 'Cdialog' box
	$('#btnAdd').click(function(){

		$("#Cdialog").dialog("open");
	});

	//check for and add tracking number to users table
	function sendTrackNum(){
		 
		 //$trackNum = $('#trackingNum').val();
		 //post to the php page
		 $.post('php/AddPackage.php', {
	 		trackingNum : $('#trackingNum').val(),
	 		method 		: "testTrackNum"

	 	 	},
	 		function(data){  
	 			
		 		if(!data){
		 			confirm("We could not find your tracking number");
		 		}
		 		else{
		 			$('#alertNoPack').hide();
		 			
		 			//show the success message
		 			$('#PackSuccess').slideToggle(1000,function(){
		 			});
		 			setTimeout(toggleTimer,2000);
		 			//append the data to the table
		 			$.post('php/addRow.php',{
		 			},function(data){
		 				$('#tableBody').append(data);	
		 			});
		 		}
		 });
	}

	//toggle the package success message
	function toggleTimer(){
	 	$('#PackSuccess').slideToggle(1000,function(){
	 		//??
	 	});
	}
	//toggle packe removal success
	function toggleTimerRemove(){
	 	$('#PackRemoveSuc').slideToggle(1000,function(){
	 		//??
	 	});
	}

	//store the selected tracking number
	$trackingNum=0;
	//saves the selected row
	$selectedID=-1;
	var date=" ";
	//handles the row selection highlighting
	$(document).on('click','#tableBody tr',function(){
		$(this).addClass('selected').siblings().removeClass('selected');
		var value =$(this).find('td:first').html();
		
		//set values of selected row cells to workable variables
		$selectedID = $(this).attr('id');
		$trackingNum = $(this).find("td").eq(2).html();
		date = $(this).find("td").eq(1).html();

	});

	
	//Delete row function
	$(document).on('click', '#btnDel',function(){
		
		if($selectedID ==-1){
			alert("Please select an item from the list!");
		}
		else{
			$('#removeDialog').dialog('open');
		}
	}); 
	//del row from DB
	function delRow(){
		$.post('php/DeletePack.php',{
			method	: 	"Delete",
			selTrackNum : 	$trackingNum
		},function(){
			toggleTimerRemove();
			setTimeout(toggleTimerRemove,2000);
			$('#'+ $selectedID+'').remove();
		});	
	}
	//Remove item confirmation
	$("#removeDialog").dialog({
    	draggable:true,
    	resizable:false,
    	height: 262,
    	width: 300,
    	modal: true,
    	position:{
    		my:'center',
    		of: '#packages'
      	} ,
      	show: 500,
      	hide: 500,
      	autoOpen: false,
      	buttons:{
        	"OK": function(){
        		delRow();
	            $(this).dialog("close");
	      	},
	       "Cancel": function(){
	       		$(this).dialog("close");  
	        }
    	}
    });

	//set datepicker mindate
	var today= new Date();
	var day=today.getDate();
	var mm = today.getMonth();
	var yy = today.getFullYear();
    $('#datepicker').datepicker({
    	minDate: new Date(yy,mm,day)
    });

    //calculate the min date for packages delivery
    function calculateDate(){
    	$.post('php/calcDateRule.php',{
    		method 	: "checkDate"
    	},function(){

    	});
    	var dateSplit = date.split("-");
    	$('#datepicker').datepicker("option","minDate",new Date(dateSplit[0],dateSplit[1] - 1,dateSplit[2]));
    }

    //add registered details to edit modal
    function getUpdateDetails(){
    	//set the package name
    	$('#packName').val($("#"+$selectedID+"").find('td').eq(0).html());
    	//convert date format to match datepicker
    	$currentDate=$("#"+$selectedID+"").find('td').eq(1).html();
    	var splitDate = $currentDate.split("-");
    	$('#datepicker').val(splitDate[0]+'/'+splitDate[1]+'/'+splitDate[2]);

    	//add the current delivery address
    	$currentAdd =$("#"+$selectedID+"").find('td').eq(4).html();
    	splitAddress($currentAdd);
    }
    function splitAddress(UnformtedAddress){

    	var splitAdd = UnformtedAddress.split(",");
    	//set the text box values
    	$('#addStreet').val(splitAdd[0]);
    	$('#addTown').val(splitAdd[1]);
    	$('#addCount').val(splitAdd[2]);
    }


    //address selection
    $("#radio").buttonset();
    //load primary profile address
    $('#radio1').click(function(){
    	$.post('php/loadAddress.php',{
    		method 	: "loadPrim",
    	},function(data){
    		//add selected address to edit form
    		splitAddress(data);
    	});
    });
    //load secondary profile address
    $('#radio2').click(function(){
    	$.post('php/loadAddress.php',{
    		method 	: "loadSecond",
    	},function(data){
    		//add selected address to edit form
    		splitAddress(data);
    	});
    });
    //allow for a new address to be used
    $('#radio3').click(function(){
    	$('#addStreet').attr("placeholder","Add the Street address.").val("").focus().blur();
    	$('#addTown').attr("placeholder","Add the City or Town.").val("").focus().blur();
    	$('#addCount').attr("placeholder","Add the County.").val("").focus().blur();
    });

    //if the edit button is pressed
    $(document).on('click','#btnEdit',function(){
		//check if row is selected
		if($selectedID == -1){
			alert('Please select an item from the list!');
		}
		else{
			$("#updateDialog").dialog("open");
			 //sets the minimium date of delivery
			 calculateDate();
			 getUpdateDetails();
		}
	});
	 //edit details modal options
	$("#updateDialog").dialog({
    	draggable:true,
    	resizable:false,
    	height: 565,
    	width: 600,
    	modal: true,
    	position:{
    		my:'center',
    		of: '#packages'
      	} ,
      	show: 500,
      	hide: 500,
      	autoOpen: false,
      	buttons:{
        	"Save": function(){
        		updateDetails();
        		 calculateDate();
	            $(this).dialog("close");
	      	},
	       "Cancel": function(){
	       		$(this).dialog("close");  
	        }
    	}
    });
	//Amend Details
	function updateDetails(){
		$.post('php/updateDetails.php',{
			method : 	"update",
			packName : 	$('#packName').val(),
			delivDate : $('#datepicker').val(),
			trackingNum : $trackingNum,
			address   : ($('#addStreet').val()+","+$('#addTown').val()+","+$('#addCount').val())
		},function(data){
			//alert(data);
			var updates = data.split("/");
			var packNme = updates[0];
			var DelvDate = updates[1];
			var trackN = updates[2];
			var delvAdd = updates[3];
			//alert(packNme + " "+ DelvDate +" "+ trackN+ " "+delvAdd);
			//update the html table with the new details
			$("#"+$selectedID+"").find('td').eq(0).html(packNme);
			$("#"+$selectedID+"").find('td').eq(1).html(updates[1]);
			$("#"+$selectedID+"").find('td').eq(2).html(trackN);
			$("#"+$selectedID+"").find('td').eq(4).html(delvAdd);
			
		});
	}

	$('#selectMenu').selectmenu();
	
	
	
});
