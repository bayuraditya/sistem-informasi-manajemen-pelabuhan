@extends('layouts.admin-app')
@section('content')
<section class="row">
        <div class="">
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

                            <!-- <i class="iconly-boldShow"></i> -->
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

                            <!-- <i class="iconly-boldShow"></i> -->
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
                      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
                      <canvas id="myChart1" style="width:100%;max-width:600px"></canvas>
                      <script>
                        var xValues = ["Kapal Naik", "Kapal Turun",];
                        var yValues = [55,40];
                        var barColors = [
                          "#db9eff",
                          "#9e05f7",
                        ];

                        new Chart("myChart1", {
                          type: "pie",
                          data: {
                            labels: xValues,
                            datasets: [{
                              backgroundColor: barColors,
                              data: yValues
                            }]
                          },
                          options: {
                            title: {
                              display: true,
                              // text: "World Wide Wine Production 2018"
                            }
                          }
                        });
                      </script>
                    </div>
                  </div>
                </div>
              <div class="col-4">    
                <div class="card">
                    <div class="card-header">
                      <h4>Kapal Naik Per Hari</h4>
                    </div>
                    <div class="card-body">
                      <div id="">
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
                        <canvas id="myChart2" style="width:100%;max-width:600px"></canvas>
                        <script>
                          var xValues = ["1", "2", "3", "4", "5","1", "2", "3", "4", "5","1", "2", "3", "4", "5","1", "2", "3", "4", "5","1", "2", "3", "4", "5","1", "2", "3", "4", "5"];
                          var yValues = [55, 49, 44, 24, 15];
                          var barColors = ["#a32bc4", "#a32bc4","#a32bc4","#a32bc4","#a32bc4"];

                          new Chart("myChart2", {
                            type: "bar",
                            data: {
                              labels: xValues,
                              datasets: [{
                                backgroundColor: barColors,
                                data: yValues
                              }]
                            },
                            options: {
                              legend: {display: false},
                              title: {
                                display: true,
                                // text: "World Wine Production 2018"
                              }
                            }
                          });
                        </script>
                      </div>
                    </div>
                  </div>
                </div>
              <div class="col-4">    
                <div class="card">
                    <div class="card-header">
                      <h4>Kapal Turun Per Hari</h4>
                    </div>
                    <div class="card-body">
                      <div id="">
                      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

                      <canvas id="myChart3" style="width:100%;max-width:600px"></canvas>

                      <script>
                        // var xValues = ["1", "2", "3", "4", "5","1", "2", "3", "4", "5","1", "2", "3", "4", "5","1", "2", "3", "4", "5","1", "2", "3", "4", "5","1", "2", "3", "4", "5"];
                        var xValues = [];
                        for (var i = 1; i <= 30; i++) {
                                xValues.push(i.toString()); // Menambahkan angka ke dalam array sebagai string
                        }


                        var yValues = [];
                        for (var i = 1; i <= 30; i++) {
                            yValues.push(i.toString()); // Menambahkan angka ke dalam array sebagai string
                        }
                        var barColors = [];
                        for (var i = 1; i <= 30; i++) {
                          barColors.push('#a32bc4'); // Menambahkan angka ke dalam array sebagai string
                        }
                        new Chart("myChart3", {
                          type: "bar",
                          data: {
                            labels: xValues,
                            datasets: [{
                              backgroundColor: barColors,
                              data: yValues
                            }]
                          },
                          options: {
                            legend: {display: false},
                            title: {
                              display: true,
                              // text: "World Wine Production 2018"
                            }
                          }
                        });
                      </script>
                      </div>
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
                      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
                      <canvas id="myChart4" style="width:100%;max-width:600px"></canvas>
                      <script>
                        var xValues = ["Penumpang Naik", "Penumpang Turun",];
                        var yValues = [55,40];
                        var barColors = [
                          "#db9eff",
                          "#9e05f7",
                        ];

                        new Chart("myChart4", {
                          type: "pie",
                          data: {
                            labels: xValues,
                            datasets: [{
                              backgroundColor: barColors,
                              data: yValues
                            }]
                          },
                          options: {
                            title: {
                              display: true,
                              // text: "World Wide Wine Production 2018"
                            }
                          }
                        });
                      </script>
                    </div>
                  </div>
                </div>
              <div class="col-4">    
                <div class="card">
                    <div class="card-header">
                      <h4>Penumpang Naik Per Hari</h4>
                    </div>
                    <div class="card-body">
                      <div id="">
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
                        <canvas id="myChart5" style="width:100%;max-width:600px"></canvas>
                        <script>
                          var xValues = ["1", "2", "3", "4", "5","1", "2", "3", "4", "5","1", "2", "3", "4", "5","1", "2", "3", "4", "5","1", "2", "3", "4", "5","1", "2", "3", "4", "5"];
                          var yValues = [55, 49, 44, 24, 15];
                          var barColors = ["#a32bc4", "#a32bc4","#a32bc4","#a32bc4","#a32bc4"];

                          new Chart("myChart5", {
                            type: "bar",
                            data: {
                              labels: xValues,
                              datasets: [{
                                backgroundColor: barColors,
                                data: yValues
                              }]
                            },
                            options: {
                              legend: {display: false},
                              title: {
                                display: true,
                                // text: "World Wine Production 2018"
                              }
                            }
                          });
                        </script>
                      </div>
                    </div>
                  </div>
                </div>
              <div class="col-4">    
                <div class="card">
                    <div class="card-header">
                      <h4>Penumpang Turun Per Hari</h4>
                    </div>
                    <div class="card-body">
                      <div id="">
                      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

                      <canvas id="myChart6" style="width:100%;max-width:600px"></canvas>

                      <script>
                        // var xValues = ["1", "2", "3", "4", "5","1", "2", "3", "4", "5","1", "2", "3", "4", "5","1", "2", "3", "4", "5","1", "2", "3", "4", "5","1", "2", "3", "4", "5"];
                        var xValues = [];
                        for (var i = 1; i <= 30; i++) {
                                xValues.push(i.toString()); // Menambahkan angka ke dalam array sebagai string
                        }


                        var yValues = [];
                        for (var i = 1; i <= 30; i++) {
                            yValues.push(i.toString()); // Menambahkan angka ke dalam array sebagai string
                        }
                        var barColors = [];
                        for (var i = 1; i <= 30; i++) {
                          barColors.push('#a32bc4'); // Menambahkan angka ke dalam array sebagai string
                        }
                        new Chart("myChart6", {
                          type: "bar",
                          data: {
                            labels: xValues,
                            datasets: [{
                              backgroundColor: barColors,
                              data: yValues
                            }]
                          },
                          options: {
                            legend: {display: false},
                            title: {
                              display: true,
                              // text: "World Wine Production 2018"
                            }
                          }
                        });
                      </script>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
            
    </section>
@endsection