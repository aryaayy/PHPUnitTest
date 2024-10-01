<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase, App\Api, App\User;

class JsonTest extends TestCase
{
    public function testJson(){
        // Buat stub untuk API eksternal
        $stubApi = $this->createStub(Api::class);
        $stubApi->method('getData')
                ->willReturn([
                    'nama' => 'Raya Cahya',
                    'nim' => '2201805',
                    'kelas' => 'C1'
                ]);

        // Unit under test, yaitu fungsi yang akan diuji
        $user = new User($stubApi);

        // JSON yang dihasilkan oleh unit under test
        $jsonData = $user->getUserDataAsJson();
        // echo $jsonData;

        $this->assertJson($jsonData, "Data bukan JSON");
    }

    public function testJsonFileEqualsJsonFile(){
        $actualPath=  __DIR__ . '/actualUserData.json';
        $expectedPath=  __DIR__ . '/expectedUserData.json';

        $this->assertJsonFileEqualsJsonFile($expectedPath, $actualPath, 'File JSON tidak sesuai');
    }

    public function testJsonStringEqualsJsonFile()
    {
        // Buat stub untuk API eksternal
        $stubApi = $this->createStub(Api::class);
        $stubApi->method('getData')
                ->willReturn([
                    'nama' => 'Raya Cahya',
                    'nim' => '2201805',
                    'kelas' => 'C1'
                ]);

        // Unit under test, yaitu fungsi yang akan diuji
        $user = new User($stubApi);

        // JSON yang dihasilkan oleh unit under test
        $actualJson = $user->getFilteredUserDataAsJson();
        
        // File JSON yang berisi data yang diharapkan
        $expectedPath = __DIR__ . '/expectedUserData.json';

        // Membandingkan string JSON dengan konten file JSON
        $this->assertJsonStringEqualsJsonFile($expectedPath, $actualJson, 'JSON string tidak sesuai dengan file JSON');
    }

    public function testJsonStringEqualsJsonString()
    {
        // Buat stub untuk API eksternal
        $stubApi = $this->createStub(Api::class);
        $stubApi->method('getData')
                ->willReturn([
                    'nama' => 'Raya Cahya',
                    'nim' => '2201805',
                    'kelas' => 'C1'
                ]);

        // Unit under test, yaitu fungsi yang akan diuji
        $user = new User($stubApi);

        // JSON yang dihasilkan oleh unit under test
        $actualJson = $user->getUserDataAsJson();

        // JSON yang diharapkan
        $expectedJson = json_encode([
            'nama' => 'Raya Cahya',
            'nim' => '2201805', // Kondisi sesuai
            // 'nim' => '2201888', // Kondisi tidak sesuai
            'kelas' => 'C1'
        ]);

        // Memastikan bahwa JSON yang dihasilkan sesuai dengan ekspektasi
        $this->assertJsonStringEqualsJsonString($expectedJson, $actualJson, 'JSON tidak sesuai!');
    }
}