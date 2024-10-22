<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Passengers</title>
    <style>
table, td, th {
  border: 1px solid;
}

table {
  width: 100%;
  border-collapse: collapse;
}
</style>
</head>
<body>
    <h2>Data Passangers</h2><br>
    <h3>Date : {{$date}}</h3>
    <table>
        <thead>
            <tr>
                <td>No</td>
                <td>Tanggal</td>
                <td>Ship</td>
                <td>Departure Passengers</td>
                <td>Arrival Passengers</td>
            </tr>
        </thead>
        <tbody>
            @foreach($passenger as $p)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$p->date}}</td>
                <td>{{$p->ship_name}}</td>
                <td>{{$p->departure_passenger}}</td>
                <td>{{$p->arrival_passenger}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>