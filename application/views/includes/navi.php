<?php if($status["shownavi"] === true){
    echo '<div class="col-sm-3 nopadding menu">
    <div class="menupoint">
        <a> Kasse</a>
    </div>
    <div class="menupoint">
        <a>Vorbestellen</a>
    </div>
    <div class="menupoint">
        <a>Lager</a>
    </div>
    <div class="menupoint">
        <a>Kunden Verwalten</a>
    </div>
    <!-- Kann nur der Admin -->
    <div class="menupoint">
        <a>Mitarbeiter Verwalten</a>
    </div>
</div>';
}
else{
    echo '<h1>Dies ist keine Normale Seite</h1>';
}
?>