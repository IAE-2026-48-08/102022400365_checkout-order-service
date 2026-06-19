<?php
namespace App\Services;
class SoapAuditService {
    public function sendAudit(array $data){
        return ['receipt_number'=>'RCPT-'.time()];
    }
}
