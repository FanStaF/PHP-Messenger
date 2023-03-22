<nav>

    <div>
        <span class="logo">FanStaF</span>
    </div>

    <?php if (isset($_SESSION['user'])): ?>
        <div>
            <a href="/messages">View Messages</a>
            <form action="/messages" method="POST">
                <button>New Message</button>
            </form>
            <a href="/friends">Friends</a>
        </div>
        <div>
            <a href="/logout">Logout</a>
        </div>
    <?php else: ?>
        <div>
            <a href="/login">Login</a>
            <a href="/registration">Register</a>
        </div>
    <?php endif; ?>

</nav>