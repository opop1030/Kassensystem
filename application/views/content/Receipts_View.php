<div>
    <h1>Kassenzettel</h1>
    <hr/>
    <?php
        echo $special["items"];
        echo '<br/>';
        echo $special["price"]." zu Zahlen";
        echo '<br/>';
        echo $special["money"]." gegeben";
        echo '<br/>';
        echo '<br/>';
        echo $special["price"] - $special["money"];
        echo "Rückgeld";

        echo "Einkauf abgeschlossen!<br/>".anchor("Cashpoint/clearCashpoint");
    ?>
</div>