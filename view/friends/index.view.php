<?php view('partials/head.view.php'); ?>
<?php view('partials/nav.view.php'); ?>

<body>
    <main>
        <section class="section-container">
            <h1>My Friends</h1>
            <form action="/friends" method="POST">
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Friend</th>
                    </tr>
                    <?php
                    foreach ($currentUser->getAllUsers() as $user) {
                        echo "<tr>";
                        echo "<td>{$user['name']}</td>";

                        in_array($user['id'], $currentUser->myFriends->friendsIDList)
                            ? $checkbox = "<td><input name='{$user['id']}' type='checkbox' checked></td>"
                            : $checkbox = "<td><input name='{$user['id']}' type='checkbox' ></td>";
                        echo $checkbox;
                        echo "</tr>";
                    }
                    ?>
                </table>
                <button type="submit">Save Changes</button>
            </form>
        </section>
    </main>
</body>

<?php view('partials/foot.view.php'); ?>