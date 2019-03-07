<!DOCTYPE html>
<html lang="en">
<?php

require_once('../db/conn.php');

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

    <title>Medibot doctors panel</title>

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

            <div class="navbar-default sidebar" role="navigation" style="background-color:#333;">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                        <i class="fa fa-institution fa-fw h2"></i><span id="docName lead" class="h5" style="color:rgb(237, 245, 237);"> </span>
                        &nbsp;&nbsp;
                        </i><span id="docId" class="h6" style="color:rgb(237, 245, 237);"><?php echo $id; ?></span>
                        </li>
                        <li>
                             <h4 class="" style="color:rgb(237, 245, 237);"><i class="fa fa-user fa-fw"></i> Patients In line</h4>
                        </li>
                        <li>
                            <div class="nav" id="online-patients" >
                                                                
                            </div>
                        </li>
                        
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper" style="padding-top:60px;">
            <div class="container-fluid" style="min-height:450px;max-height:600px; background: -webkit-linear-gradient(left, #444, #ddd);">
                <div class="row" id="chats">
                                    
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <!-- Modal -->
    <div id="modal" class="modal" data-toogle="" tabindex="-1" role="dialog" >
        <div class="modal-dialog" role="document" >
            <div class="modal-content" >
                <div class="modal-header" >
                    <h5 class="modal-title">Doctor prescription</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-lable="close" id="close-modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body" style="max-height:300px;overflow-y:scroll;">
                    <table class="table table-responsive-lg table-hover container ">
                        <thead class="thead-light">
                            <th>Drug</th>
                            <th>Quanty</th>
                            <th>Pres</th>
                            <th>Action</th>
                        </thead>
                    <tbody id="pres-list">
                        <tr id="pres-row0">
                            <td class="drug">
                                <input type="text" class="form-control" placeholder="Drug" required autofocus/>
                            </td>
                            <td class="amount">
                                <input type="text" class="form-control" placeholder="Quantity" required/>
                            </td>
                            <td class="pres">
                                <input type="text" class="form-control" placeholder="Prescription" required/>
                            </td>

                            <td class="text-center">
                                <a id="0" class="fa fa-plus btn btn-circle new-pres" style="font-size:16px;color:;height:30px;width:40px;" data-toogle="new-pres"></a>  
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
                <div class="modal-footer">
                <label for="doc-des" class="form-contol pull-left">Your Descriptions</label>
                <textarea id="doc-des" class="form-control" cols="5" rows="3" placeholder="Description (optional)"></textarea>
                    <br/>
                    <a id="post-pres" class="btn btn-success btn-md" data-toogle="post-pres">Submit</a>
                </div>
            </div>
        </div>
    </div>
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
var docId=parseInt($('#docId').text());

$.post( "../db/user.php",{"id":docId})
        .done(function( online ) {
        	data = $.parseJSON(online);
            if(data){
                var i=0;
                for(i=0;i<data.length;i++){
                    getMsg(data[i].msg,"#"+chats.chatA+"-msg");
                }
            }
        });   
    setInterval(function(){
        $.post( "../db/online.php",{"type":"Patient"})
        .done(function( online ) {
        	data = $.parseJSON(online);
            if(data){
                var i=0;
                for(i=0;i<data.length;i++){
                    newPatient(data[i].id,data[i].name);
                }
            }
        });
    },200);
        var chats={"chatA":0,"chatB":0};
        var no_of_chats=0;

        setInterval(function(){
        if(chats.chatA>0){
        $.post( "../db/getMsgdoc.php",{"id":chats.chatA})
        .done(function( online ) {
        	data = $.parseJSON(online);
            if(data){
                var i=0;
                for(i=0;i<data.length;i++){
                    getMsg(data[i].msg,"#"+chats.chatA+"-msg");
                }
            }
        });            
        }
        if(chats.chatB>0){
        $.post( "../db/getMsgdoc.php",{"id":chats.chatB})
        .done(function( online ) {
        	data = $.parseJSON(online);
            if(data){
                var i=0;
                for(i=0;i<data.length;i++){
                    getMsg(data[i].msg,"#"+chats.chatB+"-msg");
                }
            }
        });     
        }
        
    },200);
        $(window).on("keypress",function(e){
            var keycode =(event.keyCode ? event.keyCode : event.which);
            if(keycode == '13'){
                
                switch($('#'+event.target.id).data('toogle')){
                    case 'send-msg':
                    var msg= $('#'+$('#'+event.target.id).data('target')+'-text').val();
                    if($.trim(msg)!=''){
                        sendMsg(msg,'#'+$('#'+event.target.id).data('target')+'-msg',$('#'+event.target.id).data('target'));
                        $('#'+$('#'+event.target.id).data('target')+'-text').val(null);
                    }
                    break;
                }
            }
        });
        $(window).click(function(){
            // close the modal
            $('#close-modal').click(function(){
                $('#pres-list').children().remove();
                newRow($('#pres-list').children().length-1);
                $('#modal').hide();
            });
                // alert($('#'+event.target.id).data('toogle'));
                switch($('#'+event.target.id).data('toogle')){
                    case 'send-msg':
                    var msg= $('#'+$('#'+event.target.id).data('target')+'-text').val();
                    if($.trim(msg)!=''){
                        sendMsg(msg,'#'+$('#'+event.target.id).data('target')+'-msg',$('#'+event.target.id).data('target'));
                        $('#'+$('#'+event.target.id).data('target')+'-text').val(null);
                    }
                    break;
                    case 'launch-modal':
                        var modal = '#'+ $('#'+event.target.id).data('target');
                        $(modal).show();
                        $('#modal').data("toogle",$('#'+event.target.id).attr('value'));
                    break;
                    case 'remove-chat':
                    // alert(chats.chatA +":"+ chats.chatB);
                    var chat = $('#'+event.target.id).attr('value')
                    $('#'+$('#'+event.target.id).data('target')).fadeOut(700);
                    setTimeout(function(){$('#'+chat+'-chat').remove()},800);
                    no_of_chats--;
                    if(chat==chats.chatA){
                        chats.chatA=0;
                    }else chats.chatB =0;
                    $.post( "../db/disconn.php",{"id":chat})
                    .done(function( online ) {
        	        });  
                    break;
                    case 'open-chat':
                    if(no_of_chats<2){
                        var chat=$('#'+event.target.id).data('target');
					var pName=$('#'+event.target.id).attr('value');

                        newChat(parseInt(chat),pName);
                        no_of_chats++;
                        $('#'+event.target.id).fadeOut(50);
                        setTimeout(function(){$('#'+chat+"-online").remove()},60);
                        
                        // chats.chatA=chat;
                        if(chats.chatA==0){
                            chats.chatA=chat;
                        }else chats.chatB=chat;
                        getSym(parseInt(chat));
                        setTimeout(sendMsg("You are now connected. So how old are you?",null,chat),100);
                        $.post( "../db/connect.php",{"id":chat})
                        .done(function( online ) {
                        });
                    }
                    
                    break;
                    case 'alert-close':
                    $('#'+$('#'+event.target.id).data('target')).hide(700);
                    break;
                    case 'new-pres':
                    newRow(event.target.id);
                    $('#'+event.target.id).data('toogle','rm-pres');
                    $('#'+event.target.id).removeClass('fa-plus');
                    $('#'+event.target.id).addClass('fa-trash');
                    break;
                    case 'rm-pres':
                    $('#'+event.target.id).parent().parent().remove();
                    break;
                    case 'post-pres':
                    var i=0;
                    for(i=0;i<$('#pres-list').children().length;i++){
                    var drug='#'+'pres-row'+i+' .drug';
                    var amount='#'+'pres-row'+i +' .amount';
                    var pres='#'+'pres-row'+i +' .pres';
                    var id=$('#modal').data("toogle");
                    postPres(id,$(drug).children(0).val(),$(amount).children(0).val(),$(pres).children(0).val());
                    }
                    $('#pres-list').children().remove();
                    newRow($('#pres-list').children().length-1);
                    $('#modal').hide();
                    sendMsg(id+' is your refrece code, Pleas take it to the nearby phamacy to get your medication.','#'+id+'-msg',parseInt(id));
                    break;
                }
        });
        $(document).ready(function(){
            
        });


        function newPatient(id,name){
                var chat = '<li id="online">' +
                                '<a id="online-name"href="#" style="background-color:#333;" class="btn-chat-open" data-target="" data-toogle="open-chat" value="">' +
                                    '<i class="fa fa-circle fa-fw" style="color:lightgreen;"></i>Patient ID:' + id +'<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Patient Name: ' + name +
                                '</a>' +
                            '</li>';
                
                $('#online-patients').append($(chat));
                $('#online').attr("id",id+"-online");
                $('#online-name').data("target",id);
			$('#online-name').attr("value",name);
                $('#online-name').attr("id",id+"-btn");
            }

            function newChat(id,name){
                var chat='<div class="col-md-6" style="padding-top:10px" id="chat">' +// patient id + "-chat" as div id
                                '<div class="panel panel-info">' +
                                    '<div class="panel-heading" style="background-color:#333">' + 
                                        '<div class="row" >' +
                                            '<div class="col-xs-12">' +
                                                '<a href="#">' +
                                                    '<label id="patient">id</label>' + //the patient id as lable text
                                                '</a>' +
                                                '<ul class="nav navbar-top-links navbar-right">' +
                                                '<li class="dropdown">' +
                                                    '<button class="dropdown-toggle btn btn-md btn-circle chat-nav" data-toggle="dropdown" href="#">' +
                                                        '<i  style="background-color:#fff" class="fa fa-th fa-fw"></i> <i style="background-color:#fff" class="fa fa-caret-down"></i>' +
                                                   ' </button>' +
                                                    '<ul class="dropdown-menu dropdown-user">' +
                                                        '<li>' +
                                                            '<a href="#" id="pres-btn" value="" data-target="modal" data-toogle="launch-modal"><i style="color:#333;" class="fa fa-plus-square fa-fw"></i> Add Prescription</a>' +
                                                       ' </li>' +
                                                        '<li class="divider"></li>' +
                                                        '<li>' +
                                                            '<a href="#" id="close-btn" href="#" class="pb-chat-top-icons btn-chat-close" value="" data-target="chat" data-toogle="remove-chat"><i style="color:#333;" class="fa fa-sign-out fa-fw"></i> Close Chat</a>' +
                                                        '</li>' +
                                                    '</ul>' +
                                                '</li>' +
                                            '</ul>' + 
                                            '</div>' + 
                                        '</div>' +
                                    '</div>' +
                                    '<div class="panel-body" style="background-color:#333; padding-top:0;">' +
                                        '<form style="height:350px;overflow-y:scroll;padding-top:20px;" id="msg">' + //patient id +"-msg" as form id
                                        '</form>' +
                                    '</div>' +
                                    '<div class="panel-footer" style="background-color:#333;">' + 
                                        '<div class="row">' +
                                            '<div id="alert" class="alert alert-danger alert-dismissable hide">' +
                                                '<button id="alert-close" type="button" class="close" aria-hidden="true" data-target="" data-toogle="alert-close">&times;</button>' +
                                                'Failed to send message. Pleas check your connection' +
                                            '</div>' +
                                            '<div class="col-xs-10">' +
                                                '<textarea id="text-msg" class="form-control pb-chat-textarea"  placeholder="Type your message here..." data-toogle="send-msg" autofocus></textarea>' + //patient id + "text" as textarea id
                                            '</div>' +
                                            '<div class="col-xs-2 pb-btn-circle-div">' +
                                                '<a id="send-btn" class="btn btn-primary btn-circle pb-chat-btn-circle fa fa-send" dat-target"id" data-toogle="send-msg"></a>' + //patient id
                                            '</div>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                            '</div>';

                $('#chats').append($(chat));
                $('#chat').attr("id",id+"-chat");
                $('#patient').html("Patient ID: "+id);
			$('#patient').append("<br>Patient name: "+name);
                $('#patient').attr("id",id+"-lable");
                $('#close-btn').data("target",id+"-chat");
                $('#close-btn').attr("value",id);
                $('#close-btn').attr("id",id+"-close");
                $('#alert').attr("id",id+"-alert");
                $('#alert-close').data("target",id+'-alert');
                $('#alert-close').attr("id",id+"-close-alert");
                $('#msg').attr("id",id+"-msg");
                $('#text-msg').data("target",id);
                $('#text-msg').attr("id",id+"-text");
                $('#send-btn').data("target",id);
                $('#send-btn').attr("id",id+"-send");
                $('#pres-btn').attr("value",id);
                $('#pres-btn').attr("id",id+"-pres");
            }
           
        function sendMsg(msg,frm,id){
            var chat = '<div class="form-group" style="width:100%;padding-top:20px;" >'+
                            '<span class="fa fa-lg fa-user pb-chat-fa-user pull-right"></span>' +
                            '<p class="pb-chat-labels pb-chat-labels-right pull-right" style="max-width:60%;">'+msg+'</p>' +
                        '</div>' +
                        '<div class="clearfix divider"></div>';
            $('#'+id+"-alert").show(500);
            $.post("../db/sendMsg.php",{"receiver":id,"msg":msg,"sender":0})
            .done(function(msg){
                data=$.parseJSON(msg);
                if(data){
                    $('#'+id+"-alert").hide(0);
                    $('#'+id+"-alert").addClass("hide");
                    $(frm).append($(chat));            
                    $(frm).animate({"scrollTop":$(frm)[0].scrollHeight}, 2000);
                }
            });
            $('#'+id+"-alert").removeClass("hide");
        }
        function getMsg(msg,frm){
            var chat = '<div class="form-group" style="width:100%;">'+
                            '<span class="fa fa-lg fa-user pb-chat-fa-user pull-left"></span>' +
                            '<p class="pb-chat-labels pb-chat-labels-left pull-left" style="max-width:60%;">'+msg+'</p>' +
                        '</div>' +
                        '<div class="clearfix divider"></div>';
            $(frm).append($(chat));
            $(frm).animate({"scrollTop":$(frm)[0].scrollHeight}, 2000);      
        }
        function getSym(id,nme){
            $.post( "../db/getSymU.php",{"id":id})
            .done(function( online ) {
        	    data = $.parseJSON(online);
                if(data){
                    var i=0;
                    var msg='<p style="background-color:darkviolet;color:#fff;display:inline;float:right;padding:4px;">Hello? The patient selected:</br>';
                    var frm='#'+id+"-msg";
                    for(i=0;i<data.length;i++){
                        msg +=data[i].inf+" of type " + data[i].type +', ';
                    }
                    getMsg(msg+"</br>Pleas wait for the patient to give his/her age first</p>",frm);
                }
            });
        }
        function newRow(id){
            var e='<tr id="'+'pres-row'+$('#pres-list').children().length +'">' +
                        '<td class="drug">'+
                            '<input type="text" class="form-control" placeholder="Drug" required autofocus>'+
                        '</td>'+
                        '<td class="amount">'+
                            '<input type="text" class="form-control" placeholder="Quanty" required>'+
                        '</td>'+
                        '<td class="pres">'+
                            '<input type="text" class="form-control" placeholder="Prescription" required>'+
                        '</td>'+
                        '<td class="text-center">'+
                            '<a id="'+id+1+'" class="fa fa-plus btn btn-circle" style="font-size:16px;color:;height:30px;width:40px;" data-toogle="new-pres"></a>'+  
                        '</td>'+
                    '</tr>';
            $('#pres-list').append(e);
        }
        function postPres(id,drug,amount,pres)
        {
            $.post("../db/sendPres.php",{"id":id,"drug":drug,"amount":amount,"pres":pres,"doc":docId})
            .done(function(msg){
                data=$.parseJSON(msg);
                if(data){
                }
            });
            if($.trim($('#doc-des').val()>'')){
            $.post("../db/sendPres.php",{"id":id,"des":$('#doc-des').val()})
            .done(function(msg){
                data=$.parseJSON(msg);
                if(data){
                }
            });
            }
            $('#doc-des').val('');
        }
    </script>

