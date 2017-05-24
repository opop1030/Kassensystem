<?php
$naviContent = "";
if($status["shownavi"] === true)
{
    $naviContent.= '<ul class="col-sm-3 nopadding menu">
    <li class="menupoint">
        <a> Kasse</a>
    </li>
    <li class="menupoint">
        <a>Vorbestellen</a>
    </li>
    <li class="menupoint">
        <a>Lager</a>
    </li>
    <li class="menupoint">
        <a>Kunden Verwalten</a>
    </li>
    <!-- Kann nur der Admin -->
    <li class="menupoint">
        <a>Mitarbeiter Verwalten</a>
    </li>
    </ul>';
}
else
{
    echo '<h1>Dies ist keine Normale Seite</h1>';
}
?>