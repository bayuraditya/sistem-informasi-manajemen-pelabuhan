@extends('layouts.app-menu')

@section('content')<br><br>
<br><br>
<br><br>
 <section>

      <!-- 
Full texts
id
name
address
website
handphone_number
email
image -->


   <div class="container">
        <div class="row">
            @foreach($operator as $o)
            <div class="col">
                <div class="card" style="width: 25rem;">
                    <img src="{{ asset('images/' . $o->image) }}" style="height:15rem;object-fit:cover; "  class="card-img-top" alt="...">
                <div class="card-body">
                    <h4 class="card-title">{{$o->name}}</h4>
                    <p class="card-text"></p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                                   <h6>Address :</h6>
                                {{$o->address}}
                            </tr>
                   </li>
                    <li class="list-group-item">
                             <h6>
                             Website:
                             </h6> 
                             <p>

                                 {{$o->website}}
                             </p>
                            </tr>    
                    </li>
                    <li class="list-group-item">
                           <h6>
                            
                               Handphone Number :
                           </h6> 
                               {{$o->handphone_number}}
                            </tr>
                    </li>
                    <li class="list-group-item">
                            <h6>
                                Email :
                            </h6> 
                          {{$o->email}}
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
 </section>
    @endsection

