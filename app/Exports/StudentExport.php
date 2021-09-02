<?php

namespace App\Exports;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentExport implements FromArray,WithHeadings
{
    /**
    * @return array
     */
    public function array() : array
    {
        $raw = User::with(['prodi'])->where('permission_id', 2)->get()
            ->filter(function($item) {
                return $item->progres === 'daftar ulang';
            });
        return $this->processRawCollection($raw);
    }

    public function headings():array{
        return [
            'NP',
            'NIM',
            'PASSWORD',
            'NO. KTP',
            'NAMA LENGKAP',
            'KODE PRODI',
            'JENJANG ID',
            'KELAS',
            'DOSEN WALI ID',
            'TEMPAT LAHIR',
            'TANGGAL LAHIR',
            'JENIS KELAMIN',
            'AGAMA',
            'ALAMAT',
            'NO. TELEPON',
            'TAHUN MASUK',
            'TAHUN SEMESTER AWAL MASUK',
            'ASAL SMA',
            'NAMA AYAH',
            'PEKERJAAN AYAH',
            'NAMA IBU',
            'PEKERJAAN IBU',
            'NAMA WALI',
            'ALAMAT WALI',
            'NO. TELEPON WALI',
            'STATUS',
            'NAMA FILE FOTO',
            'LEVEL',
            'AKTIF'
        ];
    }

    private function processRawCollection(Collection $raw)
    {
        $data = [];

        foreach($raw as $row){
            array_push($data, [
                'NP' => $row->biodata->no_pendaftaran,
                'NIM' => $row->biodata->nim,
                'PASSWORD' => $row->biodata->nim,
                'NO. KTP' => $row->biodata->nik,
                'NAMA LENGKAP' => $row->nama,
                'KODE PRODI' => $row->prodi->kode_prodi_siakad,
                'JENJANG ID' => $row->prodi->jenjang->id,
                'KELAS' => Carbon::now()->year . substr($row->kelas->kelas, -1),
                'DOSEN WALI ID' => '-',
                'TEMPAT LAHIR' => $row->biodata->tempat_lahir,
                'TANGGAL LAHIR' => $row->biodata->tanggal_lahir,
                'JENIS KELAMIN' => $row->biodata->jenis_kelamin,
                'AGAMA' => $row->biodata->agama,
                'ALAMAT' => $row->biodata->alamat,
                'NO. TELEPON' => $row->biodata->no_telepon,
                'TAHUN MASUK' => Carbon::now()->year,
                'TAHUN SEMESTER AWAL MASUK' => Carbon::now()->year,
                'ASAL SMA' => $row->biodata->asal_sekolah,
                'NAMA AYAH' => (!is_null($row->ayah())) ? $row->ayah()->nama : '-',
                'PEKERJAAN AYAH' => (!is_null($row->ayah())) ? $row->ayah()->pekerjaan : '-',
                'NAMA IBU' => (!is_null($row->ibu())) ? $row->ibu()->nama : '-',
                'PEKERJAAN IBU' => (!is_null($row->ibu())) ? $row->ibu()->pekerjaan : '-',
                'NAMA WALI' => (!is_null($row->wali())) ? $row->wali()->nama : '-',
                'ALAMAT WALI' => (!is_null($row->wali())) ? $row->wali()->alamat : '-',
                'NO. TELEPON WALI' => (!is_null($row->wali())) ? $row->wali()->telepon : '-',
                'STATUS' => 1,
                'NAMA FILE FOTO' => 'nopic.png',
                'LEVEL' => 6,
                'AKTIF' => 1
            ]);
        }

        return $data;
    }
}
