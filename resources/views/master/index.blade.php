@extends('layouts.admin-app')
@section('content')
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exportDashboard">
  Cetak Laporan
</button>

<!-- Button Export Dashboard -->
<button type="button" class="btn btn-success ms-2" data-bs-toggle="modal" data-bs-target="#exportDashboardExcel">
  <i class="fas fa-file-excel"></i> Export Dashboard
</button>

<!-- Modal -->
<div class="modal fade" id="exportDashboard" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Cetak Laporan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="master/export" target="_blank" method="get">
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Pilih Bulan Data Kapal Naik</label>
            <input type="month" class="form-control" id="departureShipsMonth" name="departureShipsMonth"  value="{{$departureShipsMonth}}">
          </div>
          
          <div class="mb-3">
           <label for="exampleInputEmail1" class="form-label">Pilih Bulan Data Kapal Turun</label>
           <input type="month" class="form-control" id="arrivalShipsMonth" name="arrivalShipsMonth" value="{{$arrivalShipsMonth}}">
          </div>
          
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Pilih Bulan Data Penumpang Naik</label>
            <input type="month" class="form-control" id="departurePassengersMonth" name="departurePassengersMonth" value="{{$departurePassengersMonth}}">
          </div>
          
          <div class="mb-3">
             <label for="exampleInputEmail1" class="form-label">Pilih Bulan Data Penumpang Turun</label>
             <input type="month" class="form-control" id="arrivalPassengersMonth" name="arrivalPassengersMonth" value="{{$arrivalPassengersMonth}}">
          </div>
          
          <button class="btn btn-primary" type="submit" >Cetak</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Export Dashboard Excel -->
<div class="modal fade" id="exportDashboardExcel" tabindex="-1" aria-labelledby="exportDashboardExcelLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exportDashboardExcelLabel">Export Dashboard</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="exportDashboardForm" action="{{ route('master.export-excel') }}" method="POST">
          @csrf

          <!-- Pilihan Periode -->
          <div class="mb-3">
            <label class="form-label fw-bold">Pilih Periode</label>
            <div class="btn-group w-100" role="group">
              <input type="radio" class="btn-check" name="period_type" value="monthly" id="periodMonthly" checked>
              <label class="btn btn-outline-primary" for="periodMonthly">
                <i class="fas fa-calendar-alt"></i> Bulan Spesifik
              </label>

              <input type="radio" class="btn-check" name="period_type" value="yearly" id="periodYearly">
              <label class="btn btn-outline-primary" for="periodYearly">
                <i class="fas fa-calendar"></i> Tahun Penuh
              </label>
            </div>
          </div>

          <!-- Filter Bulan -->
          <div class="mb-3" id="monthlyFilter">
            <label for="month" class="form-label">Pilih Bulan & Tahun</label>
            <input type="month" class="form-control" id="month" name="month" value="{{ date('Y-m') }}">
            <small class="form-text text-muted">Data akan di-export untuk bulan yang dipilih saja</small>
          </div>

          <!-- Filter Tahun -->
          <div class="mb-3" id="yearlyFilter" style="display:none;">
            <label for="year" class="form-label">Pilih Tahun</label>
            <select class="form-select" id="year" name="year">
              @for($y = date('Y'); $y >= 2020; $y--)
                <option value="{{ $y }}">{{ $y }}</option>
              @endfor
            </select>
            <small class="form-text text-muted">Data akan di-export untuk seluruh tahun yang dipilih</small>
          </div>

          <!-- Pilihan Sheet -->
          <div class="mb-3">
            <label class="form-label fw-bold">Pilih Data yang Ingin Di-export</label>
            <div class="card">
              <div class="card-body">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="sheet" id="sheetSummary" value="summary" checked>
                  <label class="form-check-label" for="sheetSummary">
                    <strong>Summary</strong> - Statistik utama (total kapal, penumpang, rata-rata)
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="sheet" id="sheetShipsDaily" value="ships_daily">
                  <label class="form-check-label" for="sheetShipsDaily">
                    <strong>Kapal Harian</strong> - Data kapal naik/turun per hari
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="sheet" id="sheetPassengersDaily" value="passengers_daily">
                  <label class="form-check-label" for="sheetPassengersDaily">
                    <strong>Penumpang Harian</strong> - Data penumpang naik/turun + retribusi per hari
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="sheet" id="sheetPerShip" value="per_ship">
                  <label class="form-check-label" for="sheetPerShip">
                    <strong>Per Kapal</strong> - Total penumpang per nama kapal
                  </label>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          <i class="fas fa-times"></i> Batal
        </button>
        <button type="submit" form="exportDashboardForm" class="btn btn-success">
          <i class="fas fa-download"></i> Export Excel
        </button>
      </div>
    </div>
  </div>
</div>

<br><br>
<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
<section class="row">
<div class="row">
  <!-- Card 1 -->
  <div class="col-12 col-sm-6 col-lg-3 mb-3">
    <div class="card h-100">
      <div class="card-body d-flex flex-column align-items-center text-center">
        <div class="stats-icon purple mb-2" style="width: 45px; height: 45px;">
          <i class="fa-solid fa-chart-pie"></i>
        </div>
        <h6 class="text-muted font-semibold">Rata-Rata Kapal Naik</h6>
        <div class="d-inline-flex">
          <h6 class="font-extrabold mb-0">{{$averageShipsDeparture}}</h6>
          <h6 class="text-muted font-semibold">&nbsp;/hari</h6>
        </div>
      </div>
    </div>
  </div>

  <!-- Card 2 -->
  <div class="col-12 col-sm-6 col-lg-3 mb-3">
    <div class="card h-100">
      <div class="card-body d-flex flex-column align-items-center text-center">
        <div class="stats-icon purple mb-2" style="width: 45px; height: 45px;">
          <i class="fa-solid fa-chart-pie"></i>
        </div>
        <h6 class="text-muted font-semibold">Rata-Rata Kapal Turun</h6>
        <div class="d-inline-flex">
          <h6 class="font-extrabold mb-0">{{$averageShipsArrival}}</h6>
          <h6 class="text-muted font-semibold">&nbsp;/hari</h6>
        </div>
      </div>
    </div>
  </div>

  <!-- Card 3 -->
  <div class="col-12 col-sm-6 col-lg-3 mb-3">
    <div class="card h-100">
      <div class="card-body d-flex flex-column align-items-center text-center">
        <div class="stats-icon purple mb-2" style="width: 45px; height: 45px;">
          <i class="fa-solid fa-chart-pie"></i>
        </div>
        <h6 class="text-muted font-semibold">Rata-Rata Penumpang Naik</h6>
        <div class="d-inline-flex">
          <h6 class="font-extrabold mb-0">{{$averagePassengersDeparture}}</h6>
          <h6 class="text-muted font-semibold">&nbsp;/hari</h6>
        </div>
      </div>
    </div>
  </div>

  <!-- Card 4 -->
  <div class="col-12 col-sm-6 col-lg-3 mb-3">
    <div class="card h-100">
      <div class="card-body d-flex flex-column align-items-center text-center">
        <div class="stats-icon purple mb-2" style="width: 45px; height: 45px;">
          <i class="fa-solid fa-chart-pie"></i>
        </div>
        <h6 class="text-muted font-semibold">Rata-Rata Penumpang Turun</h6>
        <div class="d-inline-flex">
          <h6 class="font-extrabold mb-0">{{$averagePassengersArrival}}</h6>
          <h6 class="text-muted font-semibold">&nbsp;/hari</h6>
        </div>
      </div>
    </div>
  </div>
</div>





           <div class="container">
  <div class="row">
    <div class="col-12 col-md-6 mb-4">    
      <div class="card">
        <div class="card-header">
          <h4>Realisation Breakdown</h4>
        </div>
        <div class="card-body">
          <div id="myPlot" style="overflow-x: auto;       /* Memungkinkan scroll horizontal */
  overflow-y: hidden;     /* Menghindari scroll vertikal */
  white-space: nowrap;"></div>
          <script>
            const xArray = ["Departure","Arrive"];
            const yArray = [{{$totalShipsDeparture}},{{$totalShipsArrival}}];
            const layout = {title:"Realisation Breakdown"};
            const data = [{labels:xArray, values:yArray, type:"pie"}];
            Plotly.newPlot("myPlot", data, layout);
          </script>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6 mb-4">    
      <div class="card">
        <div class="card-header">
          <h4>Penumpang</h4>
        </div>
        <div class="card-body">
          <div id="myPlot4" style="overflow-x: auto;       /* Memungkinkan scroll horizontal */
  overflow-y: hidden;     /* Menghindari scroll vertikal */
  white-space: nowrap; "></div>
          <script>
            const xArray4 = ["Departure","Arrival"];
            const yArray4 = [{{$totalPassengersDeparture}},{{$totalPassengersArrival}}];
            const layout4 = {title:"Penumpang"};
            const data4 = [{labels:xArray4, values:yArray4, type:"pie"}];
            Plotly.newPlot("myPlot4", data4, layout4);
          </script>
        </div>
      </div>
    </div>
  </div>
</div>



              <div class="container-fluid">    
                <div class="card">
                  <div class="card-header">
                    <h4>Kapal Naik Per Hari Bulan {{$departureShipsMonthText}}</h4>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-4">
                        <form method="get" action="">
                          <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Pilih Bulan</label>
                            <input type="month" class="form-control" id="departureShipsMonth" name="departureShipsMonth"  value="{{$departureShipsMonth}}">
                          </div>
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                      </div>
                    </div>
                    <div id="myPlot2" class="" style="overflow-x: auto;       /* Memungkinkan scroll horizontal */
  overflow-y: hidden;     /* Menghindari scroll vertikal */
  white-space: nowrap;"></div>
                    <script>
                      let xArray2 = [];//label
                      let yArray2 = [];//nilai
                      for (let i = 1; i <= 31; i++) {
                        xArray2.push(i);
                      }
                      @foreach( $allDepartureShips as $ds)
                        yArray2.push({{$ds}});
                      @endforeach
                      const data2 = [{
                        x:xArray2,
                        y:yArray2,
                        type:"bar"
                      }];
                      const layout2 = {title:"Kapal Naik Per Hari Bulan {{$departureShipsMonthText}}"};
                      Plotly.newPlot("myPlot2", data2, layout2);
                    </script>
                  </div>
                </div>
              </div>



              
                <div class="card">
                  <div class="card-header">
                    <h4>Kapal Turun Per Hari Bulan {{$arrivalShipsMonthText}}</h4>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-4">
                        <form method="get" action="">
                          <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Pilih Bulan</label>
                            <input type="month" class="form-control" id="arrivalShipsMonth" name="arrivalShipsMonth" value="{{$arrivalShipsMonth}}">
                          </div>
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                      </div>
                    </div>
                    <div id="myPlot3" style="overflow-x: auto;       /* Memungkinkan scroll horizontal */
  overflow-y: hidden;     /* Menghindari scroll vertikal */
  white-space: nowrap;"></div>
                    <script>
                      let xArray3 = [];//label
                      let yArray3 = [];//nilai
                      for (let i = 1; i <= 31; i++) {
                        xArray3.push(i);
                      }
                      @foreach( $allArrivalShips as $as)
                        yArray3.push({{$as}});
                        
                      @endforeach
                      const data3 = [{
                        x:xArray3,
                        y:yArray3,
                        type:"bar"
                      }];
                      const layout3 = {title:"Kapal Turun Per Hari Bulan {{$arrivalShipsMonthText}}"};
                      Plotly.newPlot("myPlot3", data3, layout3);
                    </script>
                  </div>
                </div>
             


             
                <div class="card">
                  <div class="card-header">
                    <h4>Penumpang Naik Per Hari Bulan {{$departurePassengersMonthText}}</h4>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-4">
                        <form method="get" action="/master">
                          <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Pilih Bulan</label>
                            <input type="month" class="form-control" id="departurePassengersMonth" name="departurePassengersMonth" value="{{$departurePassengersMonth}}">
                          </div>
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                      </div>
                    </div>
                    <div id="myPlot5" style="overflow-x: auto;       /* Memungkinkan scroll horizontal */
  overflow-y: hidden;     /* Menghindari scroll vertikal */
  white-space: nowrap;"></div>
                    <script>
                    // Define xValues from 1 to 31
                    const xValues = Array.from({ length: 31 }, (_, i) => i + 1);

                    // Generate y1Values with random numbers between 20 and 40
                    const y1Values = [];
                    @foreach($allDeparturePassengersRetribution as $dpr)
                      y1Values.push({{$dpr}});
                    @endforeach
                    
                    // Generate y2Values with random numbers between 30 and 50
                    const y2Values = [];
                    @foreach($allDeparturePassengers as $dp)
                      y2Values.push({{$dp}});
                    @endforeach
                    // Define Data
                    const data5 = [
                      { x: xValues, y: y1Values, mode: "marker", name: "passengers" },
                      { x: xValues, y: y2Values, mode: "marker", name: "passangers retribution" }
                    ];

                    // Define Layout
                    const layout5 = { title: "Penumpang Naik per hari bulan {{$departurePassengersMonthText}}" };

                    // Display using Plotly
                    Plotly.newPlot("myPlot5", data5, layout5);
                  </script>
                  </div>
                </div>
           





            
                <div class="card">
                  <div class="card-header">
                    <h4>Penumpang Turun Per Hari Bulan {{$arrivalPassengersMonthText}}</h4>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-4">
                        <form method="get" action="/master">
                          <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Pilih Bulan</label>
                            <input type="month" class="form-control" id="arrivalPassengersMonth" name="arrivalPassengersMonth" value="{{$arrivalPassengersMonth}}">
                          </div>
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                      </div>
                    </div>
                    <div id="myPlot6" style="overflow-x: auto;       /* Memungkinkan scroll horizontal */
  overflow-y: hidden;     /* Menghindari scroll vertikal */
  white-space: nowrap;"></div>
                    <script>
                      let xArray6 = [];//label
                      let yArray6 = [];//nilai
                      for (let i = 1; i <= 31; i++) {
                        xArray6.push(i);
                      }
                      
                      @foreach( $allArrivalPassengers as $ap)
                        yArray6.push({{$ap}});
                        
                      @endforeach
                      

                      const data6 = [{
                        x:xArray6,
                        y:yArray6,
                        type:"bar"
                      }];
                      const layout6 = {title:"Penumpang Turun Per Hari Bulan {{$arrivalPassengersMonthText}}"};
                      Plotly.newPlot("myPlot6", data6, layout6);
                    </script>
                  </div>
                </div>



            
                <div class="card">
                  <div class="card-header">
                    <h4>Data Penumpang Per kapal</h4>
                    <p id="tes"></p>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="">
                     
                      </div>
                    </div> 
                    <div id="myPlot7" style="overflow-x: auto;       /* Memungkinkan scroll horizontal */
  overflow-y: hidden;     /* Menghindari scroll vertikal */
  white-space: nowrap;"></div>
                    <script>
                      let xArray7 = [];//label: ship
                      let yArray7 = [];//nilai: jumlah penumpang
                      @foreach($ships as $s)
                        xArray7.push("{{$s['name']}}");
                        yArray7.push({{$s['totalPassenger']}});

                      @endforeach

                      const data7 = [{
                        x:xArray7,
                        y:yArray7,
                        type:"bar"
                      }];
                      const layout7 = {title:"Data Penumpang Per Kapal"};
                      Plotly.newPlot("myPlot7", data7, layout7);
                    </script>
                  </div>
                </div>
             




    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS (CDN) -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    // Inisialisasi DataTables
    $(document).ready(function() {
        $('#tablePassenger').DataTable();
    });

    // Toggle filter berdasarkan period_type untuk export dashboard
    $('input[name="period_type"]').change(function() {
        if ($(this).val() == 'monthly') {
            $('#monthlyFilter').slideDown();
            $('#yearlyFilter').slideUp();
            $('#month').prop('required', true);
            $('#year').prop('required', false);
        } else {
            $('#monthlyFilter').slideUp();
            $('#yearlyFilter').slideDown();
            $('#month').prop('required', false);
            $('#year').prop('required', true);
        }
    });

    // Show loading state saat submit export
    $('#exportDashboardForm').submit(function() {
        const submitBtn = $(this).find('button[type="submit"]');
        submitBtn.html('<i class="fas fa-spinner fa-spin"></i> Memproses...');
        submitBtn.prop('disabled', true);
    });
</script>


@endsection