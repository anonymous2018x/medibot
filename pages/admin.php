<!DOCTYPE html>
<html lang="en">
<?php
$id= isset($_REQUEST['login']) ? $_REQUEST['login'] : '1';
if(strlen($id)<8){
    header("Location:../pages/index.php");   
}
?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Medibot Admin panel</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0;background-color:#222;color:white;">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Medibot v1.0 Doctor's panel</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
                
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" >
                        <i style="color:#fff;" class="fa fa-user fa-fw"></i> <i style="color:#fff;" class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <!-- <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li> -->
                        <li><a href="index.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper" style="padding-top:60px;">
        <div class="container">
        <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title">Add new user</h3>
			 			</div>
			 			<div class="panel-body">
			    		<div role="form">
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			                <input type="number" name="first_name" id="new-id" class="form-control input-sm" placeholder="Enter id">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
                                        <select name="" id="new-type" class="form-control input-sm">
                                            <option value="Doctor">Doctor</option>
                                            <option value="Pharmacy">Pharmacy</option>
                                            <option value="Doctor">Admin</option>
                                        </select>
			    						
			    					</div>
			    				</div>
			    			</div>
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password"  id="new-pass" class="form-control input-sm" placeholder="Password">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password"  id="new-pass-c" class="form-control input-sm" placeholder="Confirm Password">
			    					</div>
			    				</div>
			    			</div>
			    			
			    			<input type="submit" id="add-user-btn" value="Add" class="btn btn-info btn-block" data-toogle="add-user">
			    		
                        </div>
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>
        <div class="container">
        <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title">Add new Symptom</h3>
			 			</div>
			 			<div class="panel-body">
			    		<div role="form">
			    			
			    			<div class="row">
			    				
			    					<div class="form-group">
			    						<input type="text" name="sym" id="sym" class="form-control input-sm" placeholder="Enter category">
			    					</div>
			    				
			    			</div>
			    			
			    			<input type="submit" value="Add" id="sym-btn" class="btn btn-info btn-block" data-toogle="add-sym">
			    		
                        </div>
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>
        <div class="container">
        <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
        	<div class="panel panel-default">
        		<div class="panel-heading">
			    		<h3 class="panel-title">Add symptom info</h3>
			 			</div>
			 			<div class="panel-body">
			    		<div role="form">
			    			<div class="row">
			    				
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">                                        
                                        <select name="" id="inf" class="form-control input-sm">
                                            
                                        </select>
			    						
			    					</div>
			    				</div>
			    			</div>
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" id="inf-type" class="form-control input-sm" placeholder="Enter Name">
			    					</div>
			    				</div>
			    				
			    					<div class="form-group">
			    						<input type="text" id="inf-des" class="form-control input-sm" placeholder="Enter description">
			    					</div>
			    				
			    			</div>
			    			
			    			<input type="submit" value="add" id="new-inf" class="btn btn-info btn-block" data-toogle="add-inf">
			    		
                        </div>
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <!-- Modal -->

    <style>
            .pb-chat-panel {
                border: none;
                margin-bottom: -5px;
            }
        
            .pb-chat-panel-heading {
                margin-top: -5px;
            }
        
            .pb-chat-top-icons {
                margin-top: 4px;
            }
        
            #patient {
                color: #999;
            }
        
            .pb-chat-labels {
                font-size: 15px;
            }
        
            .pb-chat-labels-right {
                margin-bottom: 0;
                margin-right: 5px;
                color: #fff;
                background-color: rgb(61, 122, 61);
                padding: 20px 10px 20px 10px;
                border-radius: 20% 0% 10% 20%;
                margin-right: 5px;
            }

            .chat-nav{
                padding:0px;
                background:inherit;
                color:#fff;
            }
        
            .pb-chat-labels-left {
                margin-left: 5px;
                background-color: #fff;
                padding: 10px 20px 20px 10px;
                border-radius: 0% 20% 20% 5%;
            }
        
        
            .pb-chat-fa-user {
                border: 1px solid blue;
                padding: 5px;
                border-radius: 50%;
            }
        
            .pb-chat-textarea {
                resize: none;
            }
        
            .pb-chat-dropdown {
                width: 300px;
            }
        
            .pb-chat-btn-circle {
                border-radius: 35px;
            }
        
            .pb-btn-circle-div {
                padding-left: 0px;
                margin-top: 12px;
            }
            ::-webkit-scrollbar{
                width: 5px;
            }
            ::-webkit-scrollbar-track{
                box-shadow: inset 0 0 4px #70f7c3;
                border-radius: 2px;
            }
            ::-webkit-scrollbar-thumb{
                background: lightgreen;
                border-radius: 2px;
            }
            ::-webkit-scrollbar-thumb:hover{
                background-color:greenyellow;
            }
            #page-wrapper{
               
   
            }
        </style>

        
        <!-- Responsive Chat - END -->
        
    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>


</body>

</html>

<script>

        $(window).click(function(){
            
                // alert($('#'+event.target.id).data('toogle'));
                switch($('#'+event.target.id).data('toogle')){
                    case 'add-user':
                   var id=$("#new-id").val();
                   var type=$("#new-type").val();
                   var pass =$("#new-pass").val();
                   if(pass==$("#new-pass-c").val()){
                    $.post("../db/newUser.php",{"id":id,"type":type,"pass":pass})
                    .done(function(user){
                        data=$.parseJSON(user);
                        if(data){
                           alert("user added successfuly");
                        }else alert("Faild to add user");
                    });
                   }else{
                       alert("Yor password did not match");
                   }
                   $("#new-id").val('');
                   $("#new-pass").val('');
                   $("#new-pass-c").val('');
                    break;
                    case 'add-user':
                   var id=$("#new-id").val();
                   var type=$("#new-type").val();
                   var pass =$("#new-pass").val();
                   if(pass==$("#new-pass-c").val()){
                    $.post("../db/newUser.php",{"id":id,"type":type,"pass":pass})
                    .done(function(user){
                        data=$.parseJSON(user);
                        if(data){
                           alert("user added successfuly");
                        }else alert("Faild to add user");
                    });
                   }else{
                       alert("Yor password did not match");
                   }
                   $("#new-id").val('');
                   $("#new-pass").val('');
                   $("#new-pass-c").val('');
                    break;
                    case 'add-inf':
                   var inf=$("#inf").val();
                   var type=$("#inf-type").val();
                   var des =$("#inf-des").val();
                   if($.trim(type)>''){
                    $.post("../db/newInf.php",{"inf":inf,"type":type,"des":des})
                    .done(function(user){
                        data=$.parseJSON(user);
                        if(data){
                           alert("data updated successfuly");
                        }else alert("Faild to add data");
                    });
                   }else{
                       alert("pleas select name");
                   }
                   $("#inf-type").val('');
                   $("#inf-des").val('');
                    break;
                    case 'add-sym':
                   var type=$.trim($("#sym").val());
                   if(type>''){
                    $.post("../db/newSym.php",{"type":type})
                    .done(function(sym){
                        data=$.parseJSON(sym);
                        if(data){
                           alert("Symptoms updated");
                           $('#inf').append('<option value="'+type+'">'+type+'</option>');
                        }else alert("Faild to update");
                    });
                   }else{
                       alert("Pleas type a category");
                   }
                   $("#sym").val('');
                  
                    break;
                    
                }
        });
        $(document).ready(function(){
            $.get( "../db/symptoms.php")
        		.done(function( symptoms ) {						
        			data = $.parseJSON(symptoms);
            		if(data && data.length>0){
                        for(var i=0; i<data.length;i++){
						$('#inf').append('<option value="'+data[i].text+'">'+data[i].text+'</option>');
                        }
					}
					
				});
        });


        
    </script>

