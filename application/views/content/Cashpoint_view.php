<div class="nopadding content">
    <?php
    echo form_open('Cashpoint/addItem');
    echo '<br/>';
    echo form_label('Artikelnummer', 'scan');
    echo '<br/>';
    echo form_input('scan', set_value('scan', ''), 'id=scan autofocus');
    echo '<br/>';
    echo '<br/>';
    $this->table->set_heading(array('Name', 'Price', 'Amount'));
    $price = 0;
    $itemCount = count($special["itemlist"]);
    if($itemCount !== 0) {
        foreach ($special as $item) {
            $this->table->add_row($item["name"], $item["cost"], $item["amount"], anchor('Cashpoint/removeItem/' . $item["id"], 'L&ouml;schen'));
            $price += $item["cost"] * $item["amount"];
        }
    }
    echo $this->table->generate();
    if($itemCount === 0){
        echo '<p>Keine Eintr&auml;ge</p>';
    }
    echo '<br/>';
    echo '<br/>';
    echo '<p>Gesammtbetrag: '.$price.'&euro;</p>';
    echo '<br/>';
    echo form_label('Vorbestellung?', 'isPreorder');
    echo form_dropdown('costumer', $special["costumers"]);
    echo form_checkbox('isPreorder', 'preorder', false);
    echo '<br/>';
    echo '<br/>';
    echo anchor('Cashpoint/sendShoppingCart', 'Eintrag abschicken');
    echo '<br/>';
    echo form_close();
    ?>
</div>