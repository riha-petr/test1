<body>
    <header>
        <div class="header_inner">
            <div class="navigation">
                <div class="logo">
                    <span>NordicMann band</span>
                </div>
                <div class="menu-items">
                    <ul class="items">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="musica.php">Musica</a></li>
                        <li><a href="albums.php">Albums</a></li>
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <li><a href="admin/index.php">Admin</a></li>
                            <li><a href="admin/logout.php">Logout</a></li>
                        <?php else: ?>
                            <li><a href="register.php">Register</a></li>
                            <li><a href="signin.php">Sign in</a></li>
                        <?php endif; ?>
                        <li><a href="donation.php">Donation</a></li>
                        <select name="cars" id="cars">
                            <option value="volvo">Eng</option>
                            <option value="saab">Swe</option>
                            <option value="opel">Nor</option>
                            <option value="audi">Pol</option>
                            <option value="audi">Rus</option>
                        </select>
                    </ul>
                </div>
            </div>
        </div>
    </header>

