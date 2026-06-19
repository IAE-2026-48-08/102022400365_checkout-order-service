# 🛒 Checkout & Order Service

**Service B - E-Commerce System**
**Mata Kuliah:** BBK2HAB3 - Integrasi Aplikasi Enterprise
**NIM:** 102022400365
**Kelompok:** 1 (E-Commerce)

---

## Deskripsi

Service ini mengelola proses **Checkout & Order** dalam ekosistem E-Commerce kelompok 1. Mengikuti **Standard Integration Contract (IAE-T2)**.

---

## Cara Menjalankan

```bash
# 1. Install dependencies
composer install

# 2. Setup environment
cp .env.example .env
php artisan key:generate

# 3. Setup database
touch database/database.sqlite
php artisan migrate --seed

# 4. Generate Swagger docs
php artisan l5-swagger:generate

# 5. Jalankan server
php artisan serve
```

---

## Autentikasi

Semua endpoint memerlukan header:
```
X-IAE-KEY: 102022400365
```

---

## REST API Endpoints

Base URL: `http://localhost:8000/api/v1`

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| GET | `/orders` | Ambil semua order |
| GET | `/orders/{id}` | Ambil detail order |
| POST | `/orders` | Buat order baru (Checkout) |
| PATCH | `/orders/{id}/status` | Update status order |

### Contoh POST /api/v1/orders
```json
{
  "customer_name": "Budi Santoso",
  "customer_email": "budi@email.com",
  "items": [
    {
      "product_id": 1,
      "name": "Laptop Gaming",
      "price": 15000000,
      "qty": 1
    }
  ],
  "discount": 500000,
  "notes": "Tolong dibungkus rapi"
}
```

---

## API Documentation

Swagger UI: `http://localhost:8000/api/documentation`

---

## GraphQL

Playground: `http://localhost:8000/graphql-playground`

```graphql
# Ambil semua order
query {
  orders {
    id
    order_code
    customer_name
    total
    status
  }
}

# Filter by status
query {
  orders(status: "pending") {
    id
    order_code
    customer_name
    total
  }
}

# Ambil by ID
query {
  order(id: 1) {
    id
    order_code
    customer_name
    items
    subtotal
    discount
    total
    status
    notes
  }
}
```

---

## Tech Stack

- **Framework:** Laravel 12
- **Database:** SQLite
- **Dokumentasi:** L5-Swagger (OpenAPI 3.0)
- **GraphQL:** Lighthouse
