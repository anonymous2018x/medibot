<!DOCTYPE html>
<?php

require_once('../db/conn.php');

$id= isset($_REQUEST['login']) ? $_REQUEST['login'] : '1';
if(strlen($id)<8){
    header("Location:../pages/index.php");   
}
?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Medibot phamacy panel</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>
<style type="text/css">
body{
    background: -webkit-linear-gradient(left, #333, #888);
   
}
        .register{
    margin-top: 3%;
    padding: 3%;
}
.register-left{
    text-align: center;
    color: #fff;
    margin-top: 0%;
}

.register-right{
    background: -webkit-linear-gradient(left, #444, #777);;
    padding:20px;
    margin-top: 3%;
    border-top-left-radius: 10% 50%;
    border-bottom-left-radius: 10% 50%;
}
.register-left img{
    margin-top: 15%;
    margin-bottom: 5%;
    width: 25%;
    -webkit-animation: mover 2s infinite  alternate;
    animation: mover 1s infinite  alternate;
}
@-webkit-keyframes mover {
    0% { transform: translateY(0); }
    100% { transform: translateY(-20px); }
}
@keyframes mover {
    0% { transform: translateY(0); }
    100% { transform: translateY(-20px); }
}
.register-left p{
    font-weight: lighter;
    padding: 12%;
    margin-top: -9%;
}
.register .register-form{
    padding: 10%;
    margin-top: 10%;
}
.btnRegister{
    float: right;
    margin-top: 10%;
    border: none;
    border-radius: 1.5rem;
    padding: 2%;
    background: #0062cc;
    color: #fff;
    font-weight: 600;
    width: 50%;
    cursor: pointer;
}
.register .nav-tabs{
    margin-top: 3%;
    border: none;
    background: #0062cc;
    border-radius: 1.5rem;
    width: 28%;
    float: right;
}
.register .nav-tabs .nav-link{
    padding: 2%;
    height: 34px;
    font-weight: 600;
    color: #fff;
    border-top-right-radius: 1.5rem;
    border-bottom-right-radius: 1.5rem;
}
.register .nav-tabs .nav-link:hover{
    border: none;
}
.register .nav-tabs .nav-link.active{
    width: 100px;
    color: #0062cc;
    border: 2px solid #0062cc;
    border-top-left-radius: 1.5rem;
    border-bottom-left-radius: 1.5rem;
}
.register-heading{
    text-align: center;
    margin-top: 8%;
    margin-bottom: -15%;
    color: #495057;
}
.pre-panel{
    background: inherit;
    color: #fff;
}
</style>
<body>
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

<div class="container register">
                <div class="row">
                    <div class="col-md-4 register-left">
                        <h3>Medibot Phamacy</h3>
                        <img src="../ico.ico" alt=""/>
                            <input id="pid" type="number" class="form-control" placeholder="Enter ref code" required/>
                            <br/>
                            <input type="submit" id="pre-btn" value="submit" class="form-control btn btn-md btn-primary" data-toogle="get-pres"/>
                        </div>
                    <div class="col-md-8 register-right">
                    <br/>
                    <br/>
                    <div class="panel panel-info col-md-11 pull-right"style="background:#ddd;color:#000;border-radius:5%;">
                    <div class="panel-heading pre-panel" style="background:violet; color:#fff;border-radius:5%;">
                       View Prescriptions
                    </div>
                    <div class="panel-body" style="max-height:200px;overflow-y:scroll;">
                        <table class="table table-responsive-lg container ">
                        <thead class="thead-light">
                            <th >Drug</th>
                            <th >Quanty</th>
                            <th >Pres</th>
                            <th >Available</th>
                        </thead>
                        <tbody id="pres-list">
                            
                        </tbody>
                    </table>
                    </div>
                    <div class="panel-footer pre-panel" style="background:#333; color:#fff;border-radius:5%;">
                        <label for="">Doc id:</label><span id="docId"></span>
                        <br/>
                        <label for="">Description:</label>
                        <br/>
                        <div class="col-md" style="background:#ddd;color:#000">
                            <textarea style="background:#ddd;color:#000;border-radius:10%;" id="dod-des" class="form-control pb-chat-textarea pre-panel" rows="6"  placeholder="Doctors description"></textarea>
                        </div>
                    </div>
                </div>
                <br/>
                <br/>        
                    </div>
                </div>

            </div>
    
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
            switch($('#'+event.target.id).data('toogle')){
                case 'get-pres':
                $('#pres-list').children().remove();
                $('#dod-des').val('');
                var pid=$('#pid').val();
                if(pid>0){
                $.post( "../db/getpres.php",{"pid":pid})
                .done(function( pres ) {
        	        data = $.parseJSON(pres);
                    if(data){
                        var i=0;
                        for(i=0;i<data.length;i++){
                            newRow(data[i].drug,data[i].amount,data[i].pres);
                            $('#docId').text(data[i].doc);
                        }
                    }
                });
                $.post( "../db/getdes.php",{"pid":pid})
                .done(function( pres ) {
        	        data = $.parseJSON(pres);
                    if(data){
                        var i=0;
                        for(i=0;i<data.length;i++){
                            $('#dod-des').val($('#dod-des').val() +'\t'+data[i].des);
                        }
                    }
                });
                } $('#pid').val('');
                 break;
            }
               
        });

        $(document).ready(function(){
        });
        function newRow(drug,amount,pres){
            var e='<tr id="'+'pres-row'+$('#pres-list').children().length +'">' +
                        '<td class="drug">'+
                            '<p type="text" class="" placeholder="Drug" >'+drug+
                        '</td>'+
                        '<td class="amount">'+
                            '<p type="text" class="" placeholder="Quanty" >'+amount+
                        '</td>'+
                        '<td class="pres">'+
                            '<p type="text" class="" placeholder="Prescription" >'+pres+
                        '</td>'+
                        '<td class="pres">'+
                            '<input type="checkbox" class="form-control pre-panel" placeholder="Prescription" />'+
                        '</td>'+
                    '</tr>';
            $('#pres-list').append(e);
        }
</script>

