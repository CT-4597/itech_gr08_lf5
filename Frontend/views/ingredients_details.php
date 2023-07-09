<h1 class="details_headline"><?php echo $vars['ingredient']['BEZEICHNUNG']; ?></h1>
<div class="details_container">
    <div class="details_nutrition">
        <h2>Nährwerte</h2>
        <ul>
            <li>Kalorien: <?php echo $vars['ingredient']['KALORIEN']; ?></li>
            <li>Kohlenhydrate: <?php echo $vars['ingredient']['KOHLENHYDRATE']; ?></li>
            <li>Protein: <?php echo $vars['ingredient']['PROTEIN']; ?></li>
        </ul>
    </div>

    <img src="<?php get_image("z", $vars['ingredient']['ZUTATENNR']); ?>" alt="Bild der Zutat" class="details_pic">

    <div class="details_info">
        <ul>
            <li>Verfügbar: <?php echo $vars['ingredient']['BESTAND']; ?> <?php echo $vars['ingredient']['EINHEIT']; ?></li>
            <li>Preis in netto: <?php echo $vars['ingredient']['NETTOPREIS']; ?> €</li>
        </ul>
    </div>

    <div class="details_order">
        <form action="/zutat/<?php echo $vars['ingredient']['ZUTATENNR']; ?>" method="post">
    	    <input type="hidden" name="ZUTATENNR" value="<?php echo $vars['ingredient']['ZUTATENNR']; ?>">
            <label for="amount">Menge</label>
            <input type="number" id="amount" name="amount" min="1" max="<?php echo $vars['ingredient']['BESTAND']; ?>" value="1">
            <input type="submit" name="AddToCart" value="Zum Warenkorb hinzufügen">
        </form>
    </div>

</div>
