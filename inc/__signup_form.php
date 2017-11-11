<div class="signup">
    <form action="signup.php?id=<?= $_GET['id']; ?>" method="post">
        <ul class="flex-teaminfo">
            <li><label for="team-name">Team name</label><input id="team-name" name="team-name" type="text" required>
            </li>
            <li><label for="p1">Team captain (Player 1)</label><input id="p1" name="p1" type="text" required></li>
            <li><label for="contact">Captain e-mail</label><input id="contact" name="contact" type="email" required>
            </li>
        </ul>
        <ul class="flex-teaminfo">
            <li><label for="p2">Player 2</label><input id="p2" name="p2" type="text" required></li>
            <li><label for="p3">Player 3</label><input id="p3" name="p3" type="text" required></li>
            <li><label for="p4">Player 4</label><input id="p4" name="p4" type="text" required></li>
        </ul>
        <ul class="flex-submit">
            <li>
                <button type="submit">
                    Sign up
                </button>
            </li>
        </ul>
    </form>
</div>