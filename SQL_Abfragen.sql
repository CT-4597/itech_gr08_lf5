-- Zutaten mit Filter:

SELECT ZUTAT.ZUTATENNR, ZUTAT.BEZEICHNUNG, ZUTAT.NETTOPREIS, ERNAEHRUNGSKATEGORIE.KATEGORIEBEZEICHNUNG AS 'Kategorie'  FROM ZUTAT
LEFT JOIN ZUTATALLERGEN ON ZUTATALLERGEN.ZUTATENNR = ZUTAT.ZUTATENNR
LEFT JOIN ALLERGEN ON ALLERGEN.ALLERGENNR = ZUTATALLERGEN.ALLERGENNR
LEFT JOIN ZUTATKATEGORIE ON ZUTATKATEGORIE.ZUTATENNR = ZUTAT.ZUTATENNR
LEFT JOIN ERNAEHRUNGSKATEGORIE ON ERNAEHRUNGSKATEGORIE.KATEGORIENR = ZUTATKATEGORIE.KATEGORIENR;

WHERE (((ZUTATALLERGEN.ALLERGENNR != 0) AND
(ZUTATALLERGEN.ALLERGENNR != 0) AND
(ZUTATALLERGEN.ALLERGENNR != 0) AND
(ZUTATALLERGEN.ALLERGENNR != 0) AND
(ZUTATALLERGEN.ALLERGENNR != 0)
OR ZUTATALLERGEN.ALLERGENNR IS NULL)) AND ERNAEHRUNGSKATEGORIE.KATEGORIENR = 1
-- ORDER BY ZUTAT.KALORIEN
;

-- Anzeigen Sammlungen mit Typ
SELECT SAMMLUNG.SAMMLUNGSBEZEICHNUNG, SAMMLUNGSTYP.TYPBEZEICHNUNG FROM SAMMLUNG
LEFT JOIN SAMMLUNGSTYP ON SAMMLUNGSTYP.SAMMLUNGSTYPNR = SAMMLUNG.SAMMLUNGSTYPNR
WHERE SAMMLUNGSTYP.SAMMLUNGSTYPNR = 2;


-- Abfrage Der Zutateninformationen
SELECT ZUTAT.BEZEICHNUNG, ZUTAT.KALORIEN, ZUTAT.KOHLENHYDRATE, ZUTAT.PROTEIN FROM ZUTAT
WHERE ZUTAT.ZUTATENNR = 1001;


-- Abfrage Der Zutatenkategorie
SELECT ZUTAT.BEZEICHNUNG, ERNAEHRUNGSKATEGORIE.KATEGORIEBEZEICHNUNG FROM ZUTAT
LEFT JOIN ZUTATKATEGORIE ON ZUTATKATEGORIE.ZUTATENNR = ZUTAT.ZUTATENNR
LEFT JOIN ERNAEHRUNGSKATEGORIE ON ERNAEHRUNGSKATEGORIE.KATEGORIENR = ZUTATKATEGORIE.KATEGORIENR
WHERE ZUTAT.ZUTATENNR = 1001;

-- Zutaten einer Box
SELECT SAMMLUNGZUTAT.ZUTATENNR, ZUTAT.BEZEICHNUNG, SAMMLUNGZUTAT.ZUTATENMENGE FROM SAMMLUNGZUTAT
LEFT JOIN ZUTAT ON ZUTAT.ZUTATENNR = SAMMLUNGZUTAT.ZUTATENNR
WHERE SAMMLUNGZUTAT.SAMMLUNGSNR = 1;



-- Insert Registrierung
INSERT INTO KUNDE (EMAIL, PASSWORT, VORNAME, NACHNAME, GEBURTSDATUM, STRASSE, HAUSNR, PLZ, ORT, TELEFON)
VALUES (a , b , c , d, e , f , g , h, i, j) ;

-- Ausgabe Preis Box Achtung Netto
SELECT SAMMLUNG.SAMMLUNGSBEZEICHNUNG, sum(ZUTAT.NETTOPREIS * SAMMLUNGZUTAT.ZUTATENMENGE) AS 'Gesamtpreis',
sum(ZUTAT.NETTOPREIS * SAMMLUNGZUTAT.ZUTATENMENGE)-round(sum(ZUTAT.NETTOPREIS * SAMMLUNGZUTAT.ZUTATENMENGE)*(SAMMLUNG.RABATT/100),2) AS 'RabattPreis'
FROM SAMMLUNG
LEFT JOIN SAMMLUNGZUTAT ON SAMMLUNGZUTAT.SAMMLUNGSNR = SAMMLUNG.SAMMLUNGSNR 
LEFT JOIN ZUTAT ON ZUTAT.ZUTATENNR = SAMMLUNGZUTAT.ZUTATENNR 
WHERE SAMMLUNG.SAMMLUNGSNR = 2


-- Ausgabe in Brutto

-- Sammlungen mit Filter
SELECT * FROM SAMMLUNG
	LEFT JOIN (SELECT SAMMLUNGZUTAT.SAMMLUNGSNR AS SAMMLUNGMITALLERGENNR FROM SAMMLUNGZUTAT JOIN ZUTATALLERGEN
	ON SAMMLUNGZUTAT.ZUTATENNR = ZUTATALLERGEN.ZUTATENNR WHERE FALSE OR ZUTATALLERGEN.ALLERGENNR = 2) sub
        ON SAMMLUNG.SAMMLUNGSNR = sub.SAMMLUNGMITALLERGENNR
	WHERE SAMMLUNGMITALLERGENNR IS NULL

--in subselect müssen die Allergene im WHERE mit OR angehängt werden, vielleicht noch DISTINCT
