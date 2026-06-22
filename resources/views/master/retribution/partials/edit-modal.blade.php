<!-- Modal -->
<div class="modal fade" id="edit_{{$passenger->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Retribusi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/master/retribution/{{$passenger->id}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Pilih Tanggal</label>
                        <input disabled type="date" class="form-control" id="date" name="date" value="{{$passenger->date}}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Pilih Kapal</label>
                        <select disabled name="ship" id="selectShip" class="form-select" aria-label="Default select example">
                            @foreach($ship as $s)
                            <option
                                @if($s->id == $passenger->ship_id)
                                    selected
                                @endif
                                value="{{$s->id}}" >{{$s->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Jumlah Penumpang Departure</label>
                        <input disabled name="departurePassenger" type="number" class="form-control" id="departurePassenger" value="{{$passenger->departure_passenger}}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Jumlah Penumpang Arrive</label>
                        <input disabled name="arrivalPassenger" type="number" class="form-control" id="arrivalPassenger" value="{{$passenger->arrival_passenger}}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Jumlah Penumpang Retribusi</label>
                        <input name="departurePassengerRetribution" type="number" class="form-control" id="departurePassengerRetribution_{{$passenger->id}}" value="{{$passenger->departure_passenger_retribution}}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Retribusi (penumpang retribusi x2500)</label>
                        <input readonly name="retribution" type="number" class="form-control" id="retribution_{{$passenger->id}}" value="{{$passenger->retribution}}" >
                    </div>
                    <script>
                    document.getElementById('departurePassengerRetribution_{{$passenger->id}}').addEventListener('input', function() {
                        // Ambil nilai dari input
                        let inputValue = parseFloat(this.value);

                        // Jika ada nilai input, kalikan 2500, jika kosong maka set 0
                        let result = inputValue ? inputValue * 2500 : 0;

                        // Tampilkan hasil pada input kedua
                        document.getElementById('retribution_{{$passenger->id}}').value = result;
                    });
                    </script>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Status Retribusi</label>
                        <select name="retributionStatus" id="retributionStatus" class="form-select" aria-label="Default select example">
                            <option
                                @if($passenger->retribution_status == 'lunas')
                                selected
                                @endif
                                value="lunas" >Lunas</option>
                            <option
                                @if($passenger->retribution_status == 'belum lunas')
                                selected
                                @endif
                                value="belum lunas" >belum Lunas</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>