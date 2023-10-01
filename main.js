jQuery(document).ready(function($) {


    /* Add or remove others */	
	var remImg = $("#remImg").val();
    var othmaxField = 10; //Input fields increment limitation
    var othx = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $('.add_other_btn').click(function(){
        //Check maximum number of input fields
        if(othx < othmaxField){ 
            othx++; //Increment field counter
            var fieldHTML = '<div style="margin-bottom: 5px;"><select name="otherPer" id="otherPer" class="inputSelect otherPer"><option value="0" selected="true" disabled="disabled">Select an Option</option><option value="10">10%</option><option value="20">20%</option><option value="30">30%</option><option value="40">40%</option><option value="50">50%</option><option value="60">60%</option><option value="70">70%</option><option value="80">80%</option><option value="90">90%</option><option value="100">100%</option></select><a href="javascript:void(0);" class="remove_button remove_other_btn"><img src="'+remImg+'"/></a></div>'; //New input field html 
            $('.othersWrap').append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $('.othersWrap').on('click', '.remove_other_btn', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        othx--; //Decrement field counter
    });

    /* Add or remove right arm */  
    var rarm_maxField = 10; //Input fields increment limitation
    var rarm_x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $('.add_rarm_btn').click(function(){
        //Check maximum number of input fields
        if(rarm_x < rarm_maxField){ 
            rarm_x++; //Increment field counter
            var fieldHTML = '<div style="margin-bottom: 5px;"><select name="rarmPer" id="rarmPer" class="rarmPer inputSelect"><option value="0" selected="true" disabled="disabled">Select an Option</option><option value="10">10%</option><option value="20">20%</option><option value="30">30%</option><option value="40">40%</option><option value="50">50%</option><option value="60">60%</option><option value="70">70%</option><option value="80">80%</option><option value="90">90%</option><option value="100">100%</option></select><a href="javascript:void(0);" class="remove_button remove_rarm_btn"><img src="'+remImg+'"/></a></div>'; //New input field html 
            $('.rarmWrap').append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $('.rarmWrap').on('click', '.remove_rarm_btn', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        rarm_x--; //Decrement field counter
    });     


    /* Add or remove left arm */  
    var larm_maxField = 10; //Input fields increment limitation
    var larm_x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $('.add_larm_btn').click(function(){
        //Check maximum number of input fields
        if(larm_x < larm_maxField){ 
            larm_x++; //Increment field counter
            var fieldHTML = '<div style="margin-bottom: 5px;"><select name="larmPer" id="larmPer" class="larmPer inputSelect"><option value="0" selected="true" disabled="disabled">Select an Option</option><option value="10">10%</option><option value="20">20%</option><option value="30">30%</option><option value="40">40%</option><option value="50">50%</option><option value="60">60%</option><option value="70">70%</option><option value="80">80%</option><option value="90">90%</option><option value="100">100%</option></select><a href="javascript:void(0);" class="remove_button remove_larm_btn"><img src="'+remImg+'"/></a></div>'; //New input field html 
            $('.larmWrap').append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $('.larmWrap').on('click', '.remove_larm_btn', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        larm_x--; //Decrement field counter
    }); 

    /* Add or remove right leg */  
    var rleg_maxField = 10; //Input fields increment limitation
    var rleg_x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $('.add_rleg_btn').click(function(){
        //Check maximum number of input fields
        if(rleg_x < rleg_maxField){ 
            rleg_x++; //Increment field counter
            var fieldHTML = '<div style="margin-bottom: 5px;"><select name="rlegPer" id="rlegPer" class="rlegPer inputSelect"><option value="0" selected="true" disabled="disabled">Select an Option</option><option value="10">10%</option><option value="20">20%</option><option value="30">30%</option><option value="40">40%</option><option value="50">50%</option><option value="60">60%</option><option value="70">70%</option><option value="80">80%</option><option value="90">90%</option><option value="100">100%</option></select><a href="javascript:void(0);" class="remove_button remove_rleg_btn"><img src="'+remImg+'"/></a></div>'; //New input field html 
            $('.rlegWrap').append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $('.rlegWrap').on('click', '.remove_rleg_btn', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        rleg_x--; //Decrement field counter
    });

    /* Add or remove left leg */  
    var lleg_maxField = 10; //Input fields increment limitation
    var lleg_x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $('.add_lleg_btn').click(function(){
        //Check maximum number of input fields
        if(lleg_x < lleg_maxField){ 
            lleg_x++; //Increment field counter
            var fieldHTML = '<div style="margin-bottom: 5px;"><select name="llegPer" id="llegPer" class="llegPer inputSelect"><option value="0" selected="true" disabled="disabled">Select an Option</option><option value="10">10%</option><option value="20">20%</option><option value="30">30%</option><option value="40">40%</option><option value="50">50%</option><option value="60">60%</option><option value="70">70%</option><option value="80">80%</option><option value="90">90%</option><option value="100">100%</option></select><a href="javascript:void(0);" class="remove_button remove_lleg_btn"><img src="'+remImg+'"/></a></div>'; //New input field html 
            $('.llegWrap').append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $('.llegWrap').on('click', '.remove_lleg_btn', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        lleg_x--; //Decrement field counter
    }); 


/* Marital status */
$("input[name='married']").click(function() {
    var test = $(this).val();
	
	if (test == 1) {
		$("#maritalAA").css('display', 'block');
	} else {
		$("#maritalAA").css('display', 'none');
	}
});


    /* Reset Button */
    $("#vdbc_reset").click(function(){ 
        $([document.documentElement, document.body]).animate({
            scrollTop: $("#vdbc").offset().top
        }, 2000);
        $(".inputSelect").prop("selectedIndex", 0);
        $(".addSelect").prop("selectedIndex", 0);
        $(".vadis").prop("checked", false);
        $("#others").prop("checked", false);
        $("#single").prop("checked", true);
        $("#maritalAA").css('display', 'none');
        $("#maritalAA-no").prop("checked", true);
        $("#vdbcResult").hide();
        $(".remove_button").trigger('click'); 
    });

    /* Submit Form*/
    $("#vdbcResult").hide();
    $("#vdbcFrm").submit(function(e) {
        e.preventDefault();     
        $("#submit_vdbc").text("Loading...");
             $.ajax({
                url: ajax_object.ajax_url, // or example_ajax_obj.ajaxurl if using on frontend
                data: {
                    'action': 'submit_vdbc_request',
                    'lleg' : $('input[name="lleg"]:checked').val(),
                    'llegPer' : $('.llegPer').serializeArray(),
                    'rleg' : $('input[name="rleg"]:checked').val(),
                    'rlegPer' : $('.rlegPer').serializeArray(),
                    'larm' : $('input[name="larm"]:checked').val(),
                    'larmPer': $('.larmPer').serializeArray(),
                    'rarm' : $('input[name="rarm"]:checked').val(),
                    'rarmPer': $('.rarmPer').serializeArray(),
                    'others' : $('input[name="others"]:checked').val(),
                    'otherPer': $('.otherPer').serializeArray(),
                    'child' : $("#child").val(),
                    'ElderChild' : $("#ElderChild").val(),
                    'parents' : $("#parents").val(),
                    'married' : $('input[name="married"]:checked').val(),
                    'maritalAA' : $('input[name="maritalAA"]:checked').val(),
                },
                dataType: 'json',
                type: "post",            
                success: function (data) {
                    console.log(data);
                    $("#bf").text(data['bf']+"%");
                    $("#total_com").text(data['total_com']+"%");
                    $("#monthly_comp").text("$"+data['monthly_comp']);
                    $("#vdbcResult").fadeIn('slow');
                    $("#submit_vdbc").text("Submit");
               }
            });
    });

});