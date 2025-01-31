@extends('back.app')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid ">
        <div id="kt_app_content_container" class="app-container  container-xxl ">
            <div class="col-xl-12 mb-5">
                <div class="card card-flush h-lg-100">
                    <div class="card-header pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-900">Statistik Pendaftar PPDB</span>
                        </h3>
                    </div>
                    <div class="card-body pt-0 px-0">
                        {{-- INI TEMPAT STAT NYA --}}
                        <div id="chart_1" class="px-5"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 mb-3">
                <div class="card card-flush">
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <h1 class="card-title">
                            Statistik Pendaftaran Peserta Didik Baru <span id="ta"> </span>
                        </h1>
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                            <div class="">
                                <select class="form-select form-select-solid" data-control="select2" data-hide-search="true"
                                    data-placeholder="Pilih Tahun Ajaran" id="school_year_select">
                                    {{-- <option></option> --}}
                                    @foreach ($list_school_year as $school_year)
                                        <option value="{{ $school_year->id }}">T.A
                                            {{ $school_year->start_year }}/{{ $school_year->end_year }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-5">
                <div class="row mb-5">
                    <div class="col-md-4 ">
                        <div class="card card-flush h-lg-100">
                            <div class="card-header pt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-gray-900">Statistik Pendaftar PPDB</span>
                                </h3>
                            </div>
                            <div class="card-body pt-0 px-0">
                                {{-- INI TEMPAT STAT NYA --}}
                                <div id="chart_register_pie" class="px-5"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 ">
                        <div class="card card-flush h-lg-100">
                            <div class="card-header pt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-gray-900">Statistik Jumlah Pendaftar Pada Jalur
                                        pendaftaran yang dipilih</span>
                                </h3>
                            </div>
                            <div class="card-body pt-0 px-0">
                                {{-- INI TEMPAT STAT NYA --}}
                                <div id="chart_register_bar" class="px-5"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var chart_1 = new ApexCharts(document.querySelector("#chart_1"), {
            series: [{
                name: 'Pendaftar',
                data: [0]
            }],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            stroke: {
                curve: 'straight'
            },
            title: {
                text: 'Pendaftar',
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'],
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: ['x'],
            }
        });
        chart_1.render();
        let register_stat = @json($register_stat);
        chart_1.updateSeries([{
            data: register_stat.map(function(item) {
                return item.total;
            }).reverse()
        }]);
        chart_1.updateOptions({
            xaxis: {
                categories: register_stat.map(function(item) {
                    return item.date;
                }).reverse()
            }
        });

        var chart_register_bar_option = {
            series: [{
                name: 'Pendaftar',
                data: [] // Contoh data jumlah inflasi
            }],
            chart: {
                height: 350,
                type: 'bar'
            },
            plotOptions: {
                bar: {
                    borderRadius: 10,
                    dataLabels: {
                        position: 'top'
                    }
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function(val, {
                    seriesIndex
                }) {
                    return val;
                },
                offsetY: -20,
                style: {
                    fontSize: '12px',
                    colors: ["#304758"]
                }
            },
            xaxis: {
                categories: [],
                position: 'top',
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                crosshairs: {
                    fill: {
                        type: 'gradient',
                        gradient: {
                            colorFrom: '#D8E3F0',
                            colorTo: '#BED1E6',
                            stops: [0, 100],
                            opacityFrom: 0.4,
                            opacityTo: 0.5,
                        }
                    }
                },
                tooltip: {
                    enabled: true,
                }
            },
            yaxis: [{
                opposite: true,
                title: {
                    text: "Jumlah Pendaftar"
                },
                labels: {
                    formatter: function(val) {
                        return val;
                    }
                }
            }],
            title: {
                text: 'Statistik Jumlah Pendaftar Pada Jalur pendaftaran yang dipilih',
                floating: true,
                offsetY: 330,
                align: 'center',
                style: {
                    color: '#444'
                }
            },
            legend: {
                position: 'right', // Menempatkan legenda di sisi kanan
                horizontalAlign: 'center' // Pusatkan posisi legenda di sisi kanan
            }
        };

        var chart_register_bar = new ApexCharts(document.querySelector("#chart_register_bar"), chart_register_bar_option);
        chart_register_bar.render();


        var chart_register_pie_options = {
            series: [], // Data inflasi dalam persen
            chart: {
                height: 350,
                type: 'pie'
            },
            labels: [], // Bulan
            title: {
                text: "presentase Pendaftar",
                align: 'center'
            },
            legend: {
                position: 'bottom',
                horizontalAlign: 'center'
            },
            dataLabels: {
                enabled: true,
                formatter: function(val) {
                    return val.toFixed(1) + "%"; // Tambahkan % pada setiap label
                }
            }
        };

        var chart_register_pie = new ApexCharts(document.querySelector("#chart_register_pie"), chart_register_pie_options);
        chart_register_pie.render();


        $('#school_year_select').on('change', function() {
            let school_year_id = $(this).val();
            $('#ta').text($('#school_year_select option:selected').text());
            $.ajax({
                url: "{{ route('back.dashboard.ppdb-stat') }}",
                data: {
                    school_year_id: school_year_id
                },
                type: 'GET',
                success: function(response) {
                    console.log(response);
                    chart_register_bar.updateOptions({
                        xaxis: {
                            categories: response.register_path_stat.map(function(item) {
                                return item.name;
                            })
                        }
                    });
                    chart_register_bar.updateSeries([{
                        data: response.register_path_stat.map(function(item) {
                            return item.total;
                        })
                    }]);
                    chart_register_bar.updateOptions({
                        title: {
                            text: 'Statistik Jumlah Pendaftar Pada Jalur pendaftaran yang dipilih',
                            floating: true,
                            offsetY: 330,
                            align: 'center',
                            style: {
                                color: '#444'
                            }
                        }
                    });

                    chart_register_pie.updateOptions({
                        series: response.register_path_stat.map(function(item) {
                            return item.total;
                        }),
                        labels: response.register_path_stat.map(function(item) {
                            return item.name;
                        })
                    });

                }
            });
        });

        $('#school_year_select').trigger('change');

    </script>
@endsection
