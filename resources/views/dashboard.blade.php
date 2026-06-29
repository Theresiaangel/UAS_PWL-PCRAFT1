@extends('layouts.admin')

@section('content')
    <div style="margin-bottom: 30px;">
        <h2 style="font-family: 'Times New Roman', serif; font-weight: bold;">Top 5 pembeli</h2>
    </div>

    <table border="1" style="width: 100%; border-collapse: collapse; background-color: white;">
        <thead>
            <tr style="background-color: white;">
                <th width="20%">Nama produk</th>
                <th width="25%" style="font-weight: normal; color: #333;">Nama Pembeli</th>
                <th width="30%">Total Nominal Pembelian</th>
                <th width="25%">Jumlah Pembelian</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < 5; $i++)
                <tr>
                    <td style="height: 50px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endfor
        </tbody>
    </table>
@endsection