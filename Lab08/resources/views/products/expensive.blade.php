@extends('layouts.app')

@section('content')
<div style="padding:20px;">
    <h2 style="margin-bottom:20px;">Hệ thống Quản lý Sản phẩm - Giá > 100000</h2>

    <table style="width:100%; border-collapse: collapse; font-family: Arial, sans-serif;">
        <thead>
            <tr style="background-color:#4CAF50; color:white; text-align:left;">
                <th style="padding:12px">Tên</th>
                <th style="padding:12px">Giá</th>
                <th style="padding:12px">Danh mục</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $p)
            <tr style="border-bottom:1px solid #ddd;">
                <td style="padding:12px">{{ $p->name }}</td>
                <td style="padding:12px">{{ number_format($p->price) }} đ</td>
                <td style="padding:12px">{{ $p->category->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
