@extends('layout.admin')
@section('content')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-chart-bar me-2"></i>Dashboard Perpustakaan</h2>
        <a href="{{ route('chart.index') }}" class="btn btn-primary">
            <i class="fas fa-sync-alt me-1"></i>Refresh Data
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card stats-card">
                <div class="card-body text-center">
                    <i class="fas fa-book fa-2x mb-2"></i>
                    <h4>{{ $data['stats']['total_books'] }}</h4>
                    <p class="mb-0">Total Buku</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card stats-card">
                <div class="card-body text-center">
                    <i class="fas fa-hand-holding fa-2x mb-2"></i>
                    <h4>{{ $data['stats']['active_borrows'] }}</h4>
                    <p class="mb-0">Sedang Dipinjam</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card stats-card">
                <div class="card-body text-center">
                    <i class="fas fa-check-circle fa-2x mb-2"></i>
                    <h4>{{ $data['stats']['returned_books'] }}</h4>
                    <p class="mb-0">Sudah Dikembalikan</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card stats-card">
                <div class="card-body text-center">
                    <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
                    <h4>{{ $data['stats']['overdue_books'] }}</h4>
                    <p class="mb-0">Terlambat</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row mb-4">
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-chart-pie me-2"></i>Distribusi Kategori Buku</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="categoryChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-chart-bar me-2"></i>Status Peminjaman</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="statusChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-lg-8 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-chart-line me-2"></i>Tren Peminjaman Bulanan</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="trendChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-chart-doughnut me-2"></i>Stock Buku</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="stockChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tables -->
    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-list me-2"></i>Daftar Buku</h5>
                </div>
                <div class="card-body">
                    <div class="table-container">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Judul</th>
                                    <th>Penerbit</th>
                                    <th>Kategori</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['booksData'] as $book)
                                <tr>
                                    <td>{{ $book->judul }}</td>
                                    <td>{{ $book->penerbit }}</td>
                                    <td><span class="badge bg-info">{{ $book->kategori }}</span></td>
                                    <td>
                                        <span class="badge {{ $book->stock > 3 ? 'bg-success' : ($book->stock > 0 ? 'bg-warning' : 'bg-danger') }}">
                                            {{ $book->stock }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="fas fa-history me-2"></i>Peminjaman Terbaru</h5>
                </div>
                <div class="card-body">
                    <div class="table-container">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Peminjam</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['recentBorrows'] as $borrow)
                                <tr>
                                    <td>{{ $borrow['peminjam'] }}</td>
                                    <td>{{ $borrow['tanggal_pinjam'] }}</td>
                                    <td>
                                        <span class="badge {{ $borrow['status'] === 'Dikembalikan' ? 'bg-success' : ($borrow['status'] === 'Terlambat' ? 'bg-danger' : 'bg-warning') }}">
                                            {{ $borrow['status'] }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<style>
    .card {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        border: 1px solid rgba(0, 0, 0, 0.125);
    }
    .stats-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    .chart-container {
        position: relative;
        height: 300px;
    }
    .table-container {
        max-height: 400px;
        overflow-y: auto;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script>
    // Data dari controller (PHP ke JavaScript)
    const chartData = @json($data);
    
    document.addEventListener('DOMContentLoaded', function() {
        createCategoryChart();
        createStatusChart();
        createTrendChart();
        createStockChart();
    });

    function createCategoryChart() {
        const data = chartData.categoryData;
        const labels = data.map(item => item.kategori);
        const values = data.map(item => item.total);
        
        const ctx = document.getElementById('categoryChart').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: values,
                    backgroundColor: [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }

    function createStatusChart() {
        const data = chartData.statusData;
        const labels = data.map(item => item.status);
        const values = data.map(item => item.total);
        
        const ctx = document.getElementById('statusChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah',
                    data: values,
                    backgroundColor: ['#28a745', '#ffc107', '#dc3545']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    function createTrendChart() {
        const data = chartData.trendData;
        const months = data.map(item => item.month);
        const borrowData = data.map(item => item.borrows);
        const returnData = data.map(item => item.returns);
        
        const ctx = document.getElementById('trendChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: 'Peminjaman',
                    data: borrowData,
                    borderColor: '#36A2EB',
                    backgroundColor: 'rgba(54, 162, 235, 0.1)',
                    tension: 0.4
                }, {
                    label: 'Pengembalian',
                    data: returnData,
                    borderColor: '#28a745',
                    backgroundColor: 'rgba(40, 167, 69, 0.1)',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    function createStockChart() {
        const data = chartData.stockData;
        
        const ctx = document.getElementById('stockChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Tersedia', 'Dipinjam'],
                datasets: [{
                    data: [data.available, data.borrowed],
                    backgroundColor: ['#28a745', '#ffc107']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }
</script>
@endpush