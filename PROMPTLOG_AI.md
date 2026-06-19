# PROMPTLOG AI - Tugas 2 IAE

**Nama:** [Nama Kamu]
**NIM:** 102022400365
**Service:** Checkout & Order Service (Service B - E-Commerce)
**Mata Kuliah:** BBK2HAB3 - Integrasi Aplikasi Enterprise

---

## Sesi 1 - 11 Juni 2026

**Platform:** Claude (Anthropic - claude.ai)

---

### Prompt 1

**Input:**
> saya ada tugas mata kuliah IAE servis bagian saya pilih no 4

**Output AI:**
AI mengidentifikasi bahwa nomor 4 adalah Fintech/Banking, lalu meminta konfirmasi service yang diambil.

---

### Prompt 2

**Input:**
> kelompok aku 1

**Output AI:**
AI mengidentifikasi kelompok 1 = E-Commerce (4p). Karena service 1 (Produk & Stok) dan service 3 (Keranjang & Promo) sudah diambil teman, maka bagian yang tersisa adalah Service B - Checkout & Order.

---

### Prompt 3

**Input:**
> ya [konfirmasi untuk generate project]
> NIM: 102022400365

**Output AI:**
AI men-generate project Laravel lengkap dengan struktur awal meliputi Model, Controller, Middleware, Migration, Seeder, GraphQL schema, Dockerfile.

---

### Prompt 4

**Input:**
> buat gini seperti teman ku [upload zip project teman dengan struktur Laravel 12]

**Output AI:**
AI membaca dan menganalisis struktur project teman (102022400271 - Produk & Stok Service), kemudian membuat ulang project dengan:
- Pola yang sama persis (PHP Attributes untuk Swagger, bukan docblock)
- Menggunakan `OpenApi\Attributes` seperti teman
- `OpenApiSpec.php` terpisah untuk info API
- Struktur folder identik
- Semua file konfigurasi (l5-swagger, lighthouse, dll) di-copy dan disesuaikan
- NIM dan service diganti sesuai bagian sendiri (Checkout & Order)

---

## Ringkasan

| Aspek | Detail |
|-------|--------|
| Tool AI | Claude (Anthropic) |
| Total Prompt | 4 prompt |
| Dibantu AI | Seluruh struktur kode, controller, middleware, migration, GraphQL schema |
| Dikerjakan manual | Push ke GitHub, deploy, testing via Postman |
