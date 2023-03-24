<nav class="banner">

    <div>
        <span class="logo">FanStaF</span>
    </div>

    <?php if (isset($_SESSION['user'])): ?>
        <div class="nav-div">
            <form action="/messages">
                <button>View messages</button>
            </form>
            <form action="/messages" method="POST">
                <button>New message</button>
            </form>
            <form action="/friends">
                <button>Friends</button>
            </form>
        </div>
        <div class="nav-div">
            <form action="/logout">
                <button>Logout</button>
            </form>
        </div>
    <?php else: ?>
        <div class="nav-div">
            <form action="/login">
                <button>Login</button>
            </form>
            <form action="/registration">
                <button>Register</button>
            </form>
        </div>
    <?php endif; ?>

</nav>