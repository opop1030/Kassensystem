<div class="nopadding content">
    <?php
    echo form_open('Cashpoint/reserveOrder');
    echo '<br/>';
    echo form_label('Kunde :','costumer');
    echo '<br/>';
    $namelist = array();
    $idlist = array();
    foreach($special["costumers"] as $costumer){
        array_push($namelist,$costumer["name"]);
        array_push($idlist,$costumer["id"]);
    }
    echo form_dropdown('costumer', $special["costumers"]["name"], $special["costumers"]["id"]);
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
    echo $this->table->generate();
    echo '<br/>';
    echo '<br/>';
    echo '<p>Gesammtbetrag: '.$price.'&euro;</p>';
    echo '<br/>';
    echo form_submit('submit','Abschicken');
    echo '&nbsp;&nbsp;&nbsp;';
    echo anchor('Cashpoint','Abbrechen');
    echo form_close();
    ?>
</div>