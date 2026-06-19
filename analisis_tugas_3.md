# Analisis Tugas 3

## Transaksi Kritis
POST /api/v1/orders

Transaksi checkout dipilih sebagai transaksi kritis karena menghasilkan order baru, mengubah status transaksi, dan menghasilkan data keuangan.

## Integrasi SSO
User melakukan autentikasi melalui SSO Dosen menggunakan JWT dan role lokal.

## Integrasi SOAP Audit
Data order dikirim ke sistem audit legacy menggunakan SOAP/XML. Receipt Number disimpan pada database.

## Integrasi RabbitMQ
Setelah order berhasil dibuat, sistem mengirim event order.created ke RabbitMQ.
