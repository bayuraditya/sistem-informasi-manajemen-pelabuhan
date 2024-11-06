@extends('layouts.admin-app')
@section('content')
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exportDashboard">
  Cetak Laporan
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
        <form action="master/export"  target="_blank" method="get">
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
                    const layout5 = { title: "Penumpang Naik per hari bulan ..." };

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
</script>

<script src="{{asset('assets/static/js/components/dark.js')}}"></script>
    <script src="{{asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>

    <script src="{{asset('assets/compiled/js/app.js')}}"></script>

    <script src="{{asset('assets/extensions/simple-datatables/umd/simple-datatables.js')}}"></script>
    <script src="{{asset('assets/static/js/pages/simple-datatables.js')}}"></script>
@endsection