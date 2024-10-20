@extends('admin.layouts.master')

@section('title')
    Dashboard
@endsection

@section('content')
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            background-color: white;
            padding: 20px;
            margin-top: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #343a40;
        }
        .section-header {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #495057;
        }
        .order-status, .revenue-statistics, .product-statistics, .advanced-statistics {
            border: 1px solid #dee2e6;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .order-status .btn {
            width: 150px;
            margin: 5px;
        }
        .order-status .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }
        .order-status .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .order-status .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .chart {
            height: 200px;
            background-color: #e9ecef;
            margin-bottom: 20px;
            border-radius: 5px;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            padding: 10px;
        }
        .chart-bar {
            width: 20px;
            background-color: #6c757d;
        }
        .product-list .product-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .product-list .product-item img {
            width: 50px;
            height: 50px;
            background-color: #e9ecef;
            margin-right: 10px;
            border-radius: 5px;
        }
        .product-list .product-item .product-info {
            flex-grow: 1;
        }
        .product-list .product-item .product-price {
            font-weight: bold;
            color: #343a40;
        }
        .date-filter {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-bottom: 10px;
        }
        .date-filter input {
            width: 150px;
            text-align: center;
            margin-left: 10px;
            border-radius: 5px;
            border: 1px solid #ced4da;
            padding: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            Thống kê Bán Hàng
        </div>
        <div class="order-status">
            <div class="section-header">
                Thống Kê Đơn Hàng
            </div>
            <div class="d-flex flex-wrap">
                <button class="btn btn-outline-dark">
                    Chờ Xác Nhận
                    <br/>
                    10
                </button>
                <button class="btn btn-outline-dark">
                    Đã Xác Nhận
                    <br/>
                    10
                </button>
                <button class="btn btn-outline-dark">
                    Đang Giao
                    <br/>
                    10
                </button>
                <button class="btn btn-success">
                    Giao Thành Công
                    <br/>
                    10
                </button>
                <button class="btn btn-danger">
                    Giao Thất Bại
                    <br/>
                    10
                </button>
                <button class="btn btn-secondary">
                    Hủy
                    <br/>
                    10
                </button>
            </div>
        </div>
        <div class="revenue-statistics">
            <div class="section-header">
                Thống Kê Doanh Thu
            </div>
            <div class="date-filter">
                <label for="month">Theo Tháng</label>
                <input id="month" type="month" value="2023-10"/>
            </div>
            <div class="section-header">
                Doanh Thu: 10,000,000 VNĐ (Tăng 10%)
            </div>
            <div>
                Số đơn: 200 đơn
            </div>
            <div class="chart">
                <div class="chart-bar" style="height: 50%;"></div>
                <div class="chart-bar" style="height: 70%;"></div>
                <div class="chart-bar" style="height: 60%;"></div>
                <div class="chart-bar" style="height: 80%;"></div>
                <div class="chart-bar" style="height: 90%;"></div>
                <div class="chart-bar" style="height: 40%;"></div>
                <div class="chart-bar" style="height: 30%;"></div>
                <div class="chart-bar" style="height: 50%;"></div>
                <div class="chart-bar" style="height: 70%;"></div>
                <div class="chart-bar" style="height: 60%;"></div>
                <div class="chart-bar" style="height: 80%;"></div>
                <div class="chart-bar" style="height: 90%;"></div>
                <div class="chart-bar" style="height: 40%;"></div>
                <div class="chart-bar" style="height: 30%;"></div>
                <div class="chart-bar" style="height: 50%;"></div>
                <div class="chart-bar" style="height: 70%;"></div>
                <div class="chart-bar" style="height: 60%;"></div>
                <div class="chart-bar" style="height: 80%;"></div>
                <div class="chart-bar" style="height: 90%;"></div>
                <div class="chart-bar" style="height: 40%;"></div>
                <div class="chart-bar" style="height: 30%;"></div>
                <div class="chart-bar" style="height: 50%;"></div>
                <div class="chart-bar" style="height: 70%;"></div>
                <div class="chart-bar" style="height: 60%;"></div>
                <div class="chart-bar" style="height: 80%;"></div>
                <div class="chart-bar" style="height: 90%;"></div>
                <div class="chart-bar" style="height: 40%;"></div>
                <div class="chart-bar" style="height: 30%;"></div>
                <div class="chart-bar" style="height: 50%;"></div>
                <div class="chart-bar" style="height: 70%;"></div>
                <div class="chart-bar" style="height: 60%;"></div>
            </div>
        </div>
        <div class="product-statistics">
            <div class="section-header">
                Thống Kê Sản Phẩm
            </div>
            <div class="product-list">
                <div class="section-header">
                    Top 5 Sản Phẩm Doanh Thu Cao Nhất
                </div>
                <div class="product-item">
                    <img src="https://placehold.co/50x50" alt="Placeholder image for product"/>
                    <div class="product-info">
                        Tên sản phẩm
                        <br/>
                        Mã sản phẩm
                    </div>
                    <div class="product-price">
                        500,000 VNĐ
                    </div>
                </div>
                <div class="product-item">
                    <img src="https://placehold.co/50x50" alt="Placeholder image for product"/>
                    <div class="product-info">
                        Tên sản phẩm
                        <br/>
                        Mã sản phẩm
                    </div>
                    <div class="product-price">
                        500,000 VNĐ
                    </div>
                </div>
                <div class="product-item">
                    <img src="https://placehold.co/50x50" alt="Placeholder image for product"/>
                    <div class="product-info">
                        Tên sản phẩm
                        <br/>
                        Mã sản phẩm
                    </div>
                    <div class="product-price">
                        500,000 VNĐ
                    </div>
                </div>
                <div class="product-item">
                    <img src="https://placehold.co/50x50" alt="Placeholder image for product"/>
                    <div class="product-info">
                        Tên sản phẩm
                        <br/>
                        Mã sản phẩm
                    </div>
                    <div class="product-price">
                        500,000 VNĐ
                    </div>
                </div>
                <div class="product-item">
                    <img src="https://placehold.co/50x50" alt="Placeholder image for product"/>
                    <div class="product-info">
                        Tên sản phẩm
                        <br/>
                        Mã sản phẩm
                    </div>
                    <div class="product-price">
                        500,000 VNĐ
                    </div>
                </div>
            </div>
            <div class="product-list">
                <div class="section-header">
                    Top 5 Sản Phẩm Bán Chạy Nhất
                </div>
                <div class="product-item">
                    <img src="https://placehold.co/50x50" alt="Placeholder image for product"/>
                    <div class="product-info">
                        Tên sản phẩm
                        <br/>
                        Mã sản phẩm
                    </div>
                    <div class="product-price">
                        500,000 VNĐ
                    </div>
                </div>
                <div class="product-item">
                    <img src="https://placehold.co/50x50" alt="Placeholder image for product"/>
                    <div class="product-info">
                        Tên sản phẩm
                        <br/>
                        Mã sản phẩm
                    </div>
                    <div class="product-price">
                        500,000 VNĐ
                    </div>
                </div>
                <div class="product-item">
                    <img src="https://placehold.co/50x50" alt="Placeholder image for product"/>
                    <div class="product-info">
                        Tên sản phẩm
                        <br/>
                        Mã sản phẩm
                    </div>
                    <div class="product-price">
                        500,000 VNĐ
                    </div>
                </div>
                <div class="product-item">
                    <img src="https://placehold.co/50x50" alt="Placeholder image for product"/>
                    <div class="product-info">
                        Tên sản phẩm
                        <br/>
                        Mã sản phẩm
                    </div>
                    <div class="product-price">
                        500,000 VNĐ
                    </div>
                </div>
                <div class="product-item">
                    <img src="https://placehold.co/50x50" alt="Placeholder image for product"/>
                    <div class="product-info">
                        Tên sản phẩm
                        <br/>
                        Mã sản phẩm
                    </div>
                    <div class="product-price">
                        500,000 VNĐ
                    </div>
                </div>
            </div>
            <div class="product-list">
                <div class="section-header">
                    Top 5 Sản Phẩm Lợi Nhuận Cao Nhất
                </div>
                <div class="product-item">
                    <img src="https://placehold.co/50x50" alt="Placeholder image for product"/>
                    <div class="product-info">
                        Tên sản phẩm
                        <br/>
                        Mã sản phẩm
                    </div>
                    <div class="product-price">
                        500,000 VNĐ
                    </div>
                </div>
                <div class="product-item">
                    <img src="https://placehold.co/50x50" alt="Placeholder image for product"/>
                    <div class="product-info">
                        Tên sản phẩm
                        <br/>
                        Mã sản phẩm
                    </div>
                    <div class="product-price">
                        500,000 VNĐ
                    </div>
                </div>
                <div class="product-item">
                    <img src="https://placehold.co/50x50" alt="Placeholder image for product"/>
                    <div class="product-info">
                        Tên sản phẩm
                        <br/>
                        Mã sản phẩm
                    </div>
                    <div class="product-price">
                        500,000 VNĐ
                    </div>
                </div>
                <div class="product-item">
                    <img src="https://placehold.co/50x50" alt="Placeholder image for product"/>
                    <div class="product-info">
                        Tên sản phẩm
                        <br/>
                        Mã sản phẩm
                    </div>
                    <div class="product-price">
                        500,000 VNĐ
                    </div>
                </div>
                <div class="product-item">
                    <img src="https://placehold.co/50x50" alt="Placeholder image for product"/>
                    <div class="product-info">
                        Tên sản phẩm
                        <br/>
                        Mã sản phẩm
                    </div>
                    <div class="product-price">
                        500,000 VNĐ
                    </div>
                </div>
            </div>
        </div>
        <div class="advanced-statistics">
            <div class="section-header">
                Thống Kê Nâng Cao
            </div>
            <div class="date-filter">
                <label for="year">Thống Kê Năm</label>
                <input id="year" type="number" value="2023"/>
            </div>
            <div class="chart">
                <div class="chart-bar" style="height: 50%;"></div>
                <div class="chart-bar" style="height: 70%;"></div>
                <div class="chart-bar" style="height: 60%;"></div>
                <div class="chart-bar" style="height: 80%;"></div>
                <div class="chart-bar" style="height: 90%;"></div>
                <div class="chart-bar" style="height: 40%;"></div>
                <div class="chart-bar" style="height: 30%;"></div>
                <div class="chart-bar" style="height: 50%;"></div>
                <div class="chart-bar" style="height: 70%;"></div>
                <div class="chart-bar" style="height: 60%;"></div>
                <div class="chart-bar" style="height: 80%;"></div>
                <div class="chart-bar" style="height: 90%;"></div>
            </div>
            <div class="date-filter">
                <label for="day">Thống Kê Ngày</label>
                <input id="day" type="date" value="2023-10-01"/>
            </div>
            <div class="chart">
                <div class="chart-bar" style="height: 50%;"></div>
                <div class="chart-bar" style="height: 70%;"></div>
                <div class="chart-bar" style="height: 60%;"></div>
                <div class="chart-bar" style="height: 80%;"></div>
                <div class="chart-bar" style="height: 90%;"></div>
                <div class="chart-bar" style="height: 40%;"></div>
                <div class="chart-bar" style="height: 30%;"></div>
                <div class="chart-bar" style="height: 50%;"></div>
                <div class="chart-bar" style="height: 70%;"></div>
                <div class="chart-bar" style="height: 60%;"></div>
                <div class="chart-bar" style="height: 80%;"></div>
                <div class="chart-bar" style="height: 90%;"></div>
                <div class="chart-bar" style="height: 40%;"></div>
                <div class="chart-bar" style="height: 30%;"></div>
                <div class="chart-bar" style="height: 50%;"></div>
                <div class="chart-bar" style="height: 70%;"></div>
                <div class="chart-bar" style="height: 60%;"></div>
                <div class="chart-bar" style="height: 80%;"></div>
                <div class="chart-bar" style="height: 90%;"></div>
                <div class="chart-bar" style="height: 40%;"></div>
                <div class="chart-bar" style="height: 30%;"></div>
                <div class="chart-bar" style="height: 50%;"></div>
                <div class="chart-bar" style="height: 70%;"></div>
                <div class="chart-bar" style="height: 60%;"></div>
                <div class="chart-bar" style="height: 80%;"></div>
                <div class="chart-bar" style="height: 90%;"></div>
                <div class="chart-bar" style="height: 40%;"></div>
                <div class="chart-bar" style="height: 30%;"></div>
                <div class="chart-bar" style="height: 50%;"></div>
                <div class="chart-bar" style="height: 70%;"></div>
                <div class="chart-bar" style="height: 60%;"></div>
                <div class="chart-bar" style="height: 80%;"></div>
                <div class="chart-bar" style="height: 90%;"></div>
                <div class="chart-bar" style="height: 40%;"></div>
                <div class="chart-bar" style="height: 30%;"></div>
                <div class="chart-bar" style="height: 50%;"></div>
                <div class="chart-bar" style="height: 70%;"></div>
                <div class="chart-bar" style="height: 60%;"></div>
                
   
@endsection
