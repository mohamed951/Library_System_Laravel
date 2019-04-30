@extends('layouts.app')

<link href="{{ asset('css/stars.css') }}" rel="stylesheet">

@section('content')
<div class="container">
    <div class="row">

        <!--  -->
        <!--  -->


        <div class="main col-md-10">
            @foreach ($books as $book)
            <div class="bookCard d-inline-flex"><img class="image cover" src="{{$book->image}}" />
                <div class="book-info">
                    <span style="float: right; font-size: 180%"><i class="fa fa-heart fav"></i></span>
                    <h3 class="font-weight-bold">{{$book->title}}</h3>
                    <!-- Data -->
                    <ul class="list-unstyled list-inline rating mb-0">
                        <li class="list-inline-item"><i class="fa fa-star rateStr"> </i></li>
                        <li class="list-inline-item"><i class="fa fa-star rateStr"></i></li>
                        <li class="list-inline-item"><i class="fa fa-star rateStr"></i></li>
                        <li class="list-inline-item"><i class="fa fa-star rateStr"></i></li>
                        <li class="list-inline-item"><i class="fa fa-star rateStr"></i></li>
                        <li class="list-inline-item">
                            <p class="text-muted">4.5 (413)</p>
                        </li>
                    </ul>
                    <!-- Card content -->
                    <div class="card-body card-body-cascade">
                        <!-- Text -->
                        <p class="card-text">Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi.</p>
                        <!-- Avilability -->
                        <p class="aval"> <span> 2 </span> Books Available </p>
                        <!-- Button -->
                        <a class="btnLease col-md-3">Lease</a>


                    </div>
                </div>
            </div>

            <hr>

            <!-- add comment -->

            <form method="post" action="{{route('addComment',$book->id)}}">
                    @csrf
                <div class="form-group shadow-textarea d-flex">
                    <textarea class="form-control z-depth-1 col-md-9" rows="2" name="text" placeholder="Write comment here..."></textarea>
                    <input type="hidden" value="{{$book->id}}" name="bookID"/>
                    <button type="submit" class="btn btn-info col-md-3 "> Add Comment ..</button>
                </div>
            </form>

            <!-- end of add comment -->

            <hr>

            <!-- show comments -->
            <div class="row">
            @foreach ($comments as $comment)
                <div class="col-sm-12" style="margin: 2%;">
                    <div class="row">
                        <div class="card card-cascade col-sm-9">
                            <div class="card-header">
                                <strong>{{$comment->user->name}}</strong> <span class="text-muted">{{$comment->created_at}}</span>
                            </div>
                            <div class="card-body card-body-cascade">
                            {{$comment->text}}
                            </div>
                        </div>
                        <div class="star-rating star{{$loop->index}} col-sm-3" id="1">
                            <span class="fa fa-star-o" data-rating="1"></span>
                            <span class="fa fa-star-o" data-rating="2"></span>
                            <span class="fa fa-star-o" data-rating="3"></span>
                            <span class="fa fa-star-o" data-rating="4"></span>
                            <span class="fa fa-star-o" data-rating="5"></span>
                            <input type="hidden" name="whatever1" class="rating-value" value="4">
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
            <!-- End  show comments -->

            <hr>

            <h2> Related Books</h2>

            <div id="ThumbnailCarousel" class="carousel slide col-xs-12" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row center-block">
                            <div class="col-md-3 col-sm-6 margg">
                                <div class="card card-cascade narrower">
                                    <!-- Title -->
                                    <div class="card-header d-inline-flex">
                                        <h4 class="font-weight-bold">Life Of Pi</h4>
                                    </div>
                                    <!-- Card image -->
                                    <div class="view view-cascade overlay">
                                        <img class="imgg card-img-top" src="https://images.gr-assets.com/books/1320562005l/4214.jpg" alt="Card image cap">
                                        <a>
                                            <div class="mask rgba-white-slight"></div>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="carousel-item">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 margg">
                                <div class="card card-cascade narrower">
                                    <!-- Title -->
                                    <div class="card-header d-inline-flex">
                                        <h4 class="font-weight-bold">Life Of Pi</h4>
                                    </div>
                                    <!-- Card image -->
                                    <div class="view view-cascade overlay">
                                        <img class="imgg card-img-top" src="https://images.gr-assets.com/books/1320562005l/4214.jpg" alt="Card image cap">
                                        <a>
                                            <div class="mask rgba-white-slight"></div>
                                        </a>
                                    </div>

                                </div>
                            </div>



                        </div>
                    </div>

                </div>
                <a class="carousel-control-prev" href="#ThumbnailCarousel" role="button" data-slide="prev">
                    <button class="btn btn-dark">prev</button>
                </a>
                <a class="carousel-control-next" href="#ThumbnailCarousel" role="button" data-slide="next">
                    <button class="btn btn-dark">next</button>

                </a>
            </div>




        </div>
        @endforeach
    </div>
    @endsection

    @section( 'scripts' )
    <script src="{{asset('js/stars.js')}}"></script>
    @endsection