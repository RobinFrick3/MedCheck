SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `verwaltung` (
  `verwaltung_id` int(3) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `vorname` varchar(20) NOT NULL,
  `nachname` varchar(20) NOT NULL,
  `passwort` varchar(50) NOT NULL,
  `name` text NOT NULL,
  `adresse` text NOT NULL,
  `link` text NOT NULL,
  PRIMARY KEY (`verwaltung_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `verwaltung` (`verwaltung_id`, `email`, `vorname`, `nachname`, `passwort`, `name`, `adresse`, `link`) VALUES
(1, 'meier@apotheke.de', 'Anna', 'Meier', 'pass123', 'Europa Apotheke', 'Musterstraße 10, 12345 Musterstadt', 'https://www.google.de/maps/place/Europa+Apotheke/@49.4847855,8.4718282,14.73z/data=!4m10!1m2!2m1!1seuropa+apotheke!3m6!1s0x4797cc21ae01086d:0x84c0a5d9107c9360!8m2!3d49.4850761!4d8.472283!15sCg9ldXJvcGEgYXBvdGhla2VaESIPZXVyb3BhIGFwb3RoZWtlkgEIcGhhcm1hY3ngAQA!16s%2Fg%2F1tgw8w2x?entry=ttu'),
(2, 'schulz@apotheke.de', 'Bernd', 'Schulz', 'pass456', 'Einhorn Apotheke', 'Beispielweg 5, 67890 Beispielstadt', 'https://www.google.de/maps/place/Einhorn+Apotheke/@49.4862466,8.4647726,15.48z/data=!4m6!3m5!1s0x4797cc247bc4ec9f:0xedeae8337fe62600!8m2!3d49.4893398!4d8.4679021!16s%2Fg%2F1tzztg83?entry=ttu');

CREATE TABLE `benutzer` (
  `benutzer_id` int(3) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `passwort` varchar(50) NOT NULL,
  `nachname` varchar(20) NOT NULL,
  `vorname` varchar(20) NOT NULL,
  `adresse` text NOT NULL,
  PRIMARY KEY (`benutzer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `benutzer` (`benutzer_id`, `email`, `passwort`, `nachname`, `vorname`, `adresse`) VALUES
(1, 'kunde1@apotheke.de', 'kunde123', 'Müller', 'Gabi', 'Musterstraße 1, 12345 Musterstadt'),
(2, 'kunde2@apotheke.de', 'kunde456', 'Fischer', 'Tom', 'Beispielweg 2, 67890 Beispielstadt');

CREATE TABLE `produkt` (
  `produkt_id` int(5) NOT NULL AUTO_INCREMENT,
  `titel` varchar(250) NOT NULL,
  `marke` varchar(250) NOT NULL,
  `kategorie` varchar(15) NOT NULL,
  `details` text NOT NULL,
  `schlagworte` varchar(250) NOT NULL,
  `bild` varchar(250) NOT NULL,
  `menge` int(3) NOT NULL,
  `preis` int(10) NOT NULL,
  `verwaltung_id` int(3) NOT NULL,
  PRIMARY KEY (`produkt_id`),
  CONSTRAINT `fk_verwaltung_produkt` FOREIGN KEY (`verwaltung_id`) REFERENCES `verwaltung` (`verwaltung_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `bestellungen` (
  `bestell_id` int(11) NOT NULL AUTO_INCREMENT,
  `produkt_id` int(11) NOT NULL,
  `benutzer_id` int(11) NOT NULL,
  `menge` int(3) NOT NULL,
  `bestelldatum` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`bestell_id`),
  KEY `produkt_id` (`produkt_id`),
  KEY `benutzer_id` (`benutzer_id`),
  CONSTRAINT `fk_benutzer_bestellungen` FOREIGN KEY (`benutzer_id`) REFERENCES `benutzer` (`benutzer_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_produkt_bestellungen` FOREIGN KEY (`produkt_id`) REFERENCES `produkt` (`produkt_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `produkt` (`produkt_id`, `titel`, `marke`, `kategorie`, `details`, `schlagworte`, `bild`, `menge`, `preis`, `verwaltung_id`) VALUES
(2, 'Insulin Lispro 100 ml Injektionslösung, 3 Patronen', 'Humalog', 'Medikament', 'Schnell wirkendes Insulin zur Kontrolle von Blutzuckerspitzen bei Diabetes mellitus. Injizierbar mit Insulinpen.', 'Insulin, Diabetes, Schnellwirkend', 'humalog-patronen.png', 3, 25, 1),
(3, 'Glucophage 500 mg Filmtabletten', 'Merck', 'Medikament', 'Metformin-Tabletten zur Verbesserung der Blutzuckerkontrolle bei Typ-2-Diabetes. Hilft bei der Senkung des Blutzuckerspiegels.', 'Metformin, Typ-2-Diabetes, Blutzuckersenkung', 'glucophage-tabletten.png', 120, 14, 1),
(4, 'Freestyle Libre Sensor', 'Abbott', 'Medizinprodukt', 'Sensor zur kontinuierlichen Glukosemessung, der bis zu 14 Tage getragen werden kann. Erlaubt das Scannen der Glukosewerte ohne Blutentnahme.', 'CGM, Diabetes, Glukosemessung, Freestyle Libre', 'freestyle-libre-sensor.png', 17, 60, 1),
(5, 'Lantus Solostar 100 ml, 5x3 ml Pens', 'Sanofi', 'Medikament', 'Lang wirkendes Basalinsulin zur einmal täglichen Anwendung zur Kontrolle des Blutzuckers bei Erwachsenen und Kindern mit Diabetes mellitus.', 'Insulin, Diabetes, Langwirkend, Lantus', 'lantus-pens.png', 19, 31, 1),
(6, 'Diabetes-Tagebuch', 'NoBrand', 'Zubehör', 'Ein Tagebuch zur täglichen Aufzeichnung von Blutzuckerwerten, Medikamentendosis und Mahlzeiten. Hilfreich zur Kontrolle und Anpassung der Diabetesbehandlung.', 'Tagebuch, Blutzuckerkontrolle, Diabetes Management', 'diabetes-tagebuch.png', 39, 6, 1),
(7, 'Bayer Contour Next Blutzuckermessgerät', 'Bayer', 'Gerät', 'Präzises und einfach zu bedienendes Blutzuckermessgerät. Keine Kodierung erforderlich, schnelle Ergebnisse in wenigen Sekunden.', 'Blutzuckermessgerät, Diabetes, Bayer', 'bayer-contour-next.png', 11, 25, 1),
(8, 'Ramipril 5 mg Tabletten', 'Ratiopharm', 'Medikament', 'Ramipril wird zur Behandlung von Bluthochdruck und Herzinsuffizienz eingesetzt. Es ist ein ACE-Hemmer, der hilft, das Risiko von Herzkomplikationen zu verringern.', 'Bluthochdruck, Herzinsuffizienz, ACE-Hemmer', 'ramipril-tabletten.png', 102, 23, 1),
(9, 'Atorvastatin 20 mg Filmtabletten', 'Lipitor', 'Medikament', 'Atorvastatin hilft, den Cholesterinspiegel zu senken und wird zur Vorbeugung von Herzkrankheiten eingesetzt. Geeignet für Patienten mit hohem Risiko für Herzinfarkt.', 'Cholesterin, Herzkrankheiten, Statin', 'atorvastatin-tabletten.png', 96, 45, 1),
(10, 'Bisoprolol 2,5 mg Filmtabletten', 'Concor', 'Medikament', 'Bisoprolol wird zur Behandlung von Bluthochdruck und Herzinsuffizienz verwendet. Es gehört zur Gruppe der Beta-Blocker, die helfen, den Herzschlag zu regulieren.', 'Bluthochdruck, Beta-Blocker, Herzinsuffizienz', 'bisoprolol-tabletten.png', 55, 15, 1),
(11, 'Clopidogrel 75 mg Tabletten', 'Plavix', 'Medikament', 'Clopidogrel wird zur Vorbeugung von Blutgerinnseln bei Patienten mit Herz-Kreislauf-Erkrankungen wie Schlaganfall oder Herzinfarkt eingesetzt.', 'Blutgerinnung, Herzinfarkt, Schlaganfall', 'clopidogrel-tabletten.png', 37, 28, 2),
(12, 'Digitalis Herztabletten', 'Digoxin', 'Medikament', 'Digoxin wird zur Behandlung von Herzrhythmusstörungen und zur Stärkung der Herzleistung verwendet. Es wirkt direkt auf das Herzgewebe.', 'Herzrhythmusstörungen, Herzleistung, Digitalis', 'digoxin-tabletten.png', 93, 20, 1),
(13, 'Nitroglycerin-Spray 0,4 mg/Dosis, 200 Dosen', 'Nitrolingual', 'Medikament', 'Nitroglycerin-Spray wird zur schnellen Linderung von Brustschmerzen verwendet, die durch Angina pectoris verursacht werden. Es erweitert die Blutgefäße, um den Blutfluss zu verbessern.', 'Angina Pectoris, Brustschmerzen, Nitroglycerin', 'nitroglycerin-spray.png', 1, 37, 1),
(14, 'Ibuprofen 400 mg Filmtabletten', 'Nurofen', 'Medikament', 'Ibuprofen ist ein nichtsteroidales Antirheumatikum, das zur Linderung von leichten bis mäßigen Rückenschmerzen eingesetzt wird. Es wirkt entzündungshemmend und schmerzlindernd.', 'Schmerzmittel, Entzündungshemmend, Rückenschmerzen', 'ibuprofen-tabletten.png', 52, 8, 1),
(15, 'Diclofenac Gel 1%, 100g', 'Voltaren', 'Medikament', 'Diclofenac Gel wird topisch angewendet, um Schmerzen und Entzündungen bei muskuloskelettalen Beschwerden wie Rückenschmerzen zu behandeln.', 'Diclofenac, Schmerzgel, Rückenschmerzen', 'diclofenac-gel.png', 22, 12, 1),
(16, 'Wärmepflaster für Rückenschmerzen, 4 Stück', 'ThermaCare', 'Medizinprodukt', 'Wärmepflaster, die tiefe, therapeutische Wärme liefern, um die Muskeln zu entspannen und Rückenschmerzen zu lindern. Jedes Pflaster bietet bis zu 8 Stunden Schmerzlinderung.', 'Wärmetherapie, Rückenschmerzen, Entspannung', 'waermepflaster.png', 114, 11, 1),
(17, 'TENS-Gerät zur Schmerzlinderung', 'Omron', 'Gerät', 'Transkutane Elektrische Nervenstimulation (TENS) hilft bei der Linderung von Rückenschmerzen durch das Senden kleiner elektrischer Impulse durch die Haut.', 'TENS, Elektrische Stimulation, Schmerzlinderung', 'tens-geraet.png', 8, 55, 1),
(18, 'Orthopädisches Rückenstützkissen', 'MediSupport', 'Zubehör', 'Dieses Kissen bietet ergonomische Unterstützung und kann bei der Linderung chronischer Rückenschmerzen durch Förderung einer korrekten Sitzhaltung helfen.', 'Ergonomisch, Rückenstütze, Schmerzlinderung', 'rueckenstuetzkissen.png', 31, 30, 1),
(19, 'Insulin Lispro 100 ml Injektionslösung, 3 Patronen', 'Humalog', 'Medikament', 'Schnell wirkendes Insulin zur Kontrolle von Blutzuckerspitzen bei Diabetes mellitus. Injizierbar mit Insulinpen.', 'Insulin, Diabetes, Schnellwirkend', 'humalog-patronen.png', 7, 25, 2),
(20, 'Bisoprolol 2,5 mg Filmtabletten', 'Concor', 'Medikament', 'Bisoprolol wird zur Behandlung von Bluthochdruck und Herzinsuffizienz verwendet. Es gehört zur Gruppe der Beta-Blocker, die helfen, den Herzschlag zu regulieren.', 'Bluthochdruck, Beta-Blocker, Herzinsuffizienz', 'bisoprolol-tabletten.png', 150, 15, 2),
(21, 'Diclofenac Gel 1%, 100g', 'Voltaren', 'Medikament', 'Diclofenac Gel wird topisch angewendet, um Schmerzen und Entzündungen bei muskuloskelettalen Beschwerden wie Rückenschmerzen zu behandeln.', 'Diclofenac, Schmerzgel, Rückenschmerzen', 'diclofenac-gel.png', 27, 12, 2),
(22, 'Ramipril 5 mg Tabletten', 'Ratiopharm', 'Medikament', 'Ramipril wird zur Behandlung von Bluthochdruck und Herzinsuffizienz eingesetzt. Es ist ein ACE-Hemmer, der hilft, das Risiko von Herzkomplikationen zu verringern.', 'Bluthochdruck, Herzinsuffizienz, ACE-Hemmer', 'ramipril-tabletten.png', 62, 23, 2),
(23, 'Ibuprofen 400 mg Filmtabletten', 'Nurofen', 'Medikament', 'Ibuprofen ist ein nichtsteroidales Antirheumatikum, das zur Linderung von leichten bis mäßigen Rückenschmerzen eingesetzt wird. Es wirkt entzündungshemmend und schmerzlindernd.', 'Schmerzmittel, Entzündungshemmend, Rückenschmerzen', 'ibuprofen-tabletten.png', 133, 8, 2);

COMMIT;
