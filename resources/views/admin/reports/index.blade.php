@extends('layouts.app')
@section('title', 'Báo cáo')
@section('content')
<div class="container mt-4">
    <h1>Báo cáo</h1>

    <h4>Tổng số đơn hàng: {{ $totalOrders }}</h4>
    <h4>Tổng số khách hàng: {{ $totalCustomers }}</h4>

    <!-- Dropdown để chọn loại thống kê -->
    <label for="reportType">Chọn loại thống kê:</label>
    <select id="reportType" class="form-control mb-4" onchange="showReport(this.value)">
        <option value="daily" selected>Thống kê theo ngày</option>
        <option value="monthly">Thống kê theo tháng</option>
        <option value="yearly">Thống kê theo năm</option>
        <option value="category">Thống kê theo danh mục</option>
        <option value="payment">Thống kê theo phương thức thanh toán</option>
    </select>

    <!-- Doanh thu theo ngày -->
    <div id="dailyReport" class="report-table">
        <h3>Doanh thu theo ngày</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Ngày</th>
                    <th>Tổng doanh thu</th>
                </tr>
            </thead>
            <tbody>
                @foreach($revenueByDate as $revenue)
                    <tr>
                        <td>{{ $revenue->date }}</td>
                        <td>{{ number_format($revenue->total_revenue, 2) }} VND</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Thêm canvas cho biểu đồ doanh thu theo ngày -->
        <canvas id="dailyChart" style="width:100%;max-width:600px"></canvas>
    </div>

    <!-- Doanh thu theo tháng -->
    <div id="monthlyReport" class="report-table" style="display:none;">
        <h3>Doanh thu theo tháng</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Tháng</th>
                    <th>Tổng doanh thu</th>
                </tr>
            </thead>
            <tbody>
                @foreach($revenueByMonth as $revenue)
                    <tr>
                        <td>{{ $revenue->month }}</td>
                        <td>{{ number_format($revenue->total_revenue, 2)}} VND</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Thêm canvas cho biểu đồ doanh thu theo tháng -->
        <canvas id="monthlyChart" style="width:100%;max-width:600px"></canvas>
    </div>

    <!-- Doanh thu theo năm -->
    <div id="yearlyReport" class="report-table" style="display:none;">
        <h3>Doanh thu theo năm</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Năm</th>
                    <th>Tổng doanh thu</th>
                </tr>
            </thead>
            <tbody>
                @foreach($revenueByYear as $revenue)
                    <tr>
                        <td>{{ $revenue->year }}</td>
                        <td>{{ number_format($revenue->total_revenue, 2) }} VND</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Thêm canvas cho biểu đồ doanh thu theo năm -->
        <canvas id="yearlyChart" style="width:100%;max-width:600px"></canvas>
    </div>

    <!-- Doanh thu theo danh mục -->
    <div id="categoryReport" class="report-table" style="display:none;">
        <h3>Doanh thu theo danh mục</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Danh mục</th>
                    <th>Tổng doanh thu</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categoryRevenue as $revenue)
                    <tr>
                        <td>{{ $revenue->category_id }}</td>
                        <td>{{ number_format($revenue->total_revenue, 2) }} VND</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Thêm canvas cho biểu đồ doanh thu theo danh mục -->
        <canvas id="categoryChart" style="width:100%;max-width:600px"></canvas>
    </div>

    <!-- Doanh thu theo phương thức thanh toán -->
    <div id="paymentReport" class="report-table" style="display:none;">
        <h3>Doanh thu theo phương thức thanh toán</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Phương thức thanh toán</th>
                    <th>Tổng doanh thu</th>
                </tr>
            </thead>
            <tbody>
                @foreach($revenueByPaymentMethod as $revenue)
                    <tr>
                        <td>{{ $revenue->payment_method }}</td>
                        <td>{{ number_format($revenue->total_revenue, 2) }} VND</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Thêm canvas cho biểu đồ doanh thu theo phương thức thanh toán -->
        <canvas id="paymentChart" style="width:100%;max-width:600px"></canvas>
    </div>
</div>

<!-- Thêm script JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function showReport(reportType) {
        // Ẩn tất cả các bảng thống kê
        const reports = document.querySelectorAll('.report-table');
        reports.forEach(report => report.style.display = 'none');

        // Hiện bảng thống kê theo loại đã chọn
        if (reportType === 'daily') {
            document.getElementById('dailyReport').style.display = 'block';
            renderDailyChart();
        } else if (reportType === 'monthly') {
            document.getElementById('monthlyReport').style.display = 'block';
            renderMonthlyChart();
        } else if (reportType === 'yearly') {
            document.getElementById('yearlyReport').style.display = 'block';
            renderYearlyChart();
        } else if (reportType === 'category') {
            document.getElementById('categoryReport').style.display = 'block';
            renderCategoryChart();
        } else if (reportType === 'payment') {
            document.getElementById('paymentReport').style.display = 'block';
            renderPaymentChart();
        }
    }

    function renderDailyChart() {
        const ctx = document.getElementById('dailyChart').getContext('2d');
        const labels = @json($revenueByDate->pluck('date'));
        const data = @json($revenueByDate->pluck('total_revenue'));

        const colors = labels.map((_, index) => {
            return `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 0.5)`;
        });

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Doanh thu (VND)',
                    data: data,
                    backgroundColor: colors,
                    borderColor: colors.map(color => color.replace(/0.5/, '1')), // Đổi độ trong suốt cho border
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    }

    function renderMonthlyChart() {
        const ctx = document.getElementById('monthlyChart').getContext('2d');
        const labels = @json($revenueByMonth->pluck('month'));
        const data = @json($revenueByMonth->pluck('total_revenue'));

        const colors = labels.map((_, index) => {
            return `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 0.5)`;
        });

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Doanh thu (VND)',
                    data: data,
                    backgroundColor: colors,
                    borderColor: colors.map(color => color.replace(/0.5/, '1')),
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    }

    function renderYearlyChart() {
        const ctx = document.getElementById('yearlyChart').getContext('2d');
        const labels = @json($revenueByYear->pluck('year'));
        const data = @json($revenueByYear->pluck('total_revenue'));

        const colors = labels.map((_, index) => {
            return `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 0.5)`;
        });

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Doanh thu (VND)',
                    data: data,
                    backgroundColor: colors,
                    borderColor: colors.map(color => color.replace(/0.5/, '1')),
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    }

    function renderCategoryChart() {
        const ctx = document.getElementById('categoryChart').getContext('2d');
        const labels = @json($categoryRevenue->pluck('category_id'));
        const data = @json($categoryRevenue->pluck('total_revenue'));

        const colors = labels.map((_, index) => {
            return `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 0.5)`;
        });

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Doanh thu (VND)',
                    data: data,
                    backgroundColor: colors,
                    borderColor: colors.map(color => color.replace(/0.5/, '1')),
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    }

    function renderPaymentChart() {
        const ctx = document.getElementById('paymentChart').getContext('2d');
        const labels = @json($revenueByPaymentMethod->pluck('payment_method'));
        const data = @json($revenueByPaymentMethod->pluck('total_revenue'));

        const colors = labels.map((_, index) => {
            return `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 0.5)`;
        });

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Doanh thu (VND)',
                    data: data,
                    backgroundColor: colors,
                    borderColor: colors.map(color => color.replace(/0.5/, '1')),
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    }


    // Gọi hàm để hiển thị biểu đồ doanh thu theo ngày khi tải trang
    document.addEventListener('DOMContentLoaded', function () {
        renderDailyChart();
    });
</script>
@endsection