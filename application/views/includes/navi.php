<?php
if($status["shownavi"] === true)
{
    echo '<ul class="col-sm-3 nopadding menu" style="list-style-type: none;margin: 0;padding: 0;">';
    echo '<li class="menupoint">'.anchor('cashpoint', 'Kasse').'</li>';
    echo '<li class="menupoint">'.anchor('#', 'Vorbestellen').'</li>';
    echo '<li class="menupoint">'.anchor('#', 'Lager').'</li>';
    echo '<li class="menupoint">'.anchor('#', 'Kunden Verwalten').'</li>';
    echo '<li class="menupoint">'.anchor('#', 'Mitarbeiter Verwalten').'</li>';
    echo '</ul>';
}
?>