<?php
if($status["shownavi"] === true)
{
    if($status["login"] !== false)
    {
        echo '<ul class="col-sm-3 nopadding menu" style="list-style-type: none;margin: 0;padding: 0;">';
        echo '<li class="menupoint">' . anchor('cashpoint', 'Kasse') . '</li>';
        echo '<li class="menupoint">' . anchor('reservation', 'Vorbestellen') . '</li>';
        echo '<li class="menupoint">' . anchor('datahandler/show_lager', 'Lager') . '</li>';
        echo '<li class="menupoint">' . anchor('datahandler/show_kunden', 'Kunden Verwalten') . '</li>';
        echo '<li class="menupoint">' . anchor('datahandler/show_mitarbeiter', 'Mitarbeiter Verwalten') . '</li>';
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