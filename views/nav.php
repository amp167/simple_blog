<nav class="navbar navbar-expand-lg bg-primary navbar-dark english">
    <div class="container">
        <a class="navbar-brand" href="index.php">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">NEWS</a>
                </li>
                <?php
                include_once ('sysgem/postgenerator.php');
                $result = getSubject();
                foreach ($result as $subject) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="filterPost.php?sid=<?= $subject['id'] ?>"><?= strtoupper($subject['subject']) ?></a>
                    </li>
                <?php endforeach; ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <?php
                        if (checkSession('username')) {
                            echo getSession('username');
                        } else {
                            echo "Member";
                        }
                        ?>
                    </a>
                    <ul class="dropdown-menu">
                        <?php
                        if (checkSession('username')) {
                            echo "<li><a class='dropdown-item' href='logout.php'>Logout</a></li>";
                        } else {
                            echo "<li><a class='dropdown-item' href='register.php'>Register</a></li>
                        <li><a class='dropdown-item' href='login.php'>Login</a></li>";
                        }
                        ?>


                    </ul>
                </li>

            </ul
        </div>
    </div>
</nav>

