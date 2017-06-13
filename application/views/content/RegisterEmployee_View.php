<div class="nopadding content">
    <h2>Mitarbeiterregistration</h2>
    <hr/>
    <br/>
    <?php
    echo form_open('Datahandler/addEmployee');
    echo form_label('Name: ','name');
    echo form_input('name','', 'id=name');
    echo '<br/>';
    echo form_label('Vorname: ','vname');
    echo form_input('vname','', 'id=vname');
    echo '<br/>';
    echo form_label('Passwort','pwd');
    echo form_password('pwd','', 'id=pwd');
    echo '<br/>';
    echo '<br/>'.form_submit('submit', 'Bestaetigen!', 'class="btn btn-default"');
    echo '<br/>'.anchor('Datahandler/show_mitarbeiter','Abbrechen!', 'class="btn btn-default"');
    echo form_close();
    ?>
</div>