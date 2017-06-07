<div class="nopadding content">
    <?php
    echo form_open('Cashpoint/reserveOrder');
    echo '<br/>';
    echo form_label('Kunde :','costumer');
    echo '<br/>';
    echo form_dropdown('costumer', $select);
    echo '<br/>';
    $this->table->set_heading(array('Name', 'Price', 'Amount'));
    $price = 0;
    $itemCount = count($special["itemlist"]);
    if($itemCount !== 0) {
        foreach ($special["itemlist"] as $item) {
            $this->table->add_row($item["name"], $item["cost"], $item["amount"]);
            $price += $item["cost"] * $item["amount"];
        }
    }
    $template = array(
        'table_open' => '<table class="table table-bordered table-hover">'
    );
    $this->table->set_template($template);
    echo $this->table->generate();
    echo '<br/>';
    echo '<br/>';
    echo '<p>Gesammtbetrag: '.$price.'&euro;</p>';
    echo '<br/>';
    echo form_submit('submit','Abschicken','class="btn btn-default"');
    echo '&nbsp;&nbsp;&nbsp;';
    echo anchor('Cashpoint','Abbrechen', 'class="btn btn-default"');
    echo form_close();
    ?>
</div>