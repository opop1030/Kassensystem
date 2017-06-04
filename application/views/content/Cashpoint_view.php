<div>
    <h1>Kassenbedienung</h1>
    <hr/>
    <p>hier entsteht die Kassenbedienung!</p>
</div>
<div>
    <?php
        foreach($special as $item)
        {
            echo $item["name"]." I ".$item["kosten"]."<br/>";
        }
    ?>
</div>