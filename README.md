# Symfony Multi-Schema Projekt

Dieses Projekt ist eine Symfony-basierte Anwendung, die als Basis für die Implementierung und das Experimentieren mit einer Multi-Schema-Architektur für Datenbanken dient. Es ist so gestaltet, dass es das **Multi-Tenancy Bundle** von [RamyHakam](https://github.com/RamyHakam/multi_tenancy_bundle) unterstützt, wodurch Entwickler die Möglichkeit haben, die Funktionen des Bundles in einer realen Symfony-Anwendung auszuprobieren und zu evaluieren.

Das Bundle selbst bietet leistungsstarke Tools, die es ermöglichen, Multi-Tenant-Datenbanken effizient zu verwalten, ist jedoch noch nicht vollständig in dieses Projekt integriert. Stattdessen bietet dieses Projekt eine solide Grundlage, um die Funktionen des Bundles zu testen und zu verstehen.

---

## Wichtige Eigenschaften:
- **Vorbereitung für Multi-Tenancy-Architekturen**: Das Projekt ist bereit, mit dem Multi-Tenancy Bundle erweitert zu werden.
- **Erkundung und Experimentieren**: Entwickler können das Bundle in dieser Umgebung ausprobieren, um dynamisches Umschalten zwischen Datenbanken, Migrationen und andere Features zu testen.
- **Flexible Struktur**: Bietet eine Basis, die leicht an spezifische Anforderungen angepasst werden kann.

---

## Das Multi-Tenancy Bundle ausprobieren:
Das Multi-Tenancy Bundle bietet die folgenden Funktionen, die in diesem Projekt getestet werden können:
- Dynamisches Umschalten zwischen Tenant-Datenbanken.
- Verwendung eines einzigen Entity Managers für mehrere Datenbanken.
- Unterstützung separater Entitäts-Mappings für Haupt- und Tenant-Datenbanken.
- Benutzerdefinierte Doctrine-Befehle für Datenbankmanagement und Migrationen.
- Automatisches Erstellen und Vorbereiten von Tenant-Datenbanken.

---

## Ziel:
Dieses Projekt ist ideal für Entwickler, die eine Multi-Tenant-Lösung erkunden oder das Multi-Tenancy Bundle in einer Symfony-Anwendung testen möchten. Es bietet eine Einstiegsmöglichkeit, um die Architektur und Funktionen des Bundles besser zu verstehen.
