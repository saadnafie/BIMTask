<?php
  
namespace App\Enums;
 
enum TransactionStatusEnum:string {
    case Paid = 'Paid';
    case Outstanding = 'Outstanding';
    case Overdue = 'Overdue';
}

