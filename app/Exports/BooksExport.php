<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class BooksExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Book::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Judul',
            'Kategori ID',
            'Penulis',
            'Penerbit',
            'Tahun',
            'Deskripsi',
            'Jumlah',
            'File Path',
            'Cover Image',
            'Dibuat Pada',
            'Diperbarui Pada'
        ];
    }
}
