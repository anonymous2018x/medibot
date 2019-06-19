<!-- Icon Cards-->
<div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-building"></i>
              </div>
              <div class="mr-5"><?php datacounter("infections"); ?> Infections</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="infections_view.php">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-pie-chart"></i>
              </div>
              <div class="mr-5"><?php datacounter("symptoms"); ?> Symptoms</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="symptoms_view.php">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-info o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-list-alt"></i>
              </div>
              <div class="mr-5"><?php datacounter("descriptions"); ?> Descriptions</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="descriptions_view.php">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
		</div>
		
		<div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-user"></i>
              </div>
              <div class="mr-5"><?php online("doctor"); ?> Online</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="online_view.php">
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
      </div>
      <!--second row cards-->