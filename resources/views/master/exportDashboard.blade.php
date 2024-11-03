@extends('layouts.export-dashboard-app')
@section('content')
<br><br><br>
<script>
    window.print()
</script>
<br><br>
<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
<section class="">

              <div class="container-fluid">    
                <div class="card">
                  <div class="card-header">
                    <h4>Kapal Naik Per Hari Bulan {{$departureShipsMonthText}}</h4>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-4">
                     
                      </div>
                    </div>
                    <div id="myPlot2" style=""></div>
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
                        </div>
                    </div>
                    <div id="myPlot3" style=""></div>
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
             

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
             
                <div class="card">
                  <div class="card-header">
                    <h4>Penumpang Naik Per Hari Bulan {{$departurePassengersMonthText}}</h4>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-4">
                        </div>
                    </div>
                    <div id="myPlot5" style=""></div>
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
                        </div>
                    </div>
                    <div id="myPlot6" style=""></div>
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



            <br><br><br><br>
            <br><br><br><br>
            <br><br><br><br>
            <br><br><br><br>
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
                    <div id="myPlot7" style=""></div>
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