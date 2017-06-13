<div class="nopadding content">
    <h2>Artikelregistration</h2>
    <hr/>
    <br/>
    <?php
    echo form_open('Datahandler/registerItem');
    echo form_label('Artikel-Nr.: ','artikelnr');
    echo form_input('artikelnr','', 'id=artikelnr');
    echo '<br/>';
    echo form_label('Bezeichnung: ','bezeichnung');
    echo form_input('bezeichnung','', 'id=bezeichnung');
    echo '<br/>';
    echo form_label('Bestand: ','bestand');
    echo form_input('bestand','0', 'id=bestand');
    echo '<br/>';
    echo form_label('Preis','preis');
    echo form_input('preis','0', 'id=preis');
    echo '<br/>';
    echo '<br/>'.form_submit('submit', 'Bestaetigen!', 'class="btn btn-default"');
    echo '<br/>'.anchor('Datahandler/show_kunden','Abbrechen!', 'class="btn btn-default"');
    echo form_close();
    ?>
</div>