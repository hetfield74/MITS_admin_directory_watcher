# MITS_admin_directory_watcher für modified eCommerce Shopsoftware
(c) Copyright 2025 by Hetfield – MerZ IT-SerVice

- Author: Hetfield – https://www.merz-it-service.de  
- Version: ab modified eCommerce Shopsoftware Version 2.x  

<hr />

## Beschreibung

Die Erweiterung **MITS_admin_directory_watcher** dient zur Überwachung des Admin-Verzeichnisses
in der modified eCommerce Shopsoftware.

In modified kann aus Sicherheitsgründen der Standard-Admin-Ordner *admin/* umbenannt werden.
Bei Updates oder der Installation von Modulen kommt es jedoch häufig vor, dass Dateien weiterhin
in den Standard-Ordner *admin/* kopiert werden, obwohl dieser im Shop nicht mehr verwendet wird.

Dieses Modul prüft beim Aufruf des Admin-Bereichs automatisch, ob ein zusätzlicher Ordner
*admin/* existiert, obwohl ein anderer Admin-Ordner konfiguriert ist, und weist den Administrator
darauf hin.

Optional bietet das Modul eine Funktion an, die im Standard-Ordner *admin/* abgelegten Dateien
in den tatsächlich verwendeten Admin-Ordner zu verschieben.

<hr />

## Wichtiger Hinweis zur Funktion „Dateien verschieben“

Die Funktion **„Dateien verschieben“** verschiebt alle im Ordner *admin/* vorhandenen Dateien und
Unterordner automatisiert in den konfigurierten Admin-Ordner.

Dabei wird versucht, bestehende Dateien zu überschreiben, falls diese bereits vorhanden sind.
Je nach Serverkonfiguration, Dateirechten, individuellen Anpassungen oder installierten Modulen
kann dies unerwartete Auswirkungen haben.

**Die Nutzung dieser Funktion erfolgt ausdrücklich auf eigene Gefahr!**

Grundsätzlich wird empfohlen, die im Ordner *admin/* befindlichen Dateien **manuell zu prüfen**
und bei Bedarf gezielt in den korrekten Admin-Ordner zu übernehmen.
Die manuelle Überprüfung ist immer der automatisierten Verschiebung vorzuziehen.

<hr />

Die Installation erfolgt ohne das Überschreiben von Dateien.

<hr />

## Lizenzinformationen

Diese Erweiterung ist unter der GNU/GPL lizensiert.  
Eine Kopie der Lizenz liegt diesem Modul bei oder kann unter der URL  
http://www.gnu.org/licenses/gpl-2.0.txt heruntergeladen werden.

Die Copyrighthinweise müssen erhalten bleiben bzw. mit eingebaut werden.
Zuwiderhandlungen verstoßen gegen das Urheberrecht und die GPL und werden
zivil- und strafrechtlich verfolgt!

<hr />

## Anleitung für das Modul MITS_admin_directory_watcher

### Installation

**Systemvoraussetzung:**  
Funktionsfähige modified eCommerce Shopsoftware ab Version 2.x

Vor der Installation des Moduls sichern Sie bitte vollständig Ihre aktuelle
Shopinstallation (Dateien und Datenbank)!  
Für eventuelle Schäden übernehmen wir keine Haftung.

Die Installation und Nutzung des Moduls **MITS_admin_directory_watcher**
erfolgt auf eigene Gefahr!

Die Installation des Moduls ist einfach und erfolgt in wenigen Schritten:

1. Führen Sie zuerst eine vollständige Sicherung des Shops durch.
   Sichern Sie dabei sowohl die Datenbank als auch alle Dateien Ihrer Shopinstallation.

2. Falls der Admin-Ordner des Shops umbenannt wurde, benennen Sie vor dem Hochladen
   auch den Ordner *admin* im Verzeichnis *shoproot* des Moduls entsprechend um.

3. Kopieren Sie anschließend alle Dateien aus dem Verzeichnis *shoproot* des Modulpakets
   in das Hauptverzeichnis Ihrer bestehenden modified eCommerce Shopsoftware Installation.
   Es werden dabei keine Dateien überschrieben.

4. Fertig.

<hr />

Wir hoffen, das Modul **MITS_admin_directory_watcher** für die modified eCommerce Shopsoftware
gefällt Ihnen!

Benötigen Sie Unterstützung bei der individuellen Anpassung des Moduls oder haben Sie
Probleme beim Einbau, können Sie gerne unseren kostenpflichtigen Support in Anspruch nehmen.

Kontaktieren Sie uns einfach unter  
https://www.merz-it-service.de/Kontakt.html

<hr />

<img src="https://www.merz-it-service.de/images/logo.png" alt="MerZ IT-SerVice" title="MerZ IT-SerVice" />

**MerZ IT-SerVice**  
Nicole Grewe  
Am Berndebach 35a  
D-57439 Attendorn  

Telefon: 0 27 22 – 63 13 63  
Telefax: 0 27 22 – 63 14 00  

E-Mail: Info(at)MerZ-IT-SerVice.de  
Internet: https://www.MerZ-IT-SerVice
