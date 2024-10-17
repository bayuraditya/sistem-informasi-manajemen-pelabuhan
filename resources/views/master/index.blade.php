@extends('layouts.admin-app')
@section('content')
<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

<section class="row">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                  <div class="card">
                      <div class="card-body px-4 py-4-5">
                        <div class="row">
                          <div class=" d-flex justify-content-start">
                            <div class="stats-icon purple mb-2" style="width: 45px; height: 45px">
                              <i class="fa-solid fa-chart-pie"></i>
                            </div>
                          </div>
                          <div class="">
                            <h6 class="text-muted font-semibold">Rata-Rata Kapal Naik</h6>
                            <div class="d-inline-flex">
                              <h6 class="font-extrabold mb-0">343 </h6>
                              <h6 class="text-muted font-semibold"> &nbsp /hari</h6>
                          </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                  <div class="card">
                    <div class="card-body px-4 py-4-5">
                      <div class="row">
                        <div class=" d-flex justify-content-start">
                          <div class="stats-icon purple mb-2" style="width: 45px; height: 45px">

                            <!-- <i class="iconly-boldShow"></i> -->
                            <i class="fa-solid fa-chart-pie"></i>
                          </div>
                        </div>
                        <div class="">
                          <h6 class="text-muted font-semibold">Rata-Rata Kapal Turun</h6>
                          <div class="d-inline-flex">
                            <h6 class="font-extrabold mb-0">503 </h6>
                            <h6 class="text-muted font-semibold"> &nbsp /hari</h6>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                  <div class="card">
                    <div class="card-body px-4 py-4-5">
                      <div class="row">
                        <div class="d-flex justify-content-start">
                        <div class="stats-icon purple mb-2">
                            <i class="fa-solid fa-chart-pie"></i>
                          </div>
                        </div>
                        <div class="">
                          <h6 class="text-muted font-semibold">Rata-Rata Penumpang Naik</h6>
                          <div class="d-inline-flex">
                            <h6 class="font-extrabold mb-0">32</h6>
                            <h6 class="text-muted font-semibold"> &nbsp /hari</h6>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                  <div class="card">
                    <div class="card-body px-4 py-4-5">
                      <div class="row">
                        <div class="d-flex justify-content-start">
                        <div class="stats-icon purple mb-2">
                            <i class="fa-solid fa-chart-pie"></i>
                          </div>
                        </div>
                        <div class="">
                          <h6 class="text-muted font-semibold">Rata-Rata Penumpang Turun</h6>
                          <div class="d-inline-flex">
                            <h6 class="font-extrabold mb-0">123 </h6>
                            <h6 class="text-muted font-semibold"> &nbsp /hari</h6>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="row">
              <div class="col-4">    
                <div class="card">
                  <div class="card-header">
                    <h4>Realisation Breakdown</h4>
                  </div>
                  <div class="card-body">
                    <div id="myPlot" style="width:100%;max-width:700px"></div>
                    <script>
                    const xArray = ["departure","arrive"];
                    const yArray = [55, 49];
                    const layout = {title:"Realisation Breakdown"};
                    const data = [{labels:xArray, values:yArray, type:"pie"}];
                    Plotly.newPlot("myPlot", data, layout);
                    </script>
                  </div>
                </div>
              </div>
              <div class="col-8">    
                <div class="card">
                  <div class="card-header">
                    <h4>Kapal Naik Per Hari</h4>
                  </div>
                  <div class="card-body">
                    <div id="myPlot2" style="width:100%;max-width:700px"></div>
                    <script>
                      let xArray2 = [];
                      let yArray2 = [];

                      for (let i = 1; i <= 31; i++) {
                        xArray2.push(i);
                      }
                    
                      for (let j = 1; j <= 31;j++) {
                        function getRandomNumber(min, max) {
                          return Math.floor(Math.random() * (max - min + 1)) + min;
                        }
                        let randomNum = getRandomNumber(10, 100);
                        yArray2.push(randomNum);
                      }

                      const data2 = [{
                        x:xArray2,
                        y:yArray2,
                        type:"bar"
                      }];
                      const layout2 = {title:"Kapal Naik Per Hari"};
                      Plotly.newPlot("myPlot2", data2, layout2);
                    </script>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-8">    
                <div class="card">
                  <div class="card-header">
                    <h4>Kapal Turun Per Hari</h4>
                  </div>
                  <div class="card-body">
                    <div id="myPlot3" style="width:100%;max-width:700px"></div>
                    <script>
                      const xArray3 = ["Italy", "France", "Spain", "USA", "Argentina"];
                      const yArray3 = [55, 49, 44, 24, 15];
                      const data3 = [{
                        x:xArray3,
                        y:yArray3,
                        type:"bar"
                      }];
                      const layout3 = {title:"Kapal Turun Per Hari"};
                      Plotly.newPlot("myPlot3", data3, layout3);
                    </script>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-4">    
                <div class="card">
                  <div class="card-header">
                    <h4>Penumpang</h4>
                  </div>
                  <div class="card-body">
                    <div id="myPlot4" style="width:100%;max-width:700px"></div>
                    <script>
                      const xArray4 = ["departure","arrive"];
                      const yArray4 = [55, 49];
                      const layout4 = {title:"Penumpang"};
                      const data4 = [{labels:xArray4, values:yArray4, type:"pie"}];
                      Plotly.newPlot("myPlot4", data4, layout4);
                    </script>
                  </div>
                </div>
              </div>
              <div class="col-8">    
                <div class="card">
                  <div class="card-header">
                    <h4>Penumpang Naik Per Hari</h4>
                  </div>
                  <div class="card-body">
                  <div id="myPlot5" style="width:100%;max-width:700px"></div>
                    <script>
                      const xArray5 = ["Italy", "France", "Spain", "USA", "Argentina"];
                      const yArray5 = [55, 49, 44, 24, 15];
                      const data5 = [{
                        x:xArray5,
                        y:yArray5,
                        type:"bar"
                      }];
                      const layout5 = {title:"Penumpang Naik Per Hari"};
                      Plotly.newPlot("myPlot5", data5, layout5);
                    </script>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-8">    
                <div class="card">
                  <div class="card-header">
                    <h4>Penumpang Turun Per Hari</h4>
                  </div>
                  <div class="card-body">
                    <div id="myPlot6" style="width:100%;max-width:700px"></div>
                    <script>
                      const xArray6 = ["Italy", "France", "Spain", "USA", "Argentina"];
                      const yArray6 = [55, 49, 44, 24, 15];
                      const data6 = [{
                        x:xArray6,
                        y:yArray6,
                        type:"bar"
                      }];
                      const layout6 = {title:"Penumpang Turun Per Hari"};
                      Plotly.newPlot("myPlot6", data6, layout6);
                    </script>
                  </div>
                </div>
              </div>
            </div>
    </section>

@endsection