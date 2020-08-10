<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    public $incrementing = true;  // khóa chính tăng dần
    protected $keyType = 'int'; // kiểu dữ liệu khóa chính
    public $timestamps = true; // dùng timestamps không
    //protected $dateFormat = "U"; // định dạng date 
    // const UPDATED_AT = 'updated_date'; // đổi tên col update
    // const CREATED_AT = 'create_date'; // đổi tên col create
    // protected $connection = "connection-name" // kết nối database khác

    protected $attributes = [
    					'status' => 1
    				]; // Giá trị mặc định của thuộc tính
    protected $guarded = [];  

}
