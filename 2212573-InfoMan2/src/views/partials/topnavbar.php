<nav class="navbar navbar-expand-lg nav-bg">
    <div class="container">
        <a class="navbar-brand" href="home.php">Birdy</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <form class="d-flex" method="get">
            <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-secondary" type="submit">Search</button>
        </form>

        <div class="d-flex">
            <span class="mx-3">
                <?=
                $firestore->database()
                    ->collection('users')
                    ->document($_SESSION['userId'])
                    ->snapshot()['username']
                ?>
            </span>
            <form action="" method="post">
                <button type="submit" name='logout' class="btn btn-primary">Logout</button>
            </form>
        </div>
    </div>
</nav>