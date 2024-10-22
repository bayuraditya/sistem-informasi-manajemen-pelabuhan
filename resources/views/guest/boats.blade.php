@extends('layouts.app-menu')
@section('content')
<br><br>
<br><br>
<br><br>
<section>
    <div class="container">
        <div class="row">
            @foreach($boat as $b)
            <div class="col">
                <div class="card" style="width: 25rem;">
                    <img src="{{ asset('images/' . $b->ship_image) }}"  style="height:15rem;object-fit:cover;" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{$b->ship_name}}</h5>
                    <p class="card-text"></p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <h6>
                            Departure Route :
                        </h6>
                        <p>
                        {{$b->departure_route}}
                        </p>
                   </li>
                    <li class="list-group-item">
                    <h6>
                    Departure time :
                    </h6>         
                    <p>
                         {{$b->departure_time}}
                    </p>  
                    </li>
                    <li class="list-group-item">
                        <h6>
                            Arrival Route :
                        </h6>
                        <p>
                          {{$b->arrival_route}}
                        </p>
                    </li>
                    <li class="list-group-item">
                        <h6>
                        Arrival Time :
                        </h6>
                        <p>
                             {{$b->arrival_time}}
                        </p>
                    </li>
                    <li class="list-group-item">
                        <h6>
                            Type :
                        </h6>
                        <p>
                            {{$b->type}}
                        </p>
                    </li>
                    <li class="list-group-item">
                        <h6>
                            Operator :
                        </h6>
                        <p>
                            {{$b->operator->name}}
                        </p>
                    </li>
                </ul>
                <!-- <div class="card-body">
                    <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a>
                </div> -->
            </div><br><br>
        </div>
            @endforeach
        </div>
    </div>
</section><br><br><br>
<br><br><br>
<br><br><br>
@endsection

