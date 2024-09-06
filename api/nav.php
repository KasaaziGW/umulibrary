<nav class="navbar navbar-expand-lg fixed-top" id="mainNav">
    <a class="navbar-brand waves-effect waves-dark profile-pic" href="index.php">Hello <strong><?= $userInfo[0]; ?></strong> | <?php echo '<img src="./pics/' . $picName . '" alt="user" />'; ?></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a class="nav-link" id="nav-item" href="index.php">
                    <i class="fa fa-fw fa-dashboard"></i>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>
            <?php if ($role == 'admin') : ?>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Uploads">
                    <a class="nav-link nav-link-collapse collapsed" id="nav-item" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
                        <!-- <i class="fa fa-fw fa-wrench"></i> -->
                        <i class="fa fa-product-hunt" aria-hidden="true"></i>
                        <span class="nav-link-text">Uploads</span>
                    </a>
                    <ul class="sidenav-second-level collapse" id="collapseComponents">
                        <li>
                            <a class="nav-link" id="nav-item" href="addpapers.php">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                <span class="nav-link-text">Past Papers</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" id="nav-item" href="#">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                <span class="nav-link-text">Dissertations</span>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php else : ?>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Library">
                    <a class="nav-link nav-link-collapse collapsed" id="nav-item" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
                        <!-- <i class="fa fa-fw fa-wrench"></i> -->
                        <i class="fa fa-product-hunt" aria-hidden="true"></i>
                        <span class="nav-link-text">Library</span>
                    </a>
                    <ul class="sidenav-second-level collapse" id="collapseComponents">
                        <li>
                            <a class="nav-link" id="nav-item" href="./viewpapers.php">
                                <i class="fa fa-paperclip" aria-hidden="true"></i>
                                <span class="nav-link-text">Past Papers</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" id="nav-item" href="#">
                                <i class="fa fa-book" aria-hidden="true"></i>
                                <span class="nav-link-text">Dissertations</span>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php endif ?>

            <?php if ($role == 'admin') : ?>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Course Management">
                    <a class="nav-link nav-link-collapse collapsed" id="nav-item" data-toggle="collapse" href="#collapseComponents4" data-parent="#exampleAccordion">
                        <!-- <i class="fa fa-fw fa-wrench"></i> -->
                        <i class="fa fa-bar-chart" aria-hidden="true"></i>
                        <span class="nav-link-text">Course Management</span>
                    </a>
                    <ul class="sidenav-second-level collapse" id="collapseComponents4">
                        <li>
                            <a class="nav-link" id="nav-item" href="newcourse.php">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                <span class="nav-link-text">Add Course</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" id="nav-item" href="addcourseunit.php">
                                <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                                <span class="nav-link-text">Add Course Unit</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" id="nav-item" href="viewcourses.php">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                <span class="nav-link-text">View Courses</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Course Update">
                    <a class="nav-link" id="nav-item" href="coursedetails.php">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        <span class="nav-link-text">Edit Semester/Year</span>
                    </a>
                </li>
            <?php endif ?>

            <?php if ($role == 'admin') : ?>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Users">
                    <a class="nav-link nav-link-collapse collapsed" id="nav-item" data-toggle="collapse" href="#collapseComponents1" data-parent="#exampleAccordion">
                        <i class="fa fa-fw fa-wrench"></i>
                        <!-- <i class="fa fa-product-hunt" aria-hidden="true"></i> -->
                        <span class="nav-link-text">Users</span>
                    </a>
                    <ul class="sidenav-second-level collapse" id="collapseComponents1">
                        <li>
                            <a class="nav-link" id="nav-item" href="register.php">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                <span class="nav-link-text">Add User</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" id="nav-item" href="viewusers.php">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                <span class="nav-link-text">View User(s)</span>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php endif ?>

            <?php if ($role == 'user'): ?>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Settings">
                    <a class="nav-link nav-link-collapse collapsed" id="nav-item" data-toggle="collapse" href="#collapseComponents2" data-parent="#exampleAccordion">
                        <i class="fa fa-fw fa-wrench"></i>
                        <!-- <i class="fa fa-product-hunt" aria-hidden="true"></i> -->
                        <span class="nav-link-text">Settings</span>
                    </a>
                    <ul class="sidenav-second-level collapse" id="collapseComponents2">
                        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Set Password">
                            <a class="nav-link" id="nav-item" data-toggle="modal" data-target="#setPasswordModal">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                                <span class="nav-link-text">Set Password</span>
                            </a>
                        </li>
                        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Set Course">
                            <a class="nav-link" id="nav-item" id="nav-item" href="./addCourse.php">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                <span class="nav-link-text">Set Course</span>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php endif ?>

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Logout">
                <a class="nav-link" id="nav-item" data-toggle="modal" data-target="#exampleModal">
                    <i class="fa fa-fw fa-sign-out"></i>
                    <span class="nav-link-text">Logout</span>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link"><span class="h5 mb-4"><strong>Uganda Martyrs University Library System</strong></span></a>
            </li>
        </ul>
    </div>
</nav>