@extends('admin.layouts.master')

@section('title')
    Dashboard
@endsection

@section('content')
    <html>

    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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

            .order-status,
            .revenue-statistics,
            .product-statistics,
            .advanced-statistics {
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

            .date-filter select {
                width: 150px;
                text-align: center;
                margin-left: 10px;
                border-radius: 5px;
                border: 1px solid #ced4da;
                padding: 5px;
            }

            .date-filter a {
                width: 150px;
                text-align: center;
                margin-left: 10px;
                border-radius: 5px;
                border: 1px solid #ced4da;
                padding: 5px;
                text-decoration: none;
                color: #000;
            }
        </style>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                        <br />
                        10
                    </button>
                    <button class="btn btn-outline-dark">
                        Đã Xác Nhận
                        <br />
                        10
                    </button>
                    <button class="btn btn-outline-dark">
                        Đang Giao
                        <br />
                        10
                    </button>
                    <button class="btn btn-success">
                        Giao Thành Công
                        <br />
                        10
                    </button>
                    <button class="btn btn-danger">
                        Giao Thất Bại
                        <br />
                        10
                    </button>
                    <button class="btn btn-secondary">
                        Hủy
                        <br />
                        10
                    </button>
                </div>
            </div>
            <div class="revenue-statistics">
                <div class="section-header">
                    Thống Kê Doanh Thu Theo Năm
                </div>
                <div class="date-filter">
                    <select name="yearDasboard" id="year"></select>
                    <a href="#" id="statsLink">Thống kê</a>
                </div>
                <div class="section-header">
                    Doanh Thu: {{ number_format($doanhthu, 0, ',', '.') }} VNĐ
                </div>
                <div class="chart">
                    <canvas id="revenueChart" width="1139" height="200"></canvas>
                </div>
            </div>

            {{-- View: Thống kê theo ngày --}}
            <div class="revenue-statistics">
                <div class="section-header">
                    Thống kê theo ngày
                </div>
                <div class="date-filter">
                    <form id="form-statistics">
                        <label for="date">Chọn ngày:</label>
                        <input type="date" id="date" name="date" value="{{ now()->toDateString() }}">
                        <button type="submit">Xem thống kê</button>
                    </form>
                </div>


                <div class="chart">
                    <canvas id="hourlyChart" width="1239" height="200"></canvas>
                </div>
            </div>
        </div>
    </body>

    </html>

    {{-- <div class="product-statistics">
                <div class="section-header">
                    Thống Kê Sản Phẩm
                </div>
                <div class="product-list">
                    <div class="section-header">
                        Top 5 Sản Phẩm Doanh Thu Cao Nhất
                    </div>
                    <div class="product-item">
                        <img src="https://placehold.co/50x50" alt="Placeholder image for product" />
                        <div class="product-info">
                            Tên sản phẩm
                            <br />
                            Mã sản phẩm
                        </div>
                        <div class="product-price">
                            500,000 VNĐ
                        </div>
                    </div>
                    <div class="product-item">
                        <img src="https://placehold.co/50x50" alt="Placeholder image for product" />
                        <div class="product-info">
                            Tên sản phẩm
                            <br />
                            Mã sản phẩm
                        </div>
                        <div class="product-price">
                            500,000 VNĐ
                        </div>
                    </div>
                    <div class="product-item">
                        <img src="https://placehold.co/50x50" alt="Placeholder image for product" />
                        <div class="product-info">
                            Tên sản phẩm
                            <br />
                            Mã sản phẩm
                        </div>
                        <div class="product-price">
                            500,000 VNĐ
                        </div>
                    </div>
                    <div class="product-item">
                        <img src="https://placehold.co/50x50" alt="Placeholder image for product" />
                        <div class="product-info">
                            Tên sản phẩm
                            <br />
                            Mã sản phẩm
                        </div>
                        <div class="product-price">
                            500,000 VNĐ
                        </div>
                    </div>
                    <div class="product-item">
                        <img src="https://placehold.co/50x50" alt="Placeholder image for product" />
                        <div class="product-info">
                            Tên sản phẩm
                            <br />
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
                        <img src="https://placehold.co/50x50" alt="Placeholder image for product" />
                        <div class="product-info">
                            Tên sản phẩm
                            <br />
                            Mã sản phẩm
                        </div>
                        <div class="product-price">
                            500,000 VNĐ
                        </div>
                    </div>
                    <div class="product-item">
                        <img src="https://placehold.co/50x50" alt="Placeholder image for product" />
                        <div class="product-info">
                            Tên sản phẩm
                            <br />
                            Mã sản phẩm
                        </div>
                        <div class="product-price">
                            500,000 VNĐ
                        </div>
                    </div>
                    <div class="product-item">
                        <img src="https://placehold.co/50x50" alt="Placeholder image for product" />
                        <div class="product-info">
                            Tên sản phẩm
                            <br />
                            Mã sản phẩm
                        </div>
                        <div class="product-price">
                            500,000 VNĐ
                        </div>
                    </div>
                    <div class="product-item">
                        <img src="https://placehold.co/50x50" alt="Placeholder image for product" />
                        <div class="product-info">
                            Tên sản phẩm
                            <br />
                            Mã sản phẩm
                        </div>
                        <div class="product-price">
                            500,000 VNĐ
                        </div>
                    </div>
                    <div class="product-item">
                        <img src="https://placehold.co/50x50" alt="Placeholder image for product" />
                        <div class="product-info">
                            Tên sản phẩm
                            <br />
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
                        <img src="https://placehold.co/50x50" alt="Placeholder image for product" />
                        <div class="product-info">
                            Tên sản phẩm
                            <br />
                            Mã sản phẩm
                        </div>
                        <div class="product-price">
                            500,000 VNĐ
                        </div>
                    </div>
                    <div class="product-item">
                        <img src="https://placehold.co/50x50" alt="Placeholder image for product" />
                        <div class="product-info">
                            Tên sản phẩm
                            <br />
                            Mã sản phẩm
                        </div>
                        <div class="product-price">
                            500,000 VNĐ
                        </div>
                    </div>
                    <div class="product-item">
                        <img src="https://placehold.co/50x50" alt="Placeholder image for product" />
                        <div class="product-info">
                            Tên sản phẩm
                            <br />
                            Mã sản phẩm
                        </div>
                        <div class="product-price">
                            500,000 VNĐ
                        </div>
                    </div>
                    <div class="product-item">
                        <img src="https://placehold.co/50x50" alt="Placeholder image for product" />
                        <div class="product-info">
                            Tên sản phẩm
                            <br />
                            Mã sản phẩm
                        </div>
                        <div class="product-price">
                            500,000 VNĐ
                        </div>
                    </div>
                    <div class="product-item">
                        <img src="https://placehold.co/50x50" alt="Placeholder image for product" />
                        <div class="product-info">
                            Tên sản phẩm
                            <br />
                            Mã sản phẩm
                        </div>
                        <div class="product-price">
                            500,000 VNĐ
                        </div>
                    </div>
                </div>
            </div>
            <div class="advanced-statistics">
                <div class="date-filter">
                    <label for="day">Thống Kê Ngày</label>
                    <input id="day" type="date" value="2023-10-01" />
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
                </div>
            </div> --}}

    <script>
        const revenueData = @json($revenueByMonth);

        const labels = revenueData.map(item => `Tháng ${item.month}`);
        const data = revenueData.map(item => item.total_revenue);

        const ctx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Doanh thu hàng tháng',
                    data: data,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        //
        const currentYear = new Date().getFullYear();
        const yearSelect = document.getElementById('year');
        for (let year = 2000; year <= currentYear; year++) {
            const option = document.createElement('option');
            option.value = year;
            option.textContent = year;
            yearSelect.appendChild(option);
        }
        const urlParams = new URLSearchParams(window.location.search);
        const selectedYear = urlParams.get('yearDasboard');
        if (selectedYear) {
            yearSelect.value = selectedYear;
        } else {
            yearSelect.value = currentYear;
        }
        const statsLink = document.getElementById('statsLink');
        statsLink.addEventListener('click', function(event) {
            event.preventDefault();
            const selectedYear = yearSelect.value;
            const url = `{{ route('dashboard') }}?yearDasboard=${selectedYear}`;
            window.location.href = url;
        });

        // Thống kê ngày 

        document.getElementById('form-statistics').addEventListener('submit', function (event) {
            event.preventDefault();
            const date = document.getElementById('date').value;

            fetch('{{ route("statistics.data") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ date: date })
            })
            .then(response => response.json())
            .then(data => {
                updateChart(data);
            });
        });

        const hourlyctx = document.getElementById('hourlyChart').getContext('2d');
        const hourlyChart = new Chart(hourlyctx, {
            type: 'bar',
            data: {
                labels: Array.from({length: 24}, (_, i) => `${i}:00`),
                datasets: [
                    {
                        label: 'Số lượng sản phẩm đã mua',
                        data: Array(24).fill(0),
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        yAxisID: 'y'
                    },
                    {
                        label: 'Doanh thu (VNĐ)',
                        data: Array(24).fill(0),
                        backgroundColor: 'rgba(255, 99, 132, 0.6)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1,
                        yAxisID: 'y1'
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        position: 'left',
                        title: {
                            display: true,
                            text: 'Số lượng sản phẩm'
                        }
                    },
                    y1: {
                        beginAtZero: true,
                        position: 'right',
                        title: {
                            display: true,
                            text: 'Doanh thu (VNĐ)'
                        },
                        grid: {
                            drawOnChartArea: false // Tắt đường lưới cho doanh thu
                        }
                    }
                }
            }
        });

        function updateChart(data) {
            hourlyChart.data.datasets[0].data = data.counts;
            hourlyChart.data.datasets[1].data = data.revenues;
            hourlyChart.update();
        }
    </script>

@endsection
