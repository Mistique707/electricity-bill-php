# Electricity Bill Calculator (PHP)

A simple, responsive single-page web app that calculates an electricity bill from the number of units consumed, using slab-based rates.

## Slab Rates

| Units      | Rate per unit |
|------------|---------------|
| First 50   | Rs. 3.50      |
| Next 100   | Rs. 4.00      |
| Next 100   | Rs. 5.20      |
| Above 250  | Rs. 6.50      |

## Run

Requires PHP. From the project folder:

```bash
php -S localhost:8000
```

Then open <http://localhost:8000/electricity_bill.php> in your browser.
