@extends('layouts.app')
@section('content')
    <section style="background-image: url('{{asset('images/Pelabuhan Serangan (2).jpeg')}}');background-size: cover;" id="jumbotron" class=" ">
        <div class="bg-dark bg-opacity-25">
            <br><br>
            <div class="container d-flex flex-column justify-content-center align-items-end py-5" style="">
                <div class="logo d-inline-flex ">
                    <i class="fa-solid fa-location-dot py-auto my-auto px-2" style="color: #fc8d02; font-size: 50px;"></i>
                    <h6 class="text-warning ">Pelabuhan <br> Serangan <br> Bali, Indonesia</h6>
                </div>
            </div>
        <br><br><br>
        <div class="container d-flex flex-column justify-content-center align-items-center " style="">
            <p class="fw-bold text-white text-center " style="font-size: 90px;">ISTANA LAUT</p>
            <h3 class="text-light text-center">Serve you With Our Best</h3>
            <br><br>
            <a href="#aboutUs">
                <button type="button" class="btn btn-lg btn-warning text-white mt-3">EXPLORE NOW</button>
            </a>
        </div>
            <br><br><br><br><br><br><br><br>
    </div>
    </section>
    <section id="aboutUs" class="bg-secondary-subtle">
    <div class="container">
        <br><br>
        <div class="row">
            <div class="col-12 col-md-5 order-1 order-md-2 text-center mb-4">
                <img src="{{asset('images/PATUNG ISTANA LAUT.jpg')}}" class="w-50 rounded" alt="Patung Istana Laut">
            </div>
            <div class="col-12 col-md-7 order-2 order-md-1">
                <div class="d-inline-flex align-items-center">
                    <h1 class="p-auto m-auto">
                        <i class="fa-solid fa-location-dot p-auto m-auto" style="color: #fc8d02;"></i>
                    </h1>
                    <h2 class="p-auto m-auto text-danger">&nbsp;ISTANA LAUT</h2>
                </div>
                <br><br>
                <h3 class="fw-bold">S<span class="text-danger">I</span>STEM INFORMA<span class="text-danger">S</span>I <span class="text-danger">T</span>ICKETING D<span class="text-danger">A</span>N MA<span class="text-danger">N</span>AJEMEN PENGELOLA<span class="text-danger">A</span>N PELABUHAN <span class="text-danger">LAUT</span></h3>
                <p style="text-align:justify"><br>
                We call it "ISTANA LAUT", Istana in Bahasa, means Palace. In the "Istana Laut" resides "God Baruna". In Hindu belief, Baruna controls the laws of nature called Reta. He rides a creature called makara, half crocodile half goat (sometimes makara is equated with a crocodile, or can also be described as a creature that is half goat half fish). His wife is named Baruni, the Goddess of the ocean, who lives in the pearl palace. By wise people, Dewa Baruna is also called the God of the sky, the Ruler of all waters, who controls all properties that are in the form of water, the God of Rain, and the god who controls the law.
                </p>
                <br>
                <div class="d-inline-flex">
                    <a href="#operators" class="me-2">
                        <button class="btn btn-warning">OPERATOR</button>
                    </a>
                    <a href="#boats">
                        <button class="btn btn-warning">BOATS</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <br><br>
</section>

  
<section class="bg-primary bg-opacity-75" id="boats">
<br><br>
    <div class="container">
        <h1 class="text-center fw-bold text-light">The Boats</h1> <br>
        <div class="row d-flex justify-content-center"> <!-- Tambahkan d-flex dan justify-content-center -->
            @foreach($ship as $s)
            <div class="col-md-4 d-flex justify-content-center py-1"> <!-- Tambahkan justify-content-center untuk setiap col -->
                <div class="card" style="width: 18rem;">
                <img src="{{ $s->shipImages->first() ? asset('images/' . $s->shipImages->first()->image) : asset('images/default.jpg') }}" class="card-img-top" style="height:11rem;object-fit:cover;" alt="...">

                    <div class="card-body">
                        <h4 class="card-title">{{$s->name}}</h4>
                        <h5 class="card-title">Start From IDR</h5><br>
                        <p class="card-text">Route : {{$s->departureRoute->route}} / {{$s->arrivalRoute->route}}</p>
                        <p class="card-text">Depart : {{$s->departure_time}}</p>
                        <p class="card-text">Arrive : {{$s->arrival_time}}</p>
                        <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ship{{$s->id}}">BOOK NOW</a>


                        <div class="modal modal fade " id="ship{{$s->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{$s->name}}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Carousel Bootstrap di Blade -->
                                        <div id="carouselExampleIndicators{{$s->id}}" class="carousel slide " data-bs-ride="carousel">
                                            <div class="carousel-inner ">
                                            @foreach($s->shipImages as $key => $i)
                                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                    <img src="{{ asset('images/' . $i->image) }}" class="" alt="Slide {{ $key + 1 }}" style="height: 300px;width:480px; object-fit: cover;">
                                                </div>
                                            @endforeach 
                                            </div>
                                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators{{$s->id}}" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators{{$s->id}}" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>
                                        <br>                                  
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                               <h6>
                                                Departure Route :
                                               </h6>  {{$s->departureRoute->route}}
                                            </li>
                                            <li class="list-group-item">
                                                <h6>
                                                    Departure Time :  
                                                </h6>
                                               {{$s->departure_time}}
                                            </li>
                                            <li class="list-group-item">
                                                <h6>
                                                      Arrival Route :
                                                </h6>
                                               {{$s->arrivalRoute->route}}
                                            </li>
                                            <li class="list-group-item">
                                                <h6>
                                                    Arrival Time :
                                                </h6>
                                                 {{$s->arrival_time}}
                                            </li>
                                            <li class="list-group-item">
                                               <h6>
                                                 Type :
                                               </h6>
                                    
                                                {{$s->type}}
                                            </li>
                                            <li class="list-group-item">
                                                <h6>
                                                    Operator : 
                                                </h6>
                                                {{$s->operator->name}}
                                            </li>
                                            <li class="list-group-item">
                                                <h6>
                                                       Handphone Number : 
                                                </h6>
                                             {{$s->operator->handphone_number}}
                                            </li>
                                            <li class="list-group-item">
                                                <h6>
                                                      Email : 
                                                </h6>
                                              {{$s->operator->email}}
                                            </li>
                                            <li class="list-group-item">
                                                <h6>
                                                       Website :
                                                </h6>
                                              {{$s->operator->website}}
                                            </li>
                                        </ul>
                                            
                                        <!-- name operator, website, handphone number, email, route2, depart time, arive time, type -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
          @endforeach
           
        </div>
    </div><br><br>
    <div class="d-flex justify-content-center"> 
        <a href="/boats">
            <button class="btn btn-warning text-center">Load More</button>
        </a>
        </div>
    <br><br>
</section>
      
    <section id="operators" >
        <br><br>
        <div class="container">
            <h1 class="fw-bold text-center">The Operators</h1><br><br>
            <div class="row d-flex justify-content-center">
                @foreach($operator as $o)
                <div class="col-6 d-flex justify-content-center">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4 ">  
                                @if($o->image == '')                          
                                @endif
                                <!-- <img src="https://plus.unsplash.com/premium_photo-1676299894446-19d9d6604337?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="img-thumbnail rounded-start" alt="..."> -->
                            <img src="{{ asset('images/' . $o->image) }}" style="width:20rem;height:10rem;object-fit:cover;" alt="..."  class="img-thumbnail rounded-start ">
                            </div>
                            <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">{{$o->name}}</h5>
                                <p class="card-text">{{$o->address}}</p>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
             @endforeach
            </div>
            <br><br>
            <div class="d-flex justify-content-center"> 
                <a href="/operators">
                    <button class="btn btn-warning text-center">Load More</button>
                </a>
        </div>
    </div> <br><br>
</section>        

<section style="background-image: url('https://plus.unsplash.com/premium_photo-1697730113048-1903ddc36c58?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); background-size: cover; background-position: center; min-height: 50vh;" id="reviews" class="bg-light">
    <div class="bg-dark bg-opacity-50">
        <div class="container">
            <h1 class="text-center text-white fw-bold py-5">What People Feel</h1>
            <div class="row">
                @foreach($review as $r)
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-justify">
                            <h6 class="card-text" style="text-align: justify;">{{$r->review}}</h6>
                            <div class="d-inline-flex">
                                <i class="fa-solid fa-user m-auto"></i>
                                <p class="card-link m-auto p-1 fw-semibold">{{$r->name}}</p>
                            </div>
                            <div>
                                @for($i = 1; $i <= $r->point; $i++)
                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <a href="/reviews" class="text-warning d-block text-center my-3">Load More Review</a>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-warning btn-lg" data-bs-toggle="modal" data-bs-target="#reviewModal">
                GIVE A REVIEW
            </button>
<br><br><br>
            <!-- Modal -->
            <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Review</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="/review/store">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="review" class="form-label">Review</label>
                                    <textarea class="form-control" id="review" rows="3" name="review" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="">Rating</label>
                                    <div>
                                        <div class="rate">
                                            <input type="radio" id="star5" name="point" value="5" required />
                                            <label for="star5" title="text">5 stars</label>
                                            <input type="radio" id="star4" name="point" value="4" />
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" id="star3" name="point" value="3" />
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" id="star2" name="point" value="2" />
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" id="star1" name="point" value="1" />
                                            <label for="star1" title="text">1 star</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    * {
        margin: 0;
        padding: 0;
    }
    .rate {
        float: left;
        height: 46px;
        padding: 0 10px;
    }
    .rate:not(:checked) > input {
        position: absolute;
        top: -9999px;
    }
    .rate:not(:checked) > label {
        float: right;
        width: 1em;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 30px;
        color: #ccc;
    }
    .rate:not(:checked) > label:before {
        content: '★ ';
    }
    .rate > input:checked ~ label {
        color: #ffc700;    
    }
    .rate:not(:checked) > label:hover,
    .rate:not(:checked) > label:hover ~ label {
        color: #deb217;  
    }
    .rate > input:checked + label:hover,
    .rate > input:checked + label:hover ~ label,
    .rate > input:checked ~ label:hover,
    .rate > input:checked ~ label:hover ~ label,
    .rate > label:hover ~ input:checked ~ label {
        color: #c59b08;
    }
</style>
  
  
<section id="facilities" class="container py-5">



<!-- Facilities Section -->
  <div class="text-center mb-5">
    <h2 class="fw-bold">Our Facilities</h2>
    <p class="text-muted">Pelabuhan Serangan provides a range of facilities to enhance your travel experience.</p>
  </div>
  
  <div class="row">
    <!-- Facility Card 1 -->
    <div class="col-md-6 col-lg-4 mb-4">
      <div class="card h-100">
        <img src="https://images.unsplash.com/photo-1594586304384-e7f60fc1a19f?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="card-img-top img-fluid" alt="Waiting Lounge"  style="width: 500px;height:280px;object-fit:cover;">
        <div class="card-body">
          <h5 class="card-title">Waiting Lounge</h5>
          <p class="card-text">A comfortable waiting area with ample seating for passengers awaiting departure or arrival.</p>
        </div>
      </div>
    </div>

    <!-- Facility Card 2 -->
    <div class="col-md-6 col-lg-4 mb-4">
      <div class="card h-100">
        <img src="https://images.unsplash.com/photo-1593280405106-e438ebe93f5b?q=80&w=1780&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="card-img-top img-fluid" alt="Parking Area" style="width: 500px;height:280px;object-fit:cover;">
        <div class="card-body">
          <h5 class="card-title">Parking Area</h5>
          <p class="card-text">Spacious parking area for private vehicles and public transport, with 24/7 security.</p>
        </div>
      </div>
    </div>
    
    <!-- Facility Card 3 -->
    <div class="col-md-6 col-lg-4 mb-4">
      <div class="card h-100">
        <img src="https://images.unsplash.com/photo-1647427017067-8f33ccbae493?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="card-img-top img-fluid" alt="Ticket and Reservation Service"  style="width: 500px;height:280px;object-fit:cover;">
        <div class="card-body">
          <h5 class="card-title">Ticket and Reservation Service</h5>
          <p class="card-text">Convenient ticketing and reservation services with fast check-in options.</p>
        </div>
      </div>
    </div>

    <!-- Facility Card 4 -->
    <div class="col-md-6 col-lg-4 mb-4">
      <div class="card h-100">
        <img src="https://plus.unsplash.com/premium_photo-1661434648069-3063192e1ad5?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="card-img-top img-fluid" alt="ATM and Banking"  style="width: 500px;height:280px;object-fit:cover;">
        <div class="card-body">
          <h5 class="card-title">ATM and Banking</h5>
          <p class="card-text">ATM and mini-bank services available for easy financial transactions.</p>
        </div>
      </div>
    </div>
    
    <!-- Facility Card 5 -->
    <div class="col-md-6 col-lg-4 mb-4">
      <div class="card h-100">
        <img src="https://images.unsplash.com/photo-1497644083578-611b798c60f3?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="card-img-top img-fluid" alt="Restaurant and Cafe"  style="width: 500px;height:280px;object-fit:cover;">
        <div class="card-body">
          <h5 class="card-title">Restaurant and Cafe</h5>
          <p class="card-text">A variety of dining options with local and international cuisine to enjoy during your wait.</p>
        </div>
      </div>
    </div>
    
    <!-- Facility Card 6 -->
    <div class="col-md-6 col-lg-4 mb-4">
      <div class="card h-100">
        <img src="https://media.istockphoto.com/id/1142551444/id/foto/pelancong-wanita-menggunakan-layanan-loker-dan-pergi-berlibur-di-kota.jpg?s=2048x2048&w=is&k=20&c=qKEOtEthJSb1ZGCNgycieWKuH_HIJ9cwIg7Wbl408Z4=" class="card-img-top img-fluid" alt="Luggage Storage"  style="width: 500px;height:280px;object-fit:cover;">
        <div class="card-body">
          <h5 class="card-title">Luggage Storage</h5>
          <p class="card-text">Secure luggage storage available for travelers needing a place to store their belongings temporarily.</p>
        </div>
      </div>
    </div>
  </div>
</section>

  <section id="contactUs" class="bg-primary p-4 text-white bg-opacity-75">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-7 mb-4">
                <div class="card">
                    <img src="https://images.unsplash.com/photo-1599186524744-2dff6eb60bf8?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="card-img-top" alt="Pelabuhan Serangan">
                    <div class="card-body bg-primary bg-gradient">
                        <div class="d-inline-flex align-items-center">
                            <i class="fa-solid fa-location-dot py-auto my-auto px-2" style="color: #fc8d02;"></i>
                            <h5 class="card-title text-white fw-bold">Pelabuhan Serangan, Denpasar, Bali, Indonesia</h5>
                        </div>
                        <h1 class="card-text text-white fw-bold">Let's plan your next trip</h1>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-5">
                <h3 class="text-white fw-bold">Address</h3>
                <p class="text-white">Pelabuhan Serangan, Denpasar</p>
                <h3 class="text-white fw-bold">Contact</h3>
                <p class="text-white">Telephone: (0361) 456-7890</p>
                <p class="text-white">Mobile: (081) 23456-7890</p>
                <p class="text-white ">Email: istanalaut@denpasarkota.go.id</p>
                <h3 class="text-white fw-bold">Office Hours</h3>
                <p class="text-white">Sunday: 8am - 6pm</p>
                <p class="text-white">Monday: 8am - 6pm</p>
                <p class="text-white">Tuesday: 8am - 6pm</p>
                <p class="text-white">Wednesday: 8am - 6pm</p>
                <p class="text-white">Thursday: 8am - 6pm</p>
                <p class="text-white">Friday: 8am - 6pm</p>
                <p class="text-white">Saturday: 8am - 6pm</p>
            </div>
        </div>
    </div>
</section>
    

    @endsection

