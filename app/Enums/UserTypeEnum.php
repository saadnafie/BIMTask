<?php
  
namespace App\Enums;
 
enum UserTypeEnum:int {
    case Admin = 1;
    case Customer = 2;
}