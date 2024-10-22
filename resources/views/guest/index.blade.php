@extends('layouts.app')
@section('content')
    <section style="background-image: url('https://images.unsplash.com/photo-1517988368819-88f4eacfef44?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); background-size: cover; background-position: center; min-height: 100vh;" id="jumbotron" class=" ">
        <div class="bg-dark bg-opacity-50">
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
            <div class="col-7">
                <div class="d-inline-flex">
                    <h1 class="p-auto m-auto">
                        <i class="fa-solid fa-location-dot p-auto m-auto" style="color: #fc8d02;"></i>
                    </h1>
                    <h2 class="p-auto m-auto text-danger fw-bold ">&nbsp;ISTANA LAUT</h2>
                </div> 
                <br><br>
                <h3 class="fw-bold">S<span class="text-danger">I</span>STEM INFORMA<span class="text-danger">S</span>I <span class="text-danger">T</span>ICKETING D<span class="text-danger">A</span>N MA<span class="text-danger">N</span>AJEMEN PENGELOLA<span class="text-danger">A</span>N PELABUHAN <span class="text-danger">LAUT</span></h3>
                <p style="text-align:justify"><br>
                We call it "ISTANA LAUT", Istana in Bahasa, means Palace. In the "Istana Laut" resides "God Baruna". In Hindu belief, Baruna controls the laws of nature called Reta. He rides a creature called makara, half crocodile half goat (sometimes makara is equated with a crocodile, or can also be described as a creature that is half goat half fish). His wife is named Baruni, the Goddess of the ocean, who lives in the pearl palace. By wise people, Dewa Baruna is also called the God of the sky, the Ruler of all waters, who controls all properties that are in the form of water, the God of Rain, and the god who controls the law. 
                </p>
                <br>
                <div class="d-inline-flex">
                    <a href="#operators">
                        <button class="btn btn-warning">OPERATOR</button>
                    </a>
                    <a href="#boats">
                        <button class="btn btn-warning mx-3">BOATS</button>
                    </a>
                </div>
            </div>
            <div class="col-5 text-end">
                <img src="https://images.unsplash.com/photo-1616377009507-c8111f07aced?q=80&w=1881&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="w-50 rounded" alt="">
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
                    <img src="{{ asset('images/' . $s->image) }}" class="card-img-top" style="height:11rem;object-fit:cover;" alt="...">
                    <div class="card-body">
                        <h4 class="card-title">{{$s->name}}</h4>
                        <h5 class="card-title">Start From IDR</h5><br>
                        <p class="card-text">Route : {{$s->departure_route}} / {{$s->arrival_route}}</p>
                        <p class="card-text">Depart : {{$s->departure_time}}</p>
                        <p class="card-text">Arrive : {{$s->arrival_time}}</p>
                        <a href="#" class="btn btn-warning">BOOK NOW</a>
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

<section style="background-image: url('https://plus.unsplash.com/premium_photo-1697730113048-1903ddc36c58?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); background-size: cover; background-position: center; min-height: 50vh;"  id="reviews" class="bg-light">
    <div class="bg-dark bg-opacity-50">
    <br><br>
        <div class="container">
            <h1 class="text-center text-white fw-bold">What Peoples Feel</h1><br><br>
            <div class="row">
                @foreach($review as $r)
                <div class="col-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h6 class="card-text">{{$r->review}}</h6>
                            <div class="d-inline-flex">
                                <i class="fa-solid fa-user m-auto"></i>
                                <p class="card-link m-auto p-1 fw-semibold">{{$r->name}}</p>
                            </div>
                            <div>
                                @for($i = 0; $i <= $r->point; $i++)
                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div><br>
            <a href="/review" class="text-warning">Load More Review</a><br><br>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-warning btn-lg" data-bs-toggle="modal" data-bs-target="#reviewModal">
            GIVE A REVIEW
            </button>

            <!-- Modal -->
            <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/review/store">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">review</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="review"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="">Rating</label>
                            <div>
                                <div class="rate">
                                    <input type="radio" id="star5" name="rate" value="5" />
                                    <label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" />
                                    <label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" />
                                    <label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" />
                                    <label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" />
                                    <label for="star1" title="text">1 star</label>
                                </div>
                            </div>
                            <style>
                                *{
                                    margin: 0;
                                    padding: 0;
                                }
                                .rate {
                                    float: left;
                                    height: 46px;
                                    padding: 0 10px;
                                }
                                .rate:not(:checked) > input {
                                    position:absolute;
                                    top:-9999px;
                                }
                                .rate:not(:checked) > label {
                                    float:right;
                                    width:1em;
                                    overflow:hidden;
                                    white-space:nowrap;
                                    cursor:pointer;
                                    font-size:30px;
                                    color:#ccc;
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
                        </div>
                        <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                </div>
            </div>
            </div>
        </div>

<br>
<br>
<br>
<br>
        </div>
    </section>        
    <section id="contactUs" class="bg-primary p-2 text-white bg-opacity-75"><br><br>
        <div class="container">
            <div class="row">
                <div class="col-7">
                    <div class="card mb-3">
                        <img src="https://images.unsplash.com/photo-1599186524744-2dff6eb60bf8?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="card-img-top" alt="...">
                        <div class="card-body bg-primary bg-gradient">
                            <div class="d-inline-flex">
                                <i class="fa-solid fa-location-dot py-auto my-auto px-2" style="color: #fc8d02"></i>
                                <h5 class="card-title text-white fw-bold">Pelabuhan Serangan, Denpasar, Bali, Indonesia</h5>
                            </div>
                            <h1 class="card-text text-white fw-bold">Let's plan your next trip</h1>
                        </div>
                    </div>
                </div>
                <div class="col-1"></div>
                <div class="col-4">
                <h3 class="text-white fw-bold">Address</h3>
                <p class="text-white">Pelabuhan Serangan, Denpasar</p>
                <br><br>
                <h3 class="text-white fw-bold">Contact</h3>
                <p class="text-white">Telephone: (0361)456-7890</p>
                <p class="text-white">Mobile: (081)23456-7890</p>
                <p class="text-white fw-bolder">istanalaut@denpasarkota.go.id</p>
                <br><br>
                <h3 class="text-white fw-bold">Office Hours</h3>
                <p class="text-white">Sunday:8am - 6pm</p>
                <p class="text-white">Monday:8am - 6pm</p>
                <p class="text-white">Tuesday:8am - 6pm</p>
                <p class="text-white">Wednesday:8am - 6pm</p>
                <p class="text-white">Thursday:8am - 6pm</p>
                <p class="text-white">Friday:8am - 6pm</p>
                <p class="text-white">Saturday:8am - 6pm</p>
            </div>
            </div>
        </div><br><br>
    </section>        

    @endsection

