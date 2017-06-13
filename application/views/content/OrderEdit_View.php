<div class="nopadding content">
    <?php
    echo form_open('Datahandler/addOrderItem/'.$id);
    echo '<h2>'.$header.'</h2>';
    echo '<hr/><br/>';
    echo form_input('scan', set_value('scan', ''), 'id=scan autofocus');
    echo '<div class="table-responsive">';
    echo $tabledata;
    echo '</div>';
    echo '<br/>'.$special.'<br/>';
    echo form_close();
    ?>
</div>