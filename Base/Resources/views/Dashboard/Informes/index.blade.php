@extends('layout/plantilla')
@section('page-inner')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
        <div>
            <h2 class="text-white pb-2 fw-bold">{{ __('stadistics.title') }}</h2>
            <h5 class="text-white op-7 mb-2">{{ __('stadistics.subtitle') }}</h5>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('modules/base/js/user.js') }}"></script>
    <script>
        $(document).ready(function() {

            Circles.create({
                id: 'circles-3',
                radius: 45,
                value: 0,
                maxValue: 100,
                width: 7,
                text: function() {
                    return 0;
                },
                colors: ['#f1f1f1', '#33A4F5'],
                duration: 400,
                wrpClass: 'circles-wrp',
                textClass: 'circles-text',
                styleWrapper: true,
                styleText: true
            })

            Circles.create({
                id: 'circles-Productos',
                radius: 45,
                value: '${$Allproductos}',
                maxValue: 100,
                width: 7,
                text: function() {
                    return {{ $Allproductos }};
                },
                colors: ['#f1f1f1', '#33A4F5'],
                duration: 400,
                wrpClass: 'circles-wrp',
                textClass: 'circles-text',
                styleWrapper: true,
                styleText: true
            })

            Circles.create({
                id: 'circles-Categorias',
                radius: 45,
                value: {{ $Allcategoria }},
                maxValue: 100,
                width: 7,
                text: function() {
                    return {{ $Allcategoria }};
                },
                colors: ['#f1f1f1', '#33A4F5'],
                duration: 400,
                wrpClass: 'circles-wrp',
                textClass: 'circles-text',
                styleWrapper: true,
                styleText: true
            })

            Circles.create({
                id: 'circles-Etiquetas',
                radius: 45,
                value: {{ $Alletiqueta }},
                maxValue: 100,
                width: 7,
                text: function() {
                    return {{ $Alletiqueta }};
                },
                colors: ['#f1f1f1', '#33A4F5'],
                duration: 400,
                wrpClass: 'circles-wrp',
                textClass: 'circles-text',
                styleWrapper: true,
                styleText: true
            })

            Circles.create({
                id: 'circles-Activos',
                radius: 45,
                value: {{ $productosActive }},
                maxValue: 100,
                width: 7,
                text: function() {
                    return {{ $productosActive }};
                },
                colors: ['#f1f1f1', '#2BB930'],
                duration: 400,
                wrpClass: 'circles-wrp',
                textClass: 'circles-text',
                styleWrapper: true,
                styleText: true
            })

            Circles.create({
                id: 'circles-Suspendidos',
                radius: 45,
                value: {{ $productosSupend }},
                maxValue: 100,
                width: 7,
                text: function() {
                    return {{ $productosSupend }};
                },
                colors: ['#f1f1f1', '#FF9E27'],
                duration: 400,
                wrpClass: 'circles-wrp',
                textClass: 'circles-text',
                styleWrapper: true,
                styleText: true
            })

            Circles.create({
                id: 'circles-Cancelados',
                radius: 45,
                value: {{ $productosCancel }},
                maxValue: 100,
                width: 7,
                text: function() {
                    return {{ $productosCancel }};
                },
                colors: ['#f1f1f1', '#F25961'],
                duration: 400,
                wrpClass: 'circles-wrp',
                textClass: 'circles-text',
                styleWrapper: true,
                styleText: true
            })

            Circles.create({
                id: 'circles-factory',
                radius: 45,
                value: {{ $Allfactory }},
                maxValue: 100,
                width: 7,
                text: function() {
                    return {{ $Allfactory }};
                },
                colors: ['#f1f1f1', '#33A4F5'],
                duration: 400,
                wrpClass: 'circles-wrp',
                textClass: 'circles-text',
                styleWrapper: true,
                styleText: true
            })

            Circles.create({
                id: 'circles-inventario',
                radius: 45,
                value: {{ $IngresoCount }},
                maxValue: 100,
                width: 7,
                text: function() {
                    return {{ $IngresoCount }};
                },
                colors: ['#f1f1f1', '#33A4F5'],
                duration: 400,
                wrpClass: 'circles-wrp',
                textClass: 'circles-text',
                styleWrapper: true,
                styleText: true
            })

            Circles.create({
                id: 'circles-devolucion',
                radius: 45,
                value: {{ $DevolucionCount }},
                maxValue: 100,
                width: 7,
                text: function() {
                    return {{ $DevolucionCount }};
                },
                colors: ['#f1f1f1', '#33A4F5'],
                duration: 400,
                wrpClass: 'circles-wrp',
                textClass: 'circles-text',
                styleWrapper: true,
                styleText: true
            })


            var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');

            var mytotalIncomeChart = new Chart(totalIncomeChart, {
                type: 'bar',
                data: {
                    labels: ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sabado", "Domingo"],
                    datasets: [{
                        label: "Ingresos totales",
                        backgroundColor: '#ff9e27',
                        borderColor: 'rgb(23, 125, 255)',
                        data: [{{ $MondaySalesCount }}, {{ $TuesdaySalesCount }},
                            {{ $WednesSalesCount }}, {{ $ThursdaySalesCount }},
                            {{ $FirdaySalesCount }}, {{ $SaturdaySalesCount }},
                            {{ $SundaySalesCount }}
                        ]
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        display: false,
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                display: false //this will remove only the label
                            },
                            gridLines: {
                                drawBorder: false,
                                display: false
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                                drawBorder: false,
                                display: false
                            }
                        }]
                    },
                }
            });

            doughnutChart = document.getElementById('doughnutChart').getContext('2d');

            var myDoughnutChart = new Chart(doughnutChart, {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: [{{ $ComprasAutorizado }}, {{ $ComprasNoAutorizado }}],
                        backgroundColor: ['#59d05d', '#f3545d']
                    }],

                    labels: [
                        'COMPRAS AUTORIZADAS',
                        'COMPRAS NO AUTORIZADAS'
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        position: 'bottom'
                    },
                    layout: {
                        padding: {
                            left: 20,
                            right: 20,
                            top: 20,
                            bottom: 20
                        }
                    }
                }
            });

            multipleLineChart = document.getElementById('multipleLineChart').getContext('2d');

            var myMultipleLineChart = new Chart(multipleLineChart, {
                type: 'line',
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov",
                        "Dec"
                    ],
                    datasets: [{
                        label: "Ingresos",
                        borderColor: "#59d05d",
                        pointBorderColor: "#FFF",
                        pointBackgroundColor: "#59d05d",
                        pointBorderWidth: 2,
                        pointHoverRadius: 4,
                        pointHoverBorderWidth: 1,
                        pointRadius: 4,
                        backgroundColor: 'transparent',
                        fill: true,
                        borderWidth: 2,
                        data: [
                            {{ $VentaPorMeses->Enero }}, {{ $VentaPorMeses->Febrero }},
                            {{ $VentaPorMeses->Marzo }}, {{ $VentaPorMeses->Abril }},
                            {{ $VentaPorMeses->Mayo }}, {{ $VentaPorMeses->Junio }},
                            {{ $VentaPorMeses->Julio }}, {{ $VentaPorMeses->Agosto }},
                            {{ $VentaPorMeses->Septiembre }}, {{ $VentaPorMeses->Octubre }},
                            {{ $VentaPorMeses->Noviembre }}, {{ $VentaPorMeses->Diciembre }}
                        ]
                    }, {
                        label: "Gastos",
                        borderColor: "#f3545d",
                        pointBorderColor: "#FFF",
                        pointBackgroundColor: "#f3545d",
                        pointBorderWidth: 2,
                        pointHoverRadius: 4,
                        pointHoverBorderWidth: 1,
                        pointRadius: 4,
                        backgroundColor: 'transparent',
                        fill: true,
                        borderWidth: 2,
                        data: [{{ $CompraPorMeses->Enero }}, {{ $CompraPorMeses->Febrero }},
                            {{ $CompraPorMeses->Marzo }}, {{ $CompraPorMeses->Abril }},
                            {{ $CompraPorMeses->Mayo }}, {{ $CompraPorMeses->Junio }},
                            {{ $CompraPorMeses->Julio }}, {{ $CompraPorMeses->Agosto }},
                            {{ $CompraPorMeses->Septiembre }}, {{ $CompraPorMeses->Octubre }},
                            {{ $CompraPorMeses->Noviembre }}, {{ $CompraPorMeses->Diciembre }}
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        position: 'top',
                    },
                    tooltips: {
                        bodySpacing: 4,
                        mode: "nearest",
                        intersect: 0,
                        position: "nearest",
                        xPadding: 10,
                        yPadding: 10,
                        caretPadding: 10
                    },
                    layout: {
                        padding: {
                            left: 15,
                            right: 15,
                            top: 15,
                            bottom: 15
                        }
                    }
                }
            });

        });
    </script>
@endpush
@section('content')
    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-md-12">
                <div class="card full-height">
                    <div class="card-body text-center">
                        <h2>{{ __('stadistics.income.title') }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="card-header">
                        <div class="card-title">{{ __('stadistics.sale.day.title') }}</div>
                        <div class="card-category">{{ \Carbon\Carbon::now()->locale('es')->isoFormat('DD [de] MMMM') }}
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <div class="mb-4 mt-2">
                            <h1>{{ $DailySale }}</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="card-header">
                        <div class="card-title">{{ __('stadistics.sale.week.title') }}</div>
                        <div class="card-category">
                            {{ \Carbon\Carbon::now()->locale('es')->subDays(8)->isoFormat('DD [de] MMMM') }} -
                            {{ \Carbon\Carbon::now()->locale('es')->subDays(2)->isoFormat('DD [de] MMMM') }}</div>
                    </div>
                    <div class="card-body pb-0">
                        <div class="mb-4 mt-2">
                            <h1>{{ $DailySaleLast }}</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="card-header">
                        <div class="card-title">{{ __('stadistics.sale.month.title') }}</div>
                        <div class="card-category">
                            {{ \Carbon\Carbon::now()->locale('es')->startOfMonth()->isoFormat('DD [de] MMMM') }} -
                            {{ \Carbon\Carbon::now()->locale('es')->endOfMonth()->isoFormat('DD [de] MMMM') }}</div>
                    </div>
                    <div class="card-body pb-0">
                        <div class="mb-4 mt-2">
                            <h1>{{ $SaleMonth }}</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card full-height">
                    <div class="card-body">
                        <div class="row py-3">
                            <div class="col-md-4 d-flex flex-column justify-content-around">
                                <div>
                                    <h6 class="fw-bold text-uppercase text-success op-8">{{ __('stadistics.sale.day.total') }}</h6>
                                    <h3 class="fw-bold">{{ $total_ingresos }}</h3>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-uppercase text-danger op-8">{{ __('stadistics.sale.day.expenses') }}</h6>
                                    <h3 class="fw-bold">{{ $total_gastos }}</h3>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div id="chart-container">
                                    <canvas id="totalIncomeChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">{{ __('stadistics.orders.buys') }}</div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="doughnutChart" style="width: 50%; height: 50%"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">{{ __('stadistics.sales.and.expenses') }}</div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="multipleLineChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-md-12">
                <div class="card full-height">
                    <div class="card-body text-center">
                        <h2>{{ __('stadistics.inventory.return.inventory') }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-6">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="card-title">{{ __('stadistics.income.inventory') }}</div>
                        <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                            <div class="px-2 pb-2 pb-md-0 text-center">
                                <div id="circles-inventario"></div>
                                <h6 class="fw-bold mt-3 mb-0">{{ __('stadistics.income.total.inventory') }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-6">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="card-title">{{ __('stadistics.return.inventory') }}</div>
                        <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                            <div class="px-2 pb-2 pb-md-0 text-center">
                                <div id="circles-devolucion"></div>
                                <h6 class="fw-bold mt-3 mb-0">{{ __('stadistics.return.total.inventory') }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-md-12">
                <div class="card full-height">
                    <div class="card-body text-center">
                        <h2>{{ __('stadistics.products.category.labels') }}</h2>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card full-height">
                    <div class="card-body">
                        <div class="card-title">{{ __('stadistics.products.total') }}</div>
                        <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                            <div class="px-2 pb-2 pb-md-0 text-center">
                                <div id="circles-Productos"></div>
                                <h6 class="fw-bold mt-3 mb-0">{{ __('stadistics.products.now') }}</h6>
                            </div>
                            <div class="px-2 pb-2 pb-md-0 text-center">
                                <div id="circles-Activos"></div>
                                <h6 class="fw-bold mt-3 mb-0">{{ __('stadistics.products.actived') }}</h6>
                            </div>
                            <div class="px-2 pb-2 pb-md-0 text-center">
                                <div id="circles-Suspendidos"></div>
                                <h6 class="fw-bold mt-3 mb-0">{{ __('stadistics.products.suspended') }}</h6>
                            </div>
                            <div class="px-2 pb-2 pb-md-0 text-center">
                                <div id="circles-Cancelados"></div>
                                <h6 class="fw-bold mt-3 mb-0">{{ __('stadistics.products.canceled') }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card full-height">
                    <div class="card-body">
                        <div class="card-title">{{ __('stadistics.total.cagetory.labels') }}</div>
                        <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                            <div class="px-2 pb-2 pb-md-0 text-center">
                                <div id="circles-Categorias"></div>
                                <h6 class="fw-bold mt-3 mb-0">{{ __('stadistics.category') }}</h6>
                            </div>
                            <div class="px-2 pb-2 pb-md-0 text-center">
                                <div id="circles-Etiquetas"></div>
                                <h6 class="fw-bold mt-3 mb-0">{{ __('stadistics.labels') }}</h6>
                            </div>
                            <div class="px-2 pb-2 pb-md-0 text-center">
                                <div id="circles-factory"></div>
                                <h6 class="fw-bold mt-3 mb-0">{{ __('stadistics.manufactory') }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
