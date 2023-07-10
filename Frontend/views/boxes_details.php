<h1 class="details_headline"><?php echo $vars['box']['SAMMLUNGSBEZEICHNUNG']; ?></h1>
<div class="details_container">

    <div class="details_boxcontent">
        <table>
            <tr>
                <th>Zutat</th>
                <th>Menge</th>
            </tr>
            <?php foreach($vars['box_content'] as $content) { ?>
                <tr>
                    <td><?php echo $content['BEZEICHNUNG']; ?></td>
                    <td><?php echo $content['ZUTATENMENGE']; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>

    <img src="<?php get_image("s", $vars['box']['SAMMLUNGSNR']); ?>" alt="Bild der Zutat" class="details_pic">

    <div class="details_info">
        <ul>
            <li>Verfügbar: <?php echo $vars['box']['maxAmount']; ?></li>
            <li>Einzelpreis der Zutaten: <?php echo $vars['box']['Gesamtpreis']; ?> €</li>
            <li>Preis in netto: <?php echo $vars['box']['RabattPreis']; ?> €</li>
        </ul>
    </div>

    <div class="details_order">
        <form action="/box/<?php echo $vars['box']['SAMMLUNGSNR']; ?>" method="post">
    	    <input type="hidden" name="SAMMLUNGSNR" value="<?php echo $vars['box']['SAMMLUNGSNR']; ?>">
            <?php if($auth->LoggedIn()) { ?>
                <label for="amount">Menge</label>
                <input type="number" id="amount" name="amount" min="1" max="<?php echo $vars['box']['maxAmount']; ?>" value="1">
                <input type="submit" name="AddToCartIngredient" value="Zum Warenkorb hinzufügen">
            <?php } else { ?>
                Loggen sie sich ein um zu Bestellen.
                <input type="button" name="login" value="zum Login" onclick="window.location.href = '/login';">
            <?php }?>
        </form>
    </div>

</div>
