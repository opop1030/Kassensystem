<div class="nopadding content">
    <?php
    if($special == "Eingangsmenge") {
        echo form_open('Datahandler/refillItem/' . $itemId);
    }
    else{
        echo form_open('Datahandler/repriceItem/' . $itemId);
    }
    echo form_label($special.' : ', 'amount');
    echo form_input('amount', 0, 'id=amount');
    echo '<div class="table-responsive">';
    echo $tabledata;
    echo '</div>';
    echo '<br/>'.form_submit('submit', 'Bestaetigen!', 'class="btn btn-default"');
    echo '<br/>'.anchor('Datahandler/show_lager','Abbrechen!', 'class="btn btn-default"');
    echo form_close();
    ?>
</div>