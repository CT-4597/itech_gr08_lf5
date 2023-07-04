-- Zutaten mit Filter:

SELECT ZUTAT.ZUTATENNR, ZUTAT.BEZEICHNUNG, ZUTAT.NETTOPREIS, ERNAEHRUNGSKATEGORIE.KATEGORIEBEZEICHNUNG AS 'Kategorie'  FROM ZUTAT
LEFT JOIN ZUTATALLERGEN ON ZUTATALLERGEN.ZUTATENNR = ZUTAT.ZUTATENNR
LEFT JOIN ALLERGEN ON ALLERGEN.ALLERGENNR = ZUTATALLERGEN.ALLERGENNR
LEFT JOIN ZUTATKATEGORIE ON ZUTATKATEGORIE.ZUTATENNR = ZUTAT.ZUTATENNR
LEFT JOIN ERNAEHRUNGSKATEGORIE ON ERNAEHRUNGSKATEGORIE.KATEGORIENR = ZUTATKATEGORIE.KATEGORIENR

WHERE (((ZUTATALLERGEN.ALLERGENNR != 0) OR
(ZUTATALLERGEN.ALLERGENNR != 0) OR
(ZUTATALLERGEN.ALLERGENNR != 0) OR
(ZUTATALLERGEN.ALLERGENNR != 0) OR
(ZUTATALLERGEN.ALLERGENNR != 0)
OR ZUTATALLERGEN.ALLERGENNR IS NULL)) AND ERNAEHRUNGSKATEGORIE.KATEGORIENR = 1
-- ORDER BY ZUTAT.KALORIEN


-- Anzeigen Sammlungen mit Typ
SELECT SAMMLUNG.SAMMLUNGSBEZEICHNUNG, SAMMLUNGSTYP.TYPBEZEICHNUNG FROM SAMMLUNG
LEFT JOIN SAMMLUNGSTYP ON SAMMLUNGSTYP.SAMMLUNGSTYPNR = SAMMLUNG.SAMMLUNGSTYPNR
WHERE SAMMLUNGSTYP.SAMMLUNGSTYPNR = 2


-- Abfrage Der Zutateninformationen
SELECT ZUTAT.BEZEICHNUNG, ZUTAT.KALORIEN, ZUTAT.KOHLENHYDRATE, ZUTAT.PROTEIN FROM ZUTAT
WHERE ZUTAT.ZUTATENNR = 1001


-- Abfrage Der Zutatenkategorie
SELECT ZUTAT.BEZEICHNUNG, ERNAEHRUNGSKATEGORIE.KATEGORIEBEZEICHNUNG FROM ZUTAT
LEFT JOIN ZUTATKATEGORIE ON ZUTATKATEGORIE.ZUTATENNR = ZUTAT.ZUTATENNR
LEFT JOIN ERNAEHRUNGSKATEGORIE ON ERNAEHRUNGSKATEGORIE.KATEGORIENR = ZUTATKATEGORIE.KATEGORIENR
WHERE ZUTAT.ZUTATENNR = 1001

-- Zutaten einer Box
SELECT SAMMLUNGZUTAT.ZUTATENNR, ZUTAT.BEZEICHNUNG, SAMMLUNGZUTAT.ZUTATENMENGE FROM SAMMLUNGZUTAT
LEFT JOIN ZUTAT ON ZUTAT.ZUTATENNR = SAMMLUNGZUTAT.ZUTATENNR
WHERE SAMMLUNGZUTAT.SAMMLUNGSNR = 1