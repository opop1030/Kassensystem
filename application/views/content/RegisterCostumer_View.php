<div class="nopadding content">
    <h2>Kundenregistration</h2>
    <hr/>
    <br/>
    <?php
    echo form_open('Datahandler/addCostumer');
    echo form_label('Name : ','name');
    echo form_input('name','', 'id=name');
    echo '<br/>';
    echo form_label('Vorname : ','vorname');
    echo form_input('vorname','','id=vorname');
    echo '<br/>';
    echo form_label('Adresse : ','adress');
    echo form_input('adress','','id=adress');
    echo '<br/>';
    echo form_label('Hausnr. : ','hanr');
    echo form_input('hanr','','id=hanr');
    echo '<br/>';
    echo form_label('PLZ : ','plz');
    echo form_input('plz','','id=plz');
    echo '<br/>';
    echo form_label('Ort : ','ort');
    echo form_input('ort','','id=ort');
    echo '<br/>';
    echo form_label('(Optional) Telefon : ','tel');
    echo form_input('tel','','id=tel');
    echo '<br/>';
    echo form_label('(Optional) E-mail : ','email');
    echo form_input('email','','id=email');
    echo '<br/>';
    echo '<br/>'.form_submit('submit', 'Bestaetigen!', 'class="btn btn-default"');
    echo '<br/>'.anchor('Datahandler/show_kunden','Abbrechen!', 'class="btn btn-default"');
    echo form_close();
    ?>
</div>