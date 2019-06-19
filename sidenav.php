<?php 
$memberinfo=getMemberInfo();
$usergroup=$memberinfo['group'];
switch ($usergroup) {
	case 'doctor':
		# code...
    echo '<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Infections">
    <a class="nav-link" href="infections_view.php">
    <i class="fa fa-fw fa-building"></i>
    <span class="nav-link-text">Infections</span>
    </a>
    </li>
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Symptoms">
    <a class="nav-link" href="symptoms_view.php">
    <i class="fa fa-fw fa-pie-chart"></i>
    <span class="nav-link-text">Symptoms</span>
    </a>
    </li>
    
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Descriptions">
    <a class="nav-link" href="descriptions_view.php">
    <i class="fa fa-fw fa-file-text"></i>
    <span class="nav-link-text">Descriptions</span>
    </a>
    </li>
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Online">
    <a class="nav-link" href="online_view.php">
    <i class="fa fa-fw fa-user"></i>
    <span class="nav-link-text">Online</span>
    </a>
    </li>
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Pharmacy">
    <a class="nav-link" href="pharmacy_view.php">
    <i class="fa fa-fw fa-user"></i>
    <span class="nav-link-text">Pharmacy</span>
    </a>
    </li>';
  break;
  case 'Class reps':
			# code...
  echo'<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Class TTs">
  <a class="nav-link" href="class_time_table_view.php">
  <i class="fa fa-fw fa-file"></i>
  <span class="nav-link-text">Class TTs</span>
  </a>
  </li>
  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Exam TTs">
  <a class="nav-link" href="exam_time_table_view.php">
  <i class="fa fa-fw fa-book"></i>
  <span class="nav-link-text">Exam TTs</span>
  </a>
  </li>
  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Exam TTs">
  <a class="nav-link" href="descriptions_view.php">
  <i class="fa fa-fw fa-user"></i>
  <span class="nav-link-text">Descriptions</span>
  </a>
  </li>
  ';
  break;

  default:
		# code...
  echo '<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Infections">
  <a class="nav-link" href="infections_view.php">
  <i class="fa fa-fw fa-building"></i>
  <span class="nav-link-text">Infections</span>
  </a>
  </li>
  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Symptoms">
  <a class="nav-link" href="symptoms_view.php">
  <i class="fa fa-fw fa-pie-chart"></i>
  <span class="nav-link-text">Symptoms</span>
  </a>
  </li>
  
  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Descriptions">
  <a class="nav-link" href="descriptions_view.php">
  <i class="fa fa-fw fa-list-alt"></i>
  <span class="nav-link-text">Descriptions</span>
  </a>
  </li>
  <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Online">
  <a class="nav-link" href="online_view.php">
  <i class="fa fa-fw fa-user"></i>
  <span class="nav-link-text">Online</span>
  </a>
  </li>';
  break;
}


?>