@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Dashboard Admin</h1>

    <!-- Statistik -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Penghuni</h5>
                    <p class="card-text">{{ $jumlahPenghuni }} Orang</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Pemasukan</h5>
                    <p class="card-text">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Pemasukan -->
    <div class="card mb-4">
        <div class="card-header">Grafik Pemasukan Bulanan</div>
        <div class="card-body">
            <canvas id="pemasukanChart"></canvas>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script>
    var ctx = document.getElementById('pemasukanChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($bulan) !!},
            datasets: [{
                label: 'Pemasukan (Rp)',
                data: {!! json_encode($pendapatan) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
