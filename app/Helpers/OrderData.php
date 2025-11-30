<?php

namespace App\Helpers;

class OrderData {

    public static function all() {
        return [
            ['id' => 1, 'buyer' => 'Bapak Suwandi', 'qty' => 132, 'total' => 800328, 'status' => 'Dikirim'],
            ['id' => 2, 'buyer' => 'Ibu Rina', 'qty' => 88, 'total' => 561148, 'status' => 'Dikirim'],
            ['id' => 3, 'buyer' => 'Bapak Joko', 'qty' => 106, 'total' => 1482828, 'status' => 'Diproses'],
            ['id' => 4, 'buyer' => 'Ibu Sari', 'qty' => 24, 'total' => 1129010, 'status' => 'Diproses'],
            ['id' => 5, 'buyer' => 'Bapak Ahmad', 'qty' => 130, 'total' => 864383, 'status' => 'Menunggu'],
        ];
    }

    public static function find($id) {
        foreach (self::all() as $order) {
            if ($order['id'] == $id) {
                return $order;
            }
        }
        return null;
    }
}
