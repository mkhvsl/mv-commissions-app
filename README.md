# Commission Calculation App

- Idea is to calculate commissions for already made transactions;
- Transactions are provided each in it's own line in the input file, in JSON;
- BIN number represents first digits of credit card number. They can be used to resolve country where the card was issued;
- We apply different commission rates for EU-issued and non-EU-issued cards;
- We calculate all commissions in EUR currency.

## Requirements

- PHP 7.4 or higher
- Composer

## Setup

```bash
composer install
```

## Usage

Run the CLI application with an input file:

```bash
php app.php input.txt
```

## Testing

Unit tests are written using PHPUnit.

Run tests:

```bash
./vendor/bin/phpunit tests
```