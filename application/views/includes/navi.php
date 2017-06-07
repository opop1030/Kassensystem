<?php
if($status["shownavi"] === true)
{
    if($status["login"][0] !== false)
    {

        echo '<ul class="col-sm-3 nopadding menu" style="list-style-type: none;margin: 0;padding: 0;">';
        echo '<p class="menutext">Willkommen, '.$status["login"][1].'</p>';
        echo '<li class="menupoint">' . anchor('cashpoint', 'Kasse') . '</li>';
        echo '<li class="menupoint">' . anchor('datahandler/show_lager', 'Lager') . '</li>';
        if($status["login"][2] > 0 && $status["login"][2] <= 2) {
            echo '<li class="menupoint">' . anchor('datahandler/show_kunden', 'Kunden Verwalten') . '</li>';
            echo '<li class="menupoint">' . anchor('datahandler/show_bestellungen', 'Bestellungen Verwalten') . '</li>';
            if ($status["login"][2] == 2) {
                echo '<li class="menupoint">' . anchor('datahandler/show_mitarbeiter', 'Mitarbeiter Verwalten') . '</li>';
            }
        }
        echo '<li class="menupoint">' . anchor('logout', 'Ausloggen'). '</li>';
        echo '</ul>';
    }
    else
    {
        echo '<ul class="col-sm-3 nopadding menu" style="list-style-type: none;margin: 0;padding: 0;">';
        echo '<li class="menupoint">' . anchor('login', 'Login') . '</li>';
        echo '</ul>';
    }
}
?>