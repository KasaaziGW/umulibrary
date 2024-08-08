<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand waves-effect waves-dark profile-pic" href="index.php">Hello <strong><?= $fname[0]; ?></strong> | <?php echo '<img src="./pics/' . $pic . '" alt="user" />'; ?></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a class="nav-link" href="index.php">
                    <i class="fa fa-fw fa-dashboard"></i>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>
            <?php if ($role == 'admin') : ?>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Users">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
                        <!-- <i class="fa fa-fw fa-wrench"></i> -->
                        <i class="fa fa-product-hunt" aria-hidden="true"></i>
                        <span class="nav-link-text">Inventory</span>
                    </a>
                    <ul class="sidenav-second-level collapse" id="collapseComponents">
                        <li>
                            <a class="nav-link" href="import.php">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                <span class="nav-link-text">Import</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="viewinventory.php">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                <span class="nav-link-text">View</span>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php else : ?>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Inventory">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
                        <!-- <i class="fa fa-fw fa-wrench"></i> -->
                        <i class="fa fa-product-hunt" aria-hidden="true"></i>
                        <span class="nav-link-text">Inventory</span>
                    </a>
                    <ul class="sidenav-second-level collapse" id="collapseComponents">
                        <li>
                            <a class="nav-link" href="viewinventory.php">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                <span class="nav-link-text">View</span>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php endif ?>

            <?php if ($role == 'admin') : ?>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Reports">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents4" data-parent="#exampleAccordion">
                        <!-- <i class="fa fa-fw fa-wrench"></i> -->
                        <i class="fa fa-bar-chart" aria-hidden="true"></i>
                        <span class="nav-link-text">Reports</span>
                    </a>
                    <ul class="sidenav-second-level collapse" id="collapseComponents4">
                        <li>
                            <a class="nav-link" href="viewverified.php">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                <span class="nav-link-text">Verified</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="viewpending.php">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                <span class="nav-link-text">Pending</span>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php endif ?>

            <?php if ($role == 'admin') : ?>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Users">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents1" data-parent="#exampleAccordion">
                        <i class="fa fa-fw fa-wrench"></i>
                        <!-- <i class="fa fa-product-hunt" aria-hidden="true"></i> -->
                        <span class="nav-link-text">Users</span>
                    </a>
                    <ul class="sidenav-second-level collapse" id="collapseComponents1">
                        <li>
                            <a class="nav-link" href="register.php">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                <span class="nav-link-text">Add User</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="viewusers.php">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                <span class="nav-link-text">View User(s)</span>
                            </a>
                        </li>

                        <!-- <li>
                            <a class="nav-link" <?php echo 'href="updateprofile.php?eid=' . $id . '"'; ?>>
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                <span class="nav-link-text">Update Profile</span>
                            </a>
                        </li> -->

                    </ul>
                </li>
            <?php endif ?>

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Logout">
                <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
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
                <a class="nav-link"><span class="h5 mb-4"><strong>Library Inventory Management System</strong></span></a>
            </li>
        </ul>
    </div>
</nav>