<?php
// This script and data application were generated by AppGini 5.72
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/personal_details.php");
	include("$currDir/personal_details_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('personal_details');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "personal_details";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`personal_details`.`id`" => "id",
		"`personal_details`.`full_name`" => "full_name",
		"IF(    CHAR_LENGTH(`infections1`.`name`), CONCAT_WS('',   `infections1`.`name`), '') /* Infection */" => "infection",
		"IF(    CHAR_LENGTH(`symptoms1`.`name`), CONCAT_WS('',   `symptoms1`.`name`), '') /* Symptom */" => "symptom",
		"`personal_details`.`category`" => "category"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`personal_details`.`id`',
		2 => 2,
		3 => '`infections1`.`name`',
		4 => '`symptoms1`.`name`',
		5 => 5
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`personal_details`.`id`" => "id",
		"`personal_details`.`full_name`" => "full_name",
		"IF(    CHAR_LENGTH(`infections1`.`name`), CONCAT_WS('',   `infections1`.`name`), '') /* Infection */" => "infection",
		"IF(    CHAR_LENGTH(`symptoms1`.`name`), CONCAT_WS('',   `symptoms1`.`name`), '') /* Symptom */" => "symptom",
		"`personal_details`.`category`" => "category"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`personal_details`.`id`" => "ID",
		"`personal_details`.`full_name`" => "Full name",
		"IF(    CHAR_LENGTH(`infections1`.`name`), CONCAT_WS('',   `infections1`.`name`), '') /* Infection */" => "Infection",
		"IF(    CHAR_LENGTH(`symptoms1`.`name`), CONCAT_WS('',   `symptoms1`.`name`), '') /* Symptom */" => "Symptom",
		"`personal_details`.`category`" => "Category"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`personal_details`.`id`" => "id",
		"`personal_details`.`full_name`" => "full_name",
		"IF(    CHAR_LENGTH(`infections1`.`name`), CONCAT_WS('',   `infections1`.`name`), '') /* Infection */" => "infection",
		"IF(    CHAR_LENGTH(`symptoms1`.`name`), CONCAT_WS('',   `symptoms1`.`name`), '') /* Symptom */" => "symptom",
		"`personal_details`.`category`" => "category"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array(  'infection' => 'Infection', 'symptom' => 'Symptom');

	$x->QueryFrom = "`personal_details` LEFT JOIN `infections` as infections1 ON `infections1`.`id`=`personal_details`.`infection` LEFT JOIN `symptoms` as symptoms1 ON `symptoms1`.`id`=`personal_details`.`symptom` ";
	$x->QueryWhere = '';
	$x->QueryOrder = '';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm[2]==0 ? 1 : 0);
	$x->AllowDelete = $perm[4];
	$x->AllowMassDelete = false;
	$x->AllowInsert = $perm[1];
	$x->AllowUpdate = $perm[3];
	$x->SeparateDV = 1;
	$x->AllowDeleteOfParents = 0;
	$x->AllowFilters = 1;
	$x->AllowSavingFilters = 0;
	$x->AllowSorting = 1;
	$x->AllowNavigation = 1;
	$x->AllowPrinting = 1;
	$x->AllowCSV = 1;
	$x->RecordsPerPage = 10;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation["quick search"];
	$x->ScriptFileName = "personal_details_view.php";
	$x->RedirectAfterInsert = "personal_details_view.php?SelectedID=#ID#";
	$x->TableTitle = "Personal details";
	$x->TableIcon = "resources/table_icons/administrator.png";
	$x->PrimaryKey = "`personal_details`.`id`";

	$x->ColWidth   = array(  150, 150, 150, 150);
	$x->ColCaption = array("Full name", "Infection", "Symptom", "Category");
	$x->ColFieldName = array('full_name', 'infection', 'symptom', 'category');
	$x->ColNumber  = array(2, 3, 4, 5);

	// template paths below are based on the app main directory
	$x->Template = 'templates/personal_details_templateTV.html';
	$x->SelectedTemplate = 'templates/personal_details_templateTVS.html';
	$x->TemplateDV = 'templates/personal_details_templateDV.html';
	$x->TemplateDVP = 'templates/personal_details_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HighlightColor = '#FFF0C2';

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))){ $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])){ // view owner only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `personal_details`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='personal_details' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `personal_details`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='personal_details' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`personal_details`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: personal_details_init
	$render=TRUE;
	if(function_exists('personal_details_init')){
		$args=array();
		$render=personal_details_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: personal_details_header
	$headerCode='';
	if(function_exists('personal_details_header')){
		$args=array();
		$headerCode=personal_details_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: personal_details_footer
	$footerCode='';
	if(function_exists('personal_details_footer')){
		$args=array();
		$footerCode=personal_details_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>