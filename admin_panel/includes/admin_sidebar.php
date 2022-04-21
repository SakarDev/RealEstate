<nav id="sidebar">
    <div class="p-4 pt-5">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto"></ul>
        </div>

        <ul class="list-unstyled components mb-5">
            <span class="fs-5 d-none d-sm-inline text-white">Menu</span>
            <li class="nav-item <?php if($page=='dashboard') echo 'active'; ?>"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
            <li class="nav-item <?php if($page=='post') echo 'active'; ?>"><a class="nav-link" href="post.php">Posts</a></li>
            <li class="nav-item <?php if($page=='user') echo 'active'; ?>"><a class="nav-link" href="user.php">Users</a></li>
            <li class="nav-item <?php if($page=='propertyType') echo 'active'; ?>"><a class="nav-link" href="propertyType.php">Property Type </a></li>
            <li class="nav-item <?php if($page=='city') echo 'active'; ?>"><a class="nav-link" href="city.php">City</a></li>
            <li class="nav-item <?php if($page=='town') echo 'active'; ?>"><a class="nav-link" href="town.php">Town</a></li>
            <li class="nav-item <?php if($page=='street') echo 'active'; ?>"><a class="nav-link" href="street.php">Street</a></li>
        </ul>
    </div>
</nav>