<?php
# Needs to be the same as class [NAME]
new ControllerCartOrder($controllers, $db, ["Content" => "cart_order"]);
# Be sure to give it a unique name.
class ControllerCartOrder extends BaseController {
    public function RunEarly() {
        global $vars;
        global $auth;

        $query = "SELECT FORMAT(SUM(Gesamtpreis), 2) AS Gesamtsumme
                    FROM (
                      SELECT FORMAT(SUM((ZUTAT.NETTOPREIS * BESTELLUNGZUTAT.MENGE)), 2) as Gesamtpreis
                      FROM BESTELLUNG
                      JOIN KUNDE ON BESTELLUNG.KUNDENNR = KUNDE.KUNDENNR
                      JOIN BESTELLUNGZUTAT ON BESTELLUNG.BESTELLNR = BESTELLUNGZUTAT.BESTELLNR
                      JOIN ZUTAT ON BESTELLUNGZUTAT.ZUTATENNR = ZUTAT.ZUTATENNR
                      WHERE BESTELLUNG.STATUS = :orderstate AND KUNDE.KUNDENNR = :userid

                      UNION ALL

                      SELECT FORMAT((SUM(ZUTAT.NETTOPREIS * SAMMLUNGZUTAT.ZUTATENMENGE) / 100 * (100 - SAMMLUNG.RABATT)) * BESTELLUNGSAMMLUNG.MENGE, 2) AS Gesamtpreis
                      FROM BESTELLUNG
                      JOIN KUNDE ON BESTELLUNG.KUNDENNR = KUNDE.KUNDENNR
                      LEFT JOIN BESTELLUNGSAMMLUNG ON BESTELLUNG.BESTELLNR = BESTELLUNGSAMMLUNG.BESTELLNR
                      LEFT JOIN SAMMLUNG ON BESTELLUNGSAMMLUNG.SAMMLUNGSNR = SAMMLUNG.SAMMLUNGSNR
                      LEFT JOIN SAMMLUNGZUTAT ON SAMMLUNG.SAMMLUNGSNR = SAMMLUNGZUTAT.SAMMLUNGSNR
                      LEFT JOIN ZUTAT ON SAMMLUNGZUTAT.ZUTATENNR = ZUTAT.ZUTATENNR
                      WHERE BESTELLUNG.STATUS = :orderstate AND KUNDE.KUNDENNR = :userid
                      GROUP BY SAMMLUNG.SAMMLUNGSNR, SAMMLUNG.SAMMLUNGSBEZEICHNUNG
                    ) AS Subquery";

        $params = [":orderstate" => 'Warenkorb',
                    ":userid" => $auth->UserID()];
        $total_price = $this->db->executeSingleRowQuery($query, $params)['Gesamtsumme'];

        $query = "UPDATE BESTELLUNG SET BESTELLDATUM=:orderdate, RECHNUNGSBETRAG=:total_price, STATUS=:neworderstate WHERE STATUS=:orderstate AND KUNDENNR=:userid";
        $params = [":orderdate" => date('Y-m-d'),
                    ":total_price" => $total_price,
                    ":neworderstate" => 'Bestellt',
                    ":orderstate" => 'Warenkorb',
                    ":userid" => $auth->UserID()];
        $this->db->execute($query, $params);
    }
}


?>
