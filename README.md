# Doctrine ORM Projekt

Dieses Repository enthält ein Projekt, das Doctrine ORM für die Datenbankinteraktion verwendet.

## Über Doctrine ORM

Doctrine ist ein Object-Relational-Mapper (ORM) für PHP, der eine leistungsstarke Abstraktion für die Arbeit mit Datenbanken bietet. Mit Doctrine kannst du:

- Datenbanktabellen als PHP-Klassen (Entities) modellieren
- Komplexe Datenbankabfragen mit DQL (Doctrine Query Language) erstellen
- Datenbank-Schemata automatisch verwalten und aktualisieren
- Datenbank-Migrationen verwalten

## Installation

```bash
# Klone das Repository
git clone https://github.com/username/doctrine-projekt.git

# Wechsle in das Verzeichnis
cd doctrine-projekt

# Installiere die Abhängigkeiten
composer install

# Konfiguriere die Datenbankverbindung in .env
# DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"

# Erstelle die Datenbank
php bin/console doctrine:database:create
```

## Wichtige Doctrine-Befehle

### Datenbank-Verwaltung

#### Schema erstellen/aktualisieren
```bash
# Schema erstellen
php bin/console doctrine:schema:create
# Erstellt alle Tabellen basierend auf deinen Entity-Klassen

# Schema aktualisieren (sicher - zeigt nur SQL-Befehle an)
php bin/console doctrine:schema:update --dump-sql
# Zeigt die SQL-Befehle an, die ausgeführt werden würden, um das Schema zu aktualisieren

# Schema aktualisieren (durchführen)
php bin/console doctrine:schema:update --force
# Führt die Aktualisierung des Schemas durch

# Schema validieren
php bin/console doctrine:schema:validate
# Überprüft, ob das aktuelle Datenbankschema mit den Entity-Definitionen übereinstimmt
```

#### Datenbank-Management
```bash
# Datenbank erstellen
php bin/console doctrine:database:create
# Erstellt die Datenbank basierend auf den Einstellungen in .env

# Datenbank löschen
php bin/console doctrine:database:drop --force
# Löscht die Datenbank (Vorsicht: alle Daten gehen verloren!)
```

### Migrations

Migrations ermöglichen es dir, Datenbankänderungen zu versionieren und nachzuverfolgen.

```bash
# Neue Migration basierend auf Unterschieden generieren
php bin/console doctrine:migrations:diff
# Erstellt eine Migration-Datei, die die Unterschiede zwischen Entity-Definitionen und aktuellem Datenbankschema enthält

# Leere Migration-Klasse erstellen
php bin/console doctrine:migrations:generate
# Erstellt eine leere Migration-Datei, die du manuell bearbeiten kannst

# Alle ausstehenden Migrations ausführen
php bin/console doctrine:migrations:migrate
# Führt alle noch nicht ausgeführten Migrations aus

# Bestimmte Migration ausführen
php bin/console doctrine:migrations:execute YYYYMMDDHHMMSS --up
# Führt eine spezifische Migration aus

# Migration rückgängig machen
php bin/console doctrine:migrations:execute YYYYMMDDHHMMSS --down
# Macht eine spezifische Migration rückgängig

# Status der Migrations anzeigen
php bin/console doctrine:migrations:status
# Zeigt den aktuellen Status der Migrations an
```

### Entitäten verwalten

```bash
# Entität aus Datenbank generieren
php bin/console doctrine:mapping:import "AppBundle\Entity" annotation --path=src/Entity
# Generiert Entity-Klassen basierend auf einer existierenden Datenbank

# Getter und Setter für Entitäten generieren
php bin/console doctrine:generate:entities AppBundle
# Generiert Getter- und Setter-Methoden für Entity-Klassen

# Neue Entität erstellen (interaktiv)
php bin/console make:entity
# Startet einen interaktiven Assistenten zum Erstellen einer neuen Entity

# Repository für eine Entität erstellen
php bin/console make:repository EntityName
# Erstellt eine Repository-Klasse für eine Entity
```

### Cache-Management

```bash
# Metadata-Cache leeren
php bin/console doctrine:cache:clear-metadata
# Löscht den Metadata-Cache

# Query-Cache leeren
php bin/console doctrine:cache:clear-query
# Löscht den Query-Cache

# Result-Cache leeren
php bin/console doctrine:cache:clear-result
# Löscht den Result-Cache
```

### Fixtures

Fixtures ermöglichen es dir, Testdaten in deine Datenbank zu laden.

```bash
# Fixtures laden (mit Datenbank-Reset)
php bin/console doctrine:fixtures:load
# Lädt alle Fixtures und setzt die Datenbank zurück

# Fixtures ohne Datenbank-Reset laden
php bin/console doctrine:fixtures:load --append
# Fügt Fixture-Daten hinzu, ohne bestehende Daten zu löschen

# Spezifische Fixture-Gruppe laden
php bin/console doctrine:fixtures:load --group=GroupName
# Lädt nur Fixtures einer bestimmten Gruppe
```

### DQL und SQL-Abfragen

```bash
# DQL ausführen
php bin/console doctrine:query:dql "SELECT e FROM AppBundle:Entity e"
# Führt eine DQL-Abfrage aus und gibt das Ergebnis aus

# SQL ausführen
php bin/console doctrine:query:sql "SELECT * FROM entity"
# Führt eine SQL-Abfrage aus und gibt das Ergebnis aus
```

### Debugging und Informationen

```bash
# Mapping-Informationen anzeigen
php bin/console doctrine:mapping:info
# Zeigt Informationen zu allen gemappten Entities an

# Entity-Manager-Konfiguration anzeigen
php bin/console debug:doctrine
# Zeigt Informationen zur Doctrine-Konfiguration an

# Details zu einer Entity anzeigen
php bin/console doctrine:mapping:describe EntityName
# Zeigt detaillierte Informationen zu einer spezifischen Entity an

# Cache leeren (wichtig nach Änderungen an Entitäten)
php bin/console cache:clear
# Leert den gesamten Symfony-Cache

# Debug Entity
php bin/console debug:entity EntityName
# Zeigt Debug-Informationen zu einer Entity an
```

## Beispiele

### Entity erstellen

```php
<?php
// src/Entity/Product.php
namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $price = null;

    // Getter und Setter
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }
}
```

### Fixture erstellen

```php
<?php
// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Erstelle 20 Produkte mit zufälligen Preisen
        for ($i = 0; $i < 20; $i++) {
            $product = new Product();
            $product->setName('Product ' . $i);
            $product->setPrice(mt_rand(10, 100));
            $manager->persist($product);
        }

        $manager->flush();
    }
}
```

### Repository verwenden

```php
<?php
// src/Repository/ProductRepository.php
namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    // Benutzerdefinierte Abfragemethode
    public function findExpensiveProducts(float $price): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.price > :price')
            ->setParameter('price', $price)
            ->orderBy('p.price', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
```

### Verwendung in einem Controller

```php
<?php
// src/Controller/ProductController.php
namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/products', name: 'product_list')]
    public function index(ProductRepository $productRepository): Response
    {
        // Alle Produkte abrufen
        $products = $productRepository->findAll();
        
        // Nur teure Produkte abrufen
        $expensiveProducts = $productRepository->findExpensiveProducts(50);
        
        return $this->render('product/index.html.twig', [
            'products' => $products,
            'expensiveProducts' => $expensiveProducts,
        ]);
    }
    
    #[Route('/product/create', name: 'product_create')]
    public function create(EntityManagerInterface $entityManager): Response
    {
        // Neues Produkt erstellen
        $product = new Product();
        $product->setName('Neues Produkt');
        $product->setPrice(99.99);
        
        // Speichern in der Datenbank
        $entityManager->persist($product);
        $entityManager->flush();
        
        return $this->redirectToRoute('product_list');
    }
}
```

## Weitere Ressourcen

- [Offizielle Doctrine-Dokumentation](https://www.doctrine-project.org/projects/doctrine-orm/en/2.13/index.html)
- [Symfony Doctrine Integration](https://symfony.com/doc/current/doctrine.html)
- [DQL Dokumentation](https://www.doctrine-project.org/projects/doctrine-orm/en/2.13/reference/dql-doctrine-query-language.html)
