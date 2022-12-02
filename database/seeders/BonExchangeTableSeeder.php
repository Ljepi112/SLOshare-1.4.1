<?php

namespace Database\Seeders;

use App\Helpers\ByteUnits;
use App\Models\BonExchange;
use Illuminate\Database\Seeder;

class BonExchangeTableSeeder extends Seeder
{
    private $bonExchanges;

    public function __construct(private ByteUnits $byteUnits)
    {
        $this->bonExchanges = $this->getBonExchanges();
    }

    /**
     * Auto generated seed file.
     */
    public function run(): void
    {
        foreach ($this->bonExchanges as $be) {
            BonExchange::updateOrCreate($be);
        }
    }

    private function getBonExchanges(): array
    {
        return [
            [
                'id'                 => 1,
                'description'        => '2 GiB Upload',
                'value'              => $this->byteUnits->bytesFromUnit('2GiB'),
                'cost'               => 500,
                'upload'             => 1,
                'download'           => 0,
                'personal_freeleech' => 0,
                'invite'             => 0,
            ],
            [
                'id'                 => 2,
                'description'        => '10 GiB Upload',
                'value'              => $this->byteUnits->bytesFromUnit('10GiB'),
                'cost'               => 1000,
                'upload'             => 1,
                'download'           => 0,
                'personal_freeleech' => 0,
                'invite'             => 0,
            ],
            [
                'id'                 => 3,
                'description'        => '25 GiB Upload',
                'value'              => $this->byteUnits->bytesFromUnit('25GiB'),
                'cost'               => 2000,
                'upload'             => 1,
                'download'           => 0,
                'personal_freeleech' => 0,
                'invite'             => 0,
            ],
            [
                'id'                 => 4,
                'description'        => '100 GiB Upload',
                'value'              => $this->byteUnits->bytesFromUnit('100GiB'),
                'cost'               => 5000,
                'upload'             => 1,
                'download'           => 0,
                'personal_freeleech' => 0,
                'invite'             => 0,
            ],
            [
                'id'                 => 9,
                'description'        => '1 Povabilo',
                'value'              => 1,
                'cost'               => 2500,
                'upload'             => 0,
                'download'           => 0,
                'personal_freeleech' => 0,
                'invite'             => 1,
            ],
            [
                'id'                 => 10,
                'description'        => 'Oseben 24H Freeleech',
                'value'              => 1,
                'cost'               => 7500,
                'upload'             => 0,
                'download'           => 0,
                'personal_freeleech' => 1,
                'invite'             => 0,
            ],
        ];
    }
}
