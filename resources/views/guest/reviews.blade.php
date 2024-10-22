@extends('layouts.app-menu')

@section('content')<br><br>
<br><br>
<br><br>
 <section>
<!-- 
 name
 email
 review
 point
  -->
   <div class="container">
        <div class="row">
            @foreach($review as $r)
            <div class="col">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">
                        @for($i = 0; $i <= $r->point; $i++)
                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                @endfor
                        </h5>
                        <p class="card-text">{{$r->review}}</p>
                        <h5 class="card-text ">{{$r->name}}</h5>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
 </section>
    @endsection

