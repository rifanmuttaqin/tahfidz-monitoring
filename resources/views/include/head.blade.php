<nav class="navbar navbar-default navbar-fixed">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-left"></ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                   <a href="<?= URL::to('/profile'); ?>">
                       <p>Profile</p>
                    </a>
                </li>
                <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <p>
        								Pengaturan
        								<b class="caret"></b>
        							</p>
                      </a>
                      <ul class="dropdown-menu">
                        <li><a href="<?= URL::to('/role'); ?>"><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span>&nbsp Role</a></li> 
                        <li><a href="<?= URL::to('/alquran'); ?>"><span class="glyphicon glyphicon-book" aria-hidden="true"></span>&nbsp Qur'an </a></li> 
                        <li><a href="<?= URL::to('/iqro'); ?>"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp Iqro </a></li> 
                      </ul>
                </li>

                 <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <p>
                        Laporan
                        <b class="caret"></b>
                      </p>
                      </a>
                      <ul class="dropdown-menu">
                        <li><a href="{{route('daily-report')}}"> Laporan Harian </a></li> 
                        <li><a href="{{route('student-report')}}"> Laporan Persiswa </a></li>
                        <li><a href="{{route('daily-report')}}"> Laporan Kekurangan </a></li> 
                      </ul>
                </li>

                <li>
                    <a href="<?= URL::to('/'); ?>/auth/logout">
                        <p>Log out</p>
                    </a>
                </li>
                <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell"></i>
                            <b class="caret hidden-lg hidden-md"></b>
                            <p class="hidden-lg hidden-md">
                                Notifications
                                <b class="caret"></b>
                            </p>
                      </a>
                      <ul class="dropdown-menu">
                        <li><a href="#">Notification 1</a></li>
                      </ul>
                </li>
				<li class="separator hidden-lg"></li>
            </ul>
        </div>
    </div>
</nav>