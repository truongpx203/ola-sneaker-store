@extends('admin.layouts.master')

@section('title')
    Dashboard
@endsection

@section('content')
    <h3 class="mb-3">Thống kê bán hàng</h3>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">#1. Thống kê đơn hàng</h4>
                </div>

                <div class="card-body bg-body-tertiary">
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-primary-subtle text-primary rounded-2 fs-2">
                                                <i class="ri-information-line"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden ms-3">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Chờ xác nhận
                                            </p>
                                            <div class="d-flex align-items-center mb-3">
                                                <h4 class="fs-4 flex-grow-1 mb-0">{{ $choXacNhan }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div>
                        </div><!-- end col -->

                        <div class="col-xl-4">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-primary-subtle text-primary rounded-2 fs-2">
                                                <i class="ri-add-circle-line"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="text-uppercase fw-medium text-muted mb-3">Đã xác nhận</p>
                                            <div class="d-flex align-items-center mb-3">
                                                <h4 class="fs-4 flex-grow-1 mb-0">{{ $daXacNhan }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div>
                        </div><!-- end col -->

                        <div class="col-xl-4">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-primary-subtle text-primary rounded-2 fs-2">
                                                <i class="ri-takeaway-line"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden ms-3">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-3">Đang giao</p>
                                            <div class="d-flex align-items-center mb-3">
                                                <h4 class="fs-4 flex-grow-1 mb-0">{{ $dangGiao }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div>
                        </div><!-- end col -->
                    </div>
                    <div class="row">
                        <div class="col-xl-3">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-success-subtle text-success rounded-2 fs-2">
                                                <i class="ri-checkbox-circle-line"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden ms-3">
                                            <p class="text-uppercase fw-medium text-success text-truncate mb-3">Giao hàng
                                                thành công</p>
                                            <div class="d-flex align-items-center mb-3">
                                                <h4 class="fs-4 flex-grow-1 text-success mb-0">{{ $giaoThanhCong }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div>
                        </div><!-- end col -->

                        <div class="col-xl-3">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-danger-subtle text-danger rounded-2 fs-2">
                                                <i class="ri-close-circle-line"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden ms-3">
                                            <p class="text-uppercase fw-medium text-danger text-truncate mb-3">Giao hàng
                                                thất bại</p>
                                            <div class="d-flex align-items-center mb-3">
                                                <h4 class="fs-4 flex-grow-1 mb-0 text-danger">{{ $giaoThatBai }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div>
                        </div><!-- end col -->

                        <div class="col-xl-3">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-warning-subtle text-warning rounded-2 fs-2">
                                                <i class="ri-checkbox-circle-line"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden ms-3">
                                            <p class="text-uppercase fw-medium text-warning text-truncate mb-3">Đơn hàng
                                                hoàn thành</p>
                                            <div class="d-flex align-items-center mb-3">
                                                <h4 class="fs-4 flex-grow-1 mb-0 text-warning">{{ $hoanThanh }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div>
                        </div><!-- end col -->

                        <div class="col-xl-3">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-dark-subtle text-dark rounded-2 fs-2">
                                                <i class="ri-delete-bin-line"></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden ms-3">
                                            <p class="text-uppercase fw-medium text-dark text-truncate mb-3">Đã hủy
                                            </p>
                                            <div class="d-flex align-items-center mb-3">
                                                <h4 class="fs-4 flex-grow-1 mb-0">{{ $daHuy }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div>
                        </div><!-- end col -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card">


                    <div class="card-header border-0 d-flex align-items-center my-auto">
                        <h4 class="card-title mb-0">#2. Thống kê doanh thu</h4>
                        <ul class="nav nav-pills dasboard_admin" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="dasboard-day-tab" data-bs-toggle="pill"
                                    data-bs-target="#dasboard-day" type="button" role="tab"
                                    aria-controls="dasboard-day" aria-selected="true">Theo ngày</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="dasboard-month-tab" data-bs-toggle="pill"
                                    data-bs-target="#dasboard-month" type="button" role="tab"
                                    aria-controls="dasboard-month" aria-selected="false">Theo tháng</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="dasboard-year-tab" data-bs-toggle="pill"
                                    data-bs-target="#dasboard-year" type="button" role="tab"
                                    aria-controls="dasboard-year" aria-selected="false">Theo năm</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="dasboard-tg-tab" data-bs-toggle="pill"
                                    data-bs-target="#dasboard-tg" type="button" role="tab"
                                    aria-controls="dasboard-tg" aria-selected="false">Theo khoảng thời gian</button>
                            </li>
                        </ul>

                    </div><!-- end card header -->
                    {{-- Thống kê ngày --}}
                    {{-- <div class="card-body p-0 pb-2">
                        <div class="w-100"> --}}
                    <div class="tab-content">
                        <div class="card-body">
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="dasboard-day" role="tabpanel"
                                    aria-labelledby="dasboard-day-tab" tabindex="0">
                                    <div class="section-header mb-3">
                                        <h5 class="text-uppercase">Thống kê theo ngày</h5>
                                    </div>

                                    <div class="date-filter mb-4">
                                        <form id="form-statistics" class="d-flex align-items-center">
                                            <label for="date" class="me-2">Chọn ngày:</label>
                                            <input type="date" id="date" name="date"
                                                value="{{ now()->toDateString() }}" class="form-control me-2"
                                                style="max-width: 200px;">
                                            <button type="submit" class="btn btn-primary">Thống kê</button>
                                        </form>
                                    </div>

                                    <div class="chart">
                                        <canvas id="hourlyChart" class="w-100" style="max-height: 300px;"></canvas>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="dasboard-month" role="tabpanel"
                                    aria-labelledby="dasboard-month-tab" tabindex="0">
                                    <div class="section-header mb-3">
                                        <h5 class="text-uppercase">Thống kê theo tháng</h5>
                                    </div>

                                    <div class="month-filter mb-4">
                                        <div class="d-flex justify-content-end">
                                            <form id="form-statistics-month" class="d-flex align-items-center">
                                                <label for="month" class="me-2">Chọn tháng:</label>
                                                <input type="month" id="month" name="month"
                                                    class="form-control me-2" value="{{ now()->format('Y-m') }}" required>
                                                <button type="submit" class="btn btn-primary">thống kê</button>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="chart">
                                        <canvas id="monthlyChart" class="w-100" style="max-height: 300px;"></canvas>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="dasboard-tg" role="tabpanel"
                                    aria-labelledby="dasboard-tg-all" tabindex="0">
                                    <div class="section-header mb-3">
                                        <h5 class="text-uppercase">Thống kê theo Khoảng thời gian</h5>
                                    </div>
                                    <div class="month-filter mb-4">
                                        <div class="d-flex justify-content-end">
                                            <form id="form-statistics-time" class="d-flex align-items-center">
                                                <label for="start_date" class="me-2">Ngày bắt đầu:</label>
                                                <input type="date" id="start_date" name="start_date"
                                                    class="form-control me-2" required>

                                                <label for="end_date" class="me-2">Ngày kết thúc:</label>
                                                <input type="date" id="end_date" name="end_date"
                                                    class="form-control me-2" required>

                                                <button type="submit" class="btn btn-primary">Thống kê</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="chart">
                                        <canvas id="timeRangeChart" class="w-100" style="max-height: 300px;"></canvas>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="dasboard-month" role="tabpanel"
                                    aria-labelledby="dasboard-month-tab" tabindex="0"></div>
                                <div class="tab-pane fade" id="dasboard-year" role="tabpanel"
                                    aria-labelledby="dasboard-year-tab" tabindex="0">
                                    <div class="section-header mb-3">
                                        <h5 class="text-uppercase">Thống kê theo năm</h5>
                                    </div>

                                    <div class="date-filter mb-4">
                                        <form id="form-statistics-year" class="d-flex align-items-center">
                                            <label for="year" class="me-2">Năm:</label>
                                            <input type="number" id="year" name="year"
                                                value="{{ now()->format('Y') }}" class="form-control me-2"
                                                style="max-width: 200px;">
                                            <button type="submit" class="btn btn-primary">Xem thống kê</button>
                                        </form>

                                    </div>

                                    <div class="chart">
                                        <canvas id="hourlyChartYear" class="w-100" style="max-height: 300px;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- </div><!-- end card body -->
                    </div> --}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4">
                    <div class="card card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 text-truncate flex-grow-1">Top 5 sản phẩm bán chạy nhất</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table table-hover table-centered align-middle table-nowrap mb-0">
                                    <tbody>
                                        @foreach ($topBanChayNhat as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm bg-light rounded p-1 me-2">
                                                            <img src="{{ Storage::url($item->product_image_url) }}"
                                                                alt="{{ $item->product_name }}"
                                                                class="img-fluid d-block">
                                                        </div>
                                                        <div>
                                                            <h5 class="fs-14 my-1">{{ $item->product_name }}</h5>
                                                            <h5 class="fs-14 my-1 fw-normal">Lượt bán:
                                                                {{ $item->total_revenue }}
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-4">
                    <div class="card card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 text-truncate flex-grow-1">Top 5 sản phẩm doanh thu cao nhất</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table table-hover table-centered align-middle table-nowrap mb-0">
                                    <tbody>
                                        @foreach ($topDoanhThuCaoNhat as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm bg-light rounded p-1 me-2">
                                                            <img src="{{ Storage::url($item->product_image_url) }}"
                                                                alt="{{ $item->product_name }}"
                                                                class="img-fluid d-block">
                                                        </div>
                                                        <div>
                                                            <h5 class="fs-14 my-1">{{ $item->product_name }}</h5>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-muted">Tổng doanh thu:</span>
                                                    <h5 class="fs-14 my-1 fw-normal">
                                                        {{ number_format($item->total_revenue, 0, ',', '.') }} VNĐ
                                                    </h5>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-4">
                    <div class="card card-height-100">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 text-truncate flex-grow-1">Top 5 sản phẩm lợi nhuận cao nhất</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table table-hover table-centered align-middle table-nowrap mb-0">
                                    <tbody>
                                        @foreach ($topLoiNhuanCaoNhat as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm bg-light rounded p-1 me-2">
                                                            <img src="{{ Storage::url($item->product_image_url) }}"
                                                                alt="{{ $item->product_name }}"
                                                                class="img-fluid d-block">
                                                        </div>
                                                        <div>
                                                            <h5 class="fs-14 my-1">{{ $item->product_name }}</h5>
                                                        </div>
                                                    </div>

                                                </td>
                                                <td>
                                                    <span class="text-muted">Tổng lợi nhuận:</span>
                                                    <h5 class="fs-14 my-1 fw-normal">
                                                        {{ number_format($item->total_profit, 0, ',', '.') }} VNĐ</h5>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div>
        </div>

        <style>
            /* Card styling */
            .card {
                background-color: white;
                border: 1px solid #ddd;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                margin: 20px;
                padding: 20px;
            }

            .card-header {
                background-color: #f5f5f5;
                padding: 10px;
                border-bottom: 1px solid #ddd;
                border-top-left-radius: 8px;
                border-top-right-radius: 8px;
            }

            .card-body {
                padding: 20px;
            }

            /* Date filter form styling */
            .date-filter {
                display: flex;
                justify-content: flex-end;
            }

            .date-filter-form {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            label {
                margin-right: 5px;
            }

            input[type="date"] {
                padding: 5px;
                border-radius: 4px;
                border: 1px solid #ccc;
            }

            /* Chart styling */
            .chart-container {
                margin-top: 20px;
            }
        </style>
    </div>
@endsection

@section('style-libs')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection
@section('script-libs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection

{{-- Thống kê ngày --}}
@section('scripts')
    <script>
        document.getElementById('form-statistics').addEventListener('submit', function(event) {
            event.preventDefault();
            const date = document.getElementById('date').value;

            fetch('{{ route('statistics') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        date: date
                    })
                })
                .then(response => response.json())
                .then(data => {
                    updateChart(data);
                    updateTotal(data);
                });
        });

        const hourlyctx = document.getElementById('hourlyChart').getContext('2d');
        const hourlyChart = new Chart(hourlyctx, {
            type: 'bar',
            data: {
                labels: Array.from({ length: 24 }, (_, i) => `${i}:00`),
                datasets: [{
                        label: 'Doanh thu (VNĐ)',
                        data: Array(24).fill(0), // Dữ liệu mặc định cho doanh thu
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Lợi nhuận (VNĐ)',
                        data: Array(24).fill(0), // Dữ liệu mặc định cho lợi nhuận
                        backgroundColor: 'rgba(255, 99, 132, 0.6)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        position: 'left', // Gộp cả hai cột về trục bên trái
                        title: {
                            display: true,
                            text: 'Doanh thu và Lợi nhuận (VNĐ)' // Tiêu đề chung cho trục
                        }
                    }
                }
            }
        });
        // Thống kê theo năm
        document.addEventListener('DOMContentLoaded', function() {
    const year = document.getElementById('year').value;

    // Lấy dữ liệu ban đầu cho năm hiện tại
    fetchStatistics(year);

    // Bắt sự kiện khi form được submit
    document.getElementById('form-statistics-year').addEventListener('submit', function(event) {
        event.preventDefault();
        const year = document.getElementById('year').value;
        fetchStatistics(year);
    });
});

// Hàm fetch dữ liệu và cập nhật biểu đồ
function fetchStatistics(year) {
    fetch('{{ route('statisticsYear') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                year: year
            })
        })
        .then(response => response.json())
        .then(data => {
            updateChartYear(data); // Cập nhật biểu đồ với dữ liệu mới
        });
}

// Khởi tạo biểu đồ
const hourlyctxYear = document.getElementById('hourlyChartYear').getContext('2d');
const hourlyChartYear = new Chart(hourlyctxYear, {
    type: 'bar',
    data: {
        labels: Array.from({
            length: 12
        }, (_, i) => `T${i + 1}`), // T1 đến T12
        datasets: [{
            label: 'Doanh thu (VNĐ)',
            data: Array(12).fill(0), // Khởi tạo mảng doanh thu rỗng
            backgroundColor: 'rgba(54, 162, 235, 0.6)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }, {
            label: 'Lợi nhuận (VNĐ)',
            data: Array(12).fill(0), // Khởi tạo mảng lợi nhuận rỗng
            backgroundColor: 'rgba(255, 99, 132, 0.6)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                position: 'left', // Cả hai dùng chung trục y bên trái
                title: {
                    display: true,
                    text: 'Doanh thu và Lợi nhuận (VNĐ)' // Tiêu đề chung
                }
            }
        }
    }
});
// Theo tháng
document.getElementById('form-statistics-month').addEventListener('submit', function(event) {
    event.preventDefault(); // Ngăn chặn hành động gửi form mặc định
    const month = document.getElementById('month').value; // Lấy tháng được chọn
    const [year, monthValue] = month.split('-'); // Tách năm và tháng từ giá trị tháng

    fetch('{{ route('statisticsMonth') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                month: monthValue,
                year: year // Gửi thêm năm
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            updateMonthlyChart(data); // Cập nhật biểu đồ với dữ liệu mới
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
});

// Khởi tạo biểu đồ tháng
const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
const monthlyChart = new Chart(monthlyCtx, {
    type: 'bar',
    data: {
        labels: Array.from({ length: 31 }, (_, i) => i + 1), // Tạo nhãn cho 31 ngày
        datasets: [{
                label: 'Doanh thu (VNĐ)',
                data: Array(31).fill(0), // Dữ liệu mặc định cho 31 ngày
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            },
            {
                label: 'Lợi nhuận (VNĐ)',
                data: Array(31).fill(0), // Dữ liệu mặc định cho 31 ngày
                backgroundColor: 'rgba(255, 99, 132, 0.6)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }
        ]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                position: 'left', // Cả hai dùng chung trục y bên trái
                title: {
                    display: true,
                    text: 'Doanh thu và lợi nhuận (VNĐ)' // Tiêu đề chung cho cả doanh thu và lợi nhuận
                }
            }
        }
    }
});
        // Theo khoảng thời gian
document.getElementById('form-statistics-time').addEventListener('submit', function(event) {
    event.preventDefault(); // Ngăn chặn hành động gửi form mặc định
    const startDate = document.getElementById('start_date').value; // Lấy ngày bắt đầu
    const endDate = document.getElementById('end_date').value; // Lấy ngày kết thúc
    const errorDiv = document.getElementById('error-message');
    if (errorDiv) {
        errorDiv.remove();
    }
    fetch('{{ route('statisticsTimeRange') }}', { // Sử dụng route để gửi yêu cầu đến server
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                start_date: startDate,
                end_date: endDate
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Khoảng thời gian không vượt quá 30 ngày');
            }
            return response.json();
        })
        .then(data => {
            updateTimeRangeChart(data); // Cập nhật biểu đồ với dữ liệu mới
        })
        .catch(error => {
            // Hiển thị thông báo lỗi nếu khoảng thời gian không hợp lệ
            const errorMessage = document.createElement('div');
            errorMessage.id = 'error-message';
            errorMessage.classList.add('alert', 'alert-danger');
            errorMessage.innerText = error.message;

            // Chèn thông báo lỗi vào trước form
            document.getElementById('form-statistics-time').insertAdjacentElement('beforebegin', errorMessage);
        });
});

// Khởi tạo biểu đồ cho khoảng thời gian
const timeRangeCtx = document.getElementById('timeRangeChart').getContext('2d');
const timeRangeChart = new Chart(timeRangeCtx, {
    type: 'bar',
    data: {
        labels: [], // Nhãn sẽ được cập nhật khi có dữ liệu từ server
        datasets: [{
                label: 'Doanh thu (VNĐ)',
                data: [], // Dữ liệu doanh thu sẽ được cập nhật
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            },
            {
                label: 'Lợi nhuận (VNĐ)',
                data: [],
                backgroundColor: 'rgba(255, 99, 132, 0.6)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
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
                    text: 'Doanh thu và lợi nhuận (VNĐ)' // Tiêu đề chung cho cả doanh thu và lợi nhuận
                }
            }
        }
    }
});
        // Hàm cập nhật biểu đồ theo khoảng thời gian
        function updateTimeRangeChart(data) {
            const labels = data.labels; // Dữ liệu nhãn (ngày)
            const revenues = data.revenues; // Dữ liệu doanh thu
            const profits = data.profits; // Dữ liệu lợi nhuận

            // Cập nhật dữ liệu của biểu đồ
            timeRangeChart.data.labels = labels;
            timeRangeChart.data.datasets[0].data = revenues;
            timeRangeChart.data.datasets[1].data = profits;

            // Cập nhật biểu đồ
            timeRangeChart.update();
        }

        function updateMonthlyChart(data) {
    const revenueData = Array(31).fill(0); // Dữ liệu doanh thu
    const profitData = Array(31).fill(0); // Dữ liệu lợi nhuận

    // Cập nhật dữ liệu cho biểu đồ từ dữ liệu trả về
    data.forEach(item => {
        const day = item.day; // Ngày trong tháng
        revenueData[day - 1] = item.total_revenue; // Cập nhật doanh thu
        profitData[day - 1] = item.total_profit; // Cập nhật lợi nhuận
    });

    // Cập nhật dữ liệu cho biểu đồ
    monthlyChart.data.datasets[0].data = revenueData; // Doanh thu
    monthlyChart.data.datasets[1].data = profitData; // Lợi nhuận
    monthlyChart.update(); // Cập nhật biểu đồ
}

        function updateChart(data) {
            hourlyChart.data.datasets[0].data = data.revenues;
            hourlyChart.data.datasets[1].data = data.profits;
            hourlyChart.update();
        }

        function updateChartYear(data) {
            const revenueData = Array(12).fill(0);
            const profitData = Array(12).fill(0);
            data.forEach(item => {
                const monthIndex = item.month - 1; // Chỉ số tháng (0-11)
                revenueData[monthIndex] = item.total_revenue;
                profitData[monthIndex] = item.total_profit;
            });
            hourlyChartYear.data.datasets[0].data = revenueData;
            hourlyChartYear.data.datasets[1].data = profitData;
            hourlyChartYear.update();
        }
    </script>
@endsection
