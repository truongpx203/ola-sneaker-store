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
                    <div class="card-header border-0 align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">#2. Thống kê doanh thu</h4>
                    </div><!-- end card header -->
                    {{-- Thống kê ngày --}}
                    {{-- <div class="card-body p-0 pb-2">
                        <div class="w-100"> --}}
                    <div class="card-body">
                        <div class="section-header mb-3">
                            <h5 class="text-uppercase">Thống kê theo ngày</h5>
                        </div>

                        <div class="date-filter mb-4">
                            <form id="form-statistics" class="d-flex align-items-center">
                                <label for="date" class="me-2">Chọn ngày:</label>
                                <input type="date" id="date" name="date" value="{{ now()->toDateString() }}"
                                    class="form-control me-2" style="max-width: 200px;">
                                <button type="submit" class="btn btn-primary">Xem thống kê</button>
                            </form>
                        </div>

                        <div class="chart">
                            <canvas id="hourlyChart" class="w-100" style="max-height: 300px;"></canvas>
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
                                                            alt="{{ $item->product_name }}" class="img-fluid d-block">
                                                    </div>
                                                    <div>
                                                        <h5 class="fs-14 my-1">{{ $item->product_name }}</h5>
                                                        <h5 class="fs-14 my-1 fw-normal">Giá bán:
                                                            {{ number_format($item->sale_price, 0, ',', '.') }} VNĐ</h5>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="fs-14 my-1 fw-normal">Giá niêm yết:
                                                    {{ number_format($item->listed_price, 0, ',', '.') }} VNĐ</h5>
                                                <h5 class="fs-14 my-1 fw-normal">Giá nhập:
                                                    {{ number_format($item->import_price, 0, ',', '.') }} VNĐ</h5>
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
                                                            alt="{{ $item->product_name }}" class="img-fluid d-block">
                                                    </div>
                                                    <div>
                                                        <h5 class="fs-14 my-1">{{ $item->product_name }}</h5>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-muted">Tổng doanh thu:</span>
                                                <h5 class="fs-14 my-1 fw-normal">
                                                    {{ number_format($item->total_revenue, 0, ',', '.') }} VNĐ</h5>
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
                                                            alt="{{ $item->product_name }}" class="img-fluid d-block">
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
            document.getElementById('form-statistics').addEventListener('submit', function (event) {
            event.preventDefault();
            const date = document.getElementById('date').value;

            fetch('{{ route("statistics") }}', {
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
