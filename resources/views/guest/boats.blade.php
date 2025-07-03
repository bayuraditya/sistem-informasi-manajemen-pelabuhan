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
                <div id="carouselExampleIndicators{{$b->id}}" class="carousel slide " data-bs-ride="carousel">
                                            <div class="carousel-inner ">
                                            @foreach($b->shipImages as $key => $i)
                                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                    <img src="{{ asset('images/' . $i->image) }}" class="" alt="Slide {{ $key + 1 }}" style="height:280px;width:500px; object-fit: cover;">
                                                </div>
                                            @endforeach 
                                            </div>
                                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators{{$b->id}}" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators{{$b->id}}" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>
                   
                <div class="card-body">
                    <h5 class="card-title">{{$b->name}}</h5>
                    <p class="card-text"></p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <h6>
                            Departure Route :
                        </h6>
                        <p>
                        {{$b->departureRoute->route}}
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
                          {{$b->arrivalRoute->route}}
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

