<?php 
	if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])!= "com.website.reader"){
		//header('location:');
	}
	/**
	 * THIS SYSTEM HAS BEEN DESIGNED AND CODED BY DENNIS KIPKEMBOI
	 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="icon" href="icon.png">
	<title> Medibot | Chatbot</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="dist/jquery.convform.css">
	<link rel="stylesheet" href="dist/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="dist/demo.css">
</head>
<body>
	<section id="demo">
	    <div class="vertical-align">
	        <div class="container">
	            <div class="row">
	                <div class="col-sm-6 col-sm-offset-3 col-xs-offset-0">
	                    <div class="card no-border">
	                        <div id="chat" class="conv-form-wrapper">
	                            <form action="" method="GET" class="hidden">
	                                <select data-conv-question="This is Debot, a robot that will collect some information from you before you are connected to a doctor. Are you now ready?" name="first-question">
	                                    <option value="yes">Yes</option>
	                                    <option value="sure">Sure!</option>
	                                </select>
	                                <input type="text" name="name" data-conv-question="Alright! First, tell me your full name, please.|Okay! Please, tell me your name first.">
	                                <input type="text" data-conv-question="Howdy, {name}:0! It's a pleasure to meet you. (note that you are free to ask me anything.)" data-no-answer="true">
	                                <input type="text" data-conv-question="I will surely help to say what i have." data-no-answer="true">
	                                
	                                <input type="text" data-conv-question="Pleas dont hesitate to to tell me anything that feels wrong to you:" data-no-answer="true">
	                                <input data-conv-question="Now type in your e-mail" data-pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" id="email" type="email" name="email" required placeholder="What's your e-mail?">
	                                
	                            </form>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</section>
	<script type="text/javascript" src="dist/jquery-1.12.3.min.js"></script>
	<script type="text/javascript" src="dist/autosize.min.js"></script>
	<script type="text/javascript" src="dist/jquery.convform.js"></script>
	<script src='https://code.responsivevoice.org/responsivevoice.js'></script>

	<script>
	$(document).ready(function(){
		// setInterval(function() {
		// 					
		// 				}, 500);
		var count=0;
		var user_l=0;
		var user_a='';
		var user_sym=[];
		var user_des=[];
		var user_t='';
		var user_c=0;
		var p_id=12345678;
		var p_name="Dennis Kipkemboi";
		var user_sym_qiz=['What else?','Ooh sorry? What else?','Sorry for that. Don\'t hesitate. kindly select all that you feel.','Sorry for that. Select another one','What again?', 'Sorry? What again?','What else do you feel?','What again do you feel?','Ooh sorry?',"Am realy sorry for that?"]
		var convForm = $('#chat').convform({eventList:{onInputSubmit: function(convState, ready) {
			console.log('input is being submitted...');
			// responsiveVoice.setDefaultVoice("US English Female");
			if(convState.current.answer.text==='Home') {
		    	convState.current.next = false;
				setTimeout(ready, Math.random()*500+100);
			} else {
				var symID = convState.current.answer.value;
				if(user_a=="upload_des")user_des.push(symID);
				switch(convState.current.answer.value)
				{
					case 'done uploading sym':
						user_sym.length>0?user_l=2:user_l=1;
						user_a='';
					break;
					case 'make online':
						user_l=4;
						user_a='';
					break;
				}
				switch(user_l){
					// let the user to key in is name
					case 0:
						// responsiveVoice.speak('Kindly, tell me your name first');
						convState.current.next = convState.newState({
						type: 'input',
						noAnswer: false,
						name: 'dynamic-question-'+count,
						questions: ['Wow! Now that you know my name, i will be glad to know you too. So what is your name?'],
						});
						user_l=1;
						ready();
					break;
					//load the symptoms from the db
					case 1:
						var answer = convState.current.answer.text;
						//if the user is done
						if(answer=="Nothing else"){
							convState.current.next = convState.newState({
							type: 'select',
							multiple:false,
							noAnswer:false,
							name: 'dynamic-question-'+count,
							questions: ['Are you realy done? If there is something missing on the list dont worry, you will tell the doctor as soon as you are connected'],
							answers: [{text:'Yes',value:'done uploading sym'},{text:'No',value:'still uploading sym'}]
							}); 
							ready();
							break;
							}
						//if user action is to upload symptoms then update the aray
						var symID = convState.current.answer.value;
						if(user_a=="upload_sym" && answer != "No")user_sym.indexOf(symID)<0?user_sym.push(symID):console.log('symptom alredy exist');
						$.post("db.php",{"table":"infections","tag":0})
							.done(function(dat){
								data = $.parseJSON(dat);
								
									if(data){
										var msg="";
										user_sym.length>0? msg=user_sym_qiz[parseInt(Math.random()*10)]: msg='Bravo! It is my pleasure to meet you. I am sorry that you don\'t feel well. But am still here to help you, pleas select what you feel by clicking and filter by typing a word.'; 
										convState.current.next = convState.newState({
										type: data.length>0?'select':'input',
										multiple:false,
										noAnswer:false,
										name: 'dynamic-question-'+count,
										questions: [data.length>0? msg:'I am sorry friend, i could not find anyting on my database that mached your choice but have contact the tecnical team.'],
										answers: data
										});
										data.length>0?console.log('Symptoms loaded'):user_l=0;
										user_a="upload_sym";
										ready();
									}else{
										convState.current.next = convState.newState({
										type: 'select',
										multiple:false,
										noAnswer:false,
										name: 'dynamic-question-'+count,
										questions: ['Sorry! An error was encounterd while trying to connect to the sever. Pleas ensure you are connected to the internet.'],
										answers: [{text:'Retry',value:'yes'},{text:'Home',value:'home'}]
										}); 
										ready();
									}
							});
					break;
					// load the descriptions
					case 2:
							$.post("db.php",{"table":"getsym","tag":user_sym[user_c]})
							.done(function(dat){
								var qiz="";
								data = $.parseJSON(dat);								
									if(data){
										qiz=data[0].name;
										
									}else{
										qiz="Sorry? I encounterdan error. Pleas i promise to be back soon."
									}

									$.post("db.php",{"table":"descriptions","tag":user_sym[user_c]})
									.done(function(dat){
										data = $.parseJSON(dat);

											if(data){
												convState.current.next = convState.newState({
												type: data.length>0?'select':'input',
												multiple:false,
												noAnswer:false,
												name: 'dynamic-question-'+count,
												questions: [data.length>0?"Kindly describe your " + qiz:'I am sorry friend, i could not find anyting on my database that mached your choice but have contact the tecnical team.'],
												answers: data
												});
												user_c<user_sym.length-1?user_c++:user_l=3;
												user_a="upload_des";
												ready();
											}else{
												convState.current.next = convState.newState({
												type: 'select',
												multiple:false,
												noAnswer:false,
												name: 'dynamic-question-'+count,
												questions: ['Sorry! An error was encounterd while trying to connect to the sever. Pleas ensure you are connected to the internet.'],
												answers: [{text:'Retry',value:'yes'},{text:'Home',value:'home'}]
												});
												
												ready();
											}
									});
								});
							
							
					break;
					// post the provided info to database
					case 3:
						for(var i=0; i<user_des.length; i++)
						{
							$.post("db.php",{"table":"selections","tag":user_des[i],"patient":p_id})
							.done(function(dat){
								data = $.parseJSON(dat);
								if(!data || data.length<=0){
									convState.current.next = convState.newState({
									type: 'select',
									multiple:false,
									noAnswer:false,
									name: 'dynamic-question-'+count,
									questions: ['Sorry! An error was encounterd while trying to connect to the sever. Pleas ensure you are connected to the internet.'],
									answers: [{text:'Retry',value:'yes'},{text:'Home',value:'home'}]
									}); 
									ready();
								}
							});
						}
						convState.current.next = convState.newState({
						type: 'select',
						multiple:false,
						noAnswer:false,
						name: 'dynamic-question-'+count,
						questions: ['Thanks. Kindly wait on the line as you are being connected to a doctor.'],
						answers: [{text:'Okey',value:'make online'},{text:'No',value:'home'}]
						}); 
						ready();
					break;
					//make online
					case 4:
						$.post("db.php",{"table":"mkonline","tag":'doctor',"patient":p_id,"p_name":p_name})
						.done(function(dat){
							data = $.parseJSON(dat);
							if(!data || data.length<=0){
								convState.current.next = convState.newState({
								type: 'select',
								multiple:false,
								noAnswer:false,
								name: 'dynamic-question-'+count,
								questions: ['Sorry! An error was encounterd while trying to connect to the sever. Pleas ensure you are connected to the internet.'],
								answers: [{text:'Retry',value:'yes'},{text:'Home',value:'home'}]
								}); 
								ready();
							}
						});
						convState.current.next = convState.newState({
						type: 'input',
						multiple:false,
						noAnswer:false,
						name: 'dynamic-question-'+count,
						questions: ['Wow! that was a long way and now that you are ready, wait for response from the doctor. This might take a while.']
						});
						user_l=5;
						online(p_id);
						getChat(p_id);
						ready();
					break;
					case 5:
						if(convState.current.answer.value != 'yes'){
							$('.typing').remove();
							var msg=convState.current.answer.text;
							$.post("db.php",{"table": "sendchat","receiver":0,"tag":msg,"sender": p_id})
                    		.done(function(msg){
                        		data=$.parseJSON(msg);
                        		if(!data){
                          
                        		}
                    		});
						}
					break;
				}
				
			}

			count++;
		}}});
	});
function online(p_id){
	setInterval( function(){
		$.post("db.php",{"table":"mkonline","patient":p_id,"tag": "update"})
		.done(function(dat){});
	}, 500);
	
}
function getChat(p_id){
	setInterval( function(){
		$.post("db.php",{"table":"getChat","tag":p_id})
		.done(function(dat){
			data = $.parseJSON(dat);
			if(data && data.length>0 ){
				$('.typing').remove();
				for(var i=0; i<data.length; i++)
				{	
					$('#messages').append('<div class="message to ready">'+data[i].chat+'</div>');
					$('#messages').animate({"scrollTop":$('#messages')[0].scrollHeight+500}, 2000);
				}
			}
		});
	}, 500);
}
</script>
</body>
</html>