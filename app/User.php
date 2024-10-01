<?php declare(strict_types=1);

namespace App;

class User{
    private $userApi;

    // Constructor menerima UserApi sebagai dependensi
    public function __construct($userApi)
    {
        $this->userApi = $userApi;
    }

    // Unit under test: fungsi yang mengubah data pengguna menjadi JSON
    public function getUserDataAsJson()
    {
        $userData = $this->userApi->getData(); // Memanggil API eksternal 
        return json_encode($userData);
    }

    // Unit under test 2
    public function getFilteredUserDataAsJson()
    {
        $userData = $this->userApi->getData();

        $filteredData = [
            'nama' => $userData['nama'],
            'nim' => $userData['nim'],
        ];

        return json_encode($filteredData);
    }
}