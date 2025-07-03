@extends('layouts.export-admin-app')
@section('content')

<br><br>
<style>
  @media print {
    @page {
      size: landscape;
      margin: ; /* Margin kecil agar ruang cetak lebih besar */
    }

    body {
      transform: ; /* Skala untuk mengecilkan konten */
      transform-origin: top left;
    }

    table {
      page-break-inside: auto;
      width: ; /* Pastikan tabel tidak melewati batas *
    }
    tr {
      page-break-inside: avoid;
    }
    thead {
      display: table-header-group; /* Header tabel muncul di tiap halaman */
    }
  }
</style>
<script>
    window.print()
</script>
<div class="d-flex justify-content-center align-items-center" >
  <img src="{{ asset('images/kop.png') }}" style="width:1600px" class="img-fluid" alt="Image">
</div>
<br><br>
<h3 class="text-center text-dark">DATA PASSENGER</h3>
<br>
        <h4>Date : {{$date}}</h4>
        <div class="">

            <table class="table " id="">
                <thead>
                <tr>
                    <td>No</td>
                    <td>Date</td>
                    <td>Ship</td>
                    <td>Departure route</td>
                    <td>Departure time</td>
                    <td>Departure passenger</td>
                    <td>Departure passenger retribution</td>
                    <td>Retribution</td>
                    <td>Arrival route</td>
                    <td>Arrival time</td>
                    <td>Arrival passenger</td>
                    <td>Penginput passenger</td>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($passenger as $p)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>
                        {{date('d F Y', strtotime($p->date));}}
                    </td>
                    <td>{{$p->ship->name}}</td>
                    <td>{{$p->ship->departureRoute->route}}</td>
                    <td>{{$p->ship->departure_time}}</td>
                    <td>{{$p->departure_passenger}}</td>
                    <td>{{$p->departure_passenger_retribution}}</td>
                    <td>{{$p->retribution}}</td>
                    <td>{{$p->ship->arrivalRoute->route}}</td>
                    <td>{{$p->ship->arrival_time}}</td>
                    <td>{{$p->arrival_passenger}}</td>
                    <td>{{$p->passengerUser->name}}</td>
                    <!-- role: master, operator-passenger -->
                   
                </tr>
                @endforeach
                <tr>
                <td>Total</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{$totalDeparturePassengers}} </td>
                <td>{{$totalDeparturePassengerRetribution}} </td>
                <td>{{$totalRetribution}} </td>
                <td></td>
                <td></td>
                <td>{{$totalArrivalPassengers}} </td>
                <td></td>
                <td></td>
            </tr>
            </tbody>
        </table>
  
    </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS (CDN) -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    // Inisialisasi DataTables
    $(document).ready(function() {
        $('#tablePassenger').DataTable();
    });
</script>

@endsection