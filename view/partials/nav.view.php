<nav>

    <div>
        <span class="logo">FanStaF</span>
    </div>

    <?php if (isset($_SESSION['user'])): ?>
        <div>
            <a href="/messages">New Message</a>
            <a href="/friends">Friends</a>
        </div>
        <div>
            <a href="/logout">Logout</a>
        </div>
    <?php else: ?>
        <div>
            <a href="/login">Login</a>
            <a href="/register">Register</a>
        </div>
    <?php endif; ?>

</nav>