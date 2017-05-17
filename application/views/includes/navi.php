<div class="w3-container">
    <ul class="w3-navbar">
        <?php
            //$status wird übergeben und ist ein array... status[navi] ist die sichtbarkeit des Navis und
            //bereits behandelt in content.php
            echo anchor('home', 'Home');
            if ($status["login"] === true)
            {
                echo anchor('profile', 'Profil');
                echo anchor('logout', 'Logout');
            }
            else{
                echo anchor('login', 'Login', 'class="w3-hover-blue-grey"');
            }
        ?>
    </ul>
</div>