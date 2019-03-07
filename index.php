<?php 
	if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])!= "com.website.reader"){
		header('location:pages/');
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="icon" href="ico.ico">
	<title>Doctor Denno</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="dist/jquery.convform.css">
	<link rel="stylesheet" href="bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="demo.css">
</head>
<body>
	<section id="demo">
	    <div class="vertical-align">
	        <div class="container">
	            <div class="row">
	                <div class="col-sm-6 col-sm-offset-3 col-xs-offset-0">
	                    <div class="card no-border">
	                      	<div id="chat">
	                            <form action="" method="GET" class="hidden">
	                                	                                
									<select data-conv-question=	'<img src="ico.ico" class="img-circle" style="width:40px;height: 40px;"/>Hello! Welcome to Bot hospital. Do you feel sick?' name="first-question" >
	                             
	                                    <option value="yes">yes</option>
	                                    <option value="No">No</option>
	                                </select>
	                            </form>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</section>
	<script type="text/javascript" src="jquery-1.12.3.min.js"></script>
	<script type="text/javascript" src="dist/autosize.min.js"></script>
	<script type="text/javascript" src="dist/jquery.convform.js"></script>

<script>
uID=0;
(function() {
	 function IDGenerator() {

		 this.length = 8;
		 this.timestamp = +new Date;
		 
		 var _getRandomInt = function( min, max ) {
			return Math.floor( Math.random() * ( max - min + 1 ) ) + min;
		 }
		 
		 this.generate = function() {
			 var ts = this.timestamp.toString();
			 var parts = ts.split( "" ).reverse();
			 var id = "";
			 
			 for( var i = 0; i < this.length; ++i ) {
				var index = _getRandomInt( 0, parts.length - 1 );
				id += parts[index];	 
			 }
			 
			 return id;
		 }

		 
	 }
	 
	 
	var generator = new IDGenerator();
	uID = generator.generate();
	bot.SavePref("code",uID);
		 
 })();
// loged in user

uName="";
uType="Patient";
line="ofline";

var state='check user';

if(line==="online"){
		setInterval(function(){
		// update online infor
		$.post("db/monline.php",{"id":uID})
		.done(function(response){

		});
		},500);
	}


$(document).ready(function(){

	// variables declaration point

	var uSym=[];
	var sType=[];
	var uMulti="";
	var symResponse=["What else Do you feel?","Ok. What else?","Ooh! What Again?","What other problem?","What again do you feel?","Ok. What's the other problem?","Sorry. What else?","Sorry. What again?","Sorry. What other problem?", "Ouch! that hurts, any other problem?"];
	var userSate=0;
	var count = 0;
	var botCheck =0;

	var convForm = $('#chat').convform({eventList:{onInputSubmit: function(convState, ready) {
	console.log('input is being submitted...');
				
		//here you send the response to your API, get the results and build the next question
		//when ready, call 'ready' callback (passed as the second parameter)
		if(convState.current.answer.value==='end') {
		    convState.current.next = false;
			//emulating random response time (100-600ms)
			setTimeout(ready, Math.random()*500+100);
		} else {
			/**
			 * MEDIBOT DESIGNED BY DENNIS KIPKEMBOI
			 * 
			 */
		     
			switch(state) {
				case 'check user':
					if(convState.current.answer.value==='yes'){
					userSate=1;
					}else userSate=0;
					state='';
				break;
				case 'getuName':
				uName=convState.current.answer.text;
				break;
				case 'single sym':
					if(convState.current.answer.value==='yes'){
					userSate=2;
					}else userSate=1;
					state='';
				break;
				case 'key uSym':
					if(uSym.indexOf(convState.current.answer.text)<0)uSym.push(convState.current.answer.text);
					state='';
				break;
				case 'selected single inf':
					userSate=4;
					state='add-line';
				break;
				case 'conn to doc':
					if(convState.current.answer.value==='yes'){
						userSate=3;
						uMulti=uSym[0];
						state='';
					}else
						userSate=1;
						 state='';
				break;
			}
		     		         
			switch(userSate){
					
			//the user is not sick
			case 0:
				
				if(Array.isArray(convState.current.answer)) var answer = convState.current.answer.join(', ');
				else var answer = convState.current.answer.text;
				convState.current.next = convState.newState({
					type: 'input',
					noAnswer: false,
					name: 'dynamic-question-'+count,
					questions: ['Good to know that, but if you have any problem, Don\'t hesitate to tell me.'],
				});
				//userSate++;
				ready();
			break;
					 
			 // the user is sick
			case 1:	
			//bot.openChat();				 
				var answer = convState.current.answer.text;
				if(uName===''){
					convState.current.next = convState.newState({
					type: 'input',
					multiple:false,
					noAnswer:false,
					name: 'dynamic-question-'+count,
					questions: ['Kindly. What is your name first?']
					});
					state='getuName';
					ready();
				}else getSym(answer);
				break;
				// user has a single problem
			case 2:					 
				$.post( "db/infections.php", {'inf':uSym[0]})
        		.done(function(infections) {	
					data = $.parseJSON(infections);							
            		if(data && data.length>0){
						convState.current.next = convState.newState({
						type: 'select',
						multiple:false,
						name: 'dynamic-question-'+count,
						questions: ["How is the "+uSym[0] +"? or how do you feel it?"],
						answers: data
						});
						state='selected single inf';
						ready();
					}
					else{
						convState.current.next = convState.newState({
						type: 'input',
						multiple:false,
						noAnswer:false,
						name: 'dynamic-question-'+count,
						questions: ['Opps! Sorry, my sever is not yet updated, i could not find more on '+uSym[0]+'.']							
						}); 
						ready();
					}
       			});
			break;
			// user has multiple problems
			case 3:					 
				var answer = convState.current.answer.type;
				if(answer){sType.push(answer);}
				if(uMulti !="done"){
					$.post( "db/infections.php", {'inf':uMulti})
        		.done(function(infections) {	
					data = $.parseJSON(infections);							
            		if(data && data.length>0){
						convState.current.next = convState.newState({
						type: 'select',
						multiple:false,
						name: 'dynamic-question-'+count,
						questions: ["How is the "+uMulti+"? or how do you feel it?"],
						answers: data
						});
						if(uSym.indexOf(uMulti) != uSym.length-1){
							uMulti=uSym[uSym.indexOf(uMulti)+1];
						}else{uMulti='done';}
						ready();
					}
					else{
						convState.current.next = convState.newState({
						type: 'input',
						multiple:false,
						noAnswer:false,
						name: 'dynamic-question-'+count,
						questions: ['Opps! Sorry, my sever is not yet updated, i could not find more on '+uMulti+'.']							
						}); 
						ready();
					}
       			});
				}else{
					$.post("db/line.php",{"id":uID,"nme":uName,"type":uType})
						.done(function(dat){
							var i=0;
							for(i=0;i<uSym.length;i++){
							$.post("db/onlineinf.php",{"id":uID,"inf":uSym[i],"type":sType[i]})
							.done(function(dat){
								data = $.parseJSON(dat);
								
									if(data){
										convState.current.next = convState.newState({
										type: 'select',
										multiple:false,
										noAnswer:false,
										name: 'dynamic-question-'+count,
										questions: ['Your information has been received and you are being connected to a doctor. This might take a while. Dont quit this page.'],
										answers: [{text:'Okey',value:'yes'},{text:'Quit',value:'end'}]
										}); 
										state='chatting-get';
										userSate=4;
										ready();
									}else{
										convState.current.next = convState.newState({
										type: 'select',
										multiple:false,
										noAnswer:false,
										name: 'dynamic-question-'+count,
										questions: ['Faild to upload your information. Pleas check your connection.'],
										answers: [{text:'Try',value:'yes'},{text:'Quit',value:'end'}]
										}); 
										ready();
									}
							});
							}
							
						});
						convState.current.next = convState.newState({
						type: 'select',
						multiple:false,
						noAnswer:false,
						name: 'dynamic-question-'+count,
						questions: ['Faild to add You to the list. Pleas check your connection and try agein.'],
						answers: [{text:'Try',value:'yes'},{text:'Quit',value:'end'}]
						}); 
						ready();
				}
			break;
			case 4:					 
				var answer = convState.current.answer.type;
				switch (state) {
					case 'add-line':
						$.post("db/line.php",{"id":uID,"nme":uName,"type":uType})
						.done(function(dat){
							$.post("db/onlineinf.php",{"id":uID,"inf":uSym[0],"type":answer})
							.done(function(dat){
								convState.current.next = convState.newState({
								type: 'select',
								multiple:false,
								noAnswer:false,
								name: 'dynamic-question-'+count,
								questions: ['Your information has been received and you are being connected to a doctor. This might take a while. Dont quit this page.'],
								answers: [{text:'Okey',value:'yes'},{text:'Quit',value:'end'}]
								}); 
								state='chatting-get';
								ready();
							});
						});
						convState.current.next = convState.newState({
						type: 'select',
						multiple:false,
						noAnswer:false,
						name: 'dynamic-question-'+count,
						questions: ['Faild to add You to the list. Pleas check your connection and try agein.'],
						answers: [{text:'Try',value:'yes'},{text:'Quit',value:'end'}]
						}); 
						ready();
					break;
					case 'chatting-send':
						$('#convForm').hide(500);
						$.post("db/sendMsg.php",{"sender":uID,"msg":answer = convState.current.answer.text,"receiver":0})
            			.done(function(msg){
							data = $.parseJSON(msg);
							if(data){
								newChat(uID);
							}
						});
					break;
					case 'chatting-get':
						$('#convForm').hide(500);
						newChat(uID);
					break;
					default:
					break;
				}
			break;
					
		}
							
				}

		function getSym(answer){
			if(answer!=='Nothing Else'){
				if(uSym.length>0){
					var q = [symResponse[parseInt(Math.random()*10)]];
				}
				else{
					var q=['Thank you '+uName+' for joining us. How do you feel?'];
				}

				$.get( "db/symptoms.php")
        		.done(function( symptoms ) {						
        			data = $.parseJSON(symptoms);
            		if(data && data.length>0){
						convState.current.next = convState.newState({
						type: 'select',
						multiple:false,
						name: 'dynamic-question-'+count,
						questions: q,
						answers: data
						}); 
						state='key uSym';
						ready();
					}
					else{
						convState.current.next = convState.newState({
						type: 'input',
						multiple:false,
						noAnswer:false,
						name: 'dynamic-question-'+count,
						questions: ['Opps! Sorry, my sever is not yet updated, pleas try later.']							
						}); 
						ready();
					}
				});
			}else{
				uSym.pop();
				switch(uSym.length){
					case 0:				
						convState.current.next = convState.newState({
						type: 'select',
						multiple:false,
						noAnswer:false,
						name: 'dynamic-question-'+count,
						questions: ['Opps! i thought you hard a problem. Do you really have a problem?'],
						answers: [{text:'Yes',value:'yes'},{text:'No',value:'No'}]							
						});
						uSym=[];
						state='check user';
						ready();
					break;

					case 1:
						convState.current.next = convState.newState({
						type: 'select',
						multiple:false,
						noAnswer:false,
						name: 'dynamic-question-'+count,
						questions: ['Ok. is it '+ uSym[0] +' only that you feel?'],
						answers: [{text:'Yes',value:'yes'},{text:'No',value:'No'}]
						}); 
						state='single sym';
						ready();
					break;

					default:
						convState.current.next = convState.newState({
						type: 'select',
						multiple:false,
						noAnswer:false,
						name: 'dynamic-question-'+count,
						questions: ['Have you selected all that you feel from the list? If there is something not on the list, you will tell a doc later'],
						answers: [{text:'Yes',value:'yes'},{text:'No',value:'No'}]
						}); 
						state='conn to doc';
						ready();
				}
			}
		}
	function newChat(id){
		$.post( "db/getMsg.php",{"id":id})
        .done(function( msg ) {
			data = $.parseJSON(msg);
			if(data.length==0){
				setTimeout(function(){
					newChat(id);
				},1000);
			}
			if(data.length>=1){
				var i=0;
				var dt='';
				$('#convForm').show(500);
				for(i=0;i<data.length;i++){
					dt=dt+data[i].msg+'</br>';
				}
				convState.current.next = convState.newState({
				type: 'input',
				multiple:false,
				noAnswer:false,
				name: 'dynamic-question-'+count,
				questions: [dt]
				});
				state='chatting-send';
				ready();
				
			}
			if(data.length>1){
				
			}
		});
	}

	function sendMsg(msg,id){
            $.post("db/sendMsg.php",{"sender":id,"msg":msg,"receiver":0})
            .done(function(msg){
				data = $.parseJSON(msg);
				if(data){
				state='chatting-get';
				}
			});
        }
		
		count++;
	}}});
});
	
	</script>
</body>
</html>