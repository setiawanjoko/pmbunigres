<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PaymentReport implements FromCollection, WithHeadings, WithMapping
{
    protected $payments;

    /**
     * @param Collection $payments
     */
    public function __construct(Collection $payments)
    {
        $this->payments = $payments;
    }

    /**
    * @return Collection
     */
    public function collection(): Collection
    {
        return $this->payments;
    }

    /**
     * @return string[]
     */
    public function headings(): array
    {
        return [
            'Program Studi',
            'Gelombang',
            'Nama Pendaftar',
            'NO BRIVA',
            'Nominal',
            'Tanggal Bayar'
        ];
    }

    /**
     * @param $row
     * @return array
     */
    public function map($row): array{
        return [
            $row->pendaftar->prodi->nama,
            $row->pendaftar->gelombang->gelombang,
            $row->pendaftar->nama,
            env('BRIVA_NO') . ' ' . $row->custCode,
            $row->amount,
            Carbon::parse($row->updated_at)->format('d-m-Y')
        ];
    }
}
