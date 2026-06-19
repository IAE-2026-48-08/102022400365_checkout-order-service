<?php

namespace App;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: "1.0.0",
    title: "Checkout & Order Service API",
    description: "API untuk manajemen checkout dan order - Service B E-Commerce IAE Tugas 2"
)]

#[OA\Server(
    url: "http://127.0.0.1:8000",
    description: "Local Server"
)]

#[OA\SecurityScheme(
    securityScheme: "X-IAE-KEY",
    type: "apiKey",
    name: "X-IAE-KEY",
    in: "header",
    description: "Masukkan NIM kamu sebagai API Key: 102022400365"
)]

class OpenApiSpec
{
}
