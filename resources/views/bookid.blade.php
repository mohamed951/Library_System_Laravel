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
                    <h3 class="font-weight-bold">{{$book->title}}asdf {{$hoba}}</h3>
                    <!-- Author -->
                    <p class="card-text">By : {{$book->author}}</p>
                    <input type="hidden" id="bookId" value="{{$book->id}}" />
                    <!-- Data -->
                    <ul class="list-unstyled list-inline rating mb-0">
                        <li class="list-inline-item"><i class="fa fa-star rateStr"> </i></li>
                        <li class="list-inline-item"><i class="fa fa-star rateStr"></i></li>
                        <li class="list-inline-item"><i class="fa fa-star rateStr"></i></li>
                        <li class="list-inline-item"><i class="fa fa-star rateStr"></i></li>
                        <li class="list-inline-item"><i class="fa fa-star rateStr"></i></li>
                        <li class="list-inline-item">
                            @foreach ($rates as $rate)
                            @if ($rate->book_id == $book->id)
                            <p class="text-muted">{{$rate->rate}}</p>
                            @endif
                            @endforeach
                        </li>
                    </ul>
                    <!-- Card content -->
                    <div class="card-body card-body-cascade">
                        <!-- Text -->
                        <p class="card-text">{{$book->description}}</p>
                        <!-- Avilability -->
                        <p class="aval"> <span> {{$book->numberOfCopies}} </span> Books Available </p>
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
                                <span>{{($comments[$loop->index]->commentRatings->avg('rate'))?
                                    $comments[$loop->index]->commentRatings->avg('rate').'/5':'not rated'}}</span>
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
                            <input type="hidden" class="rating-value" value="{{($comments[$loop->index]->commentRatings->where('user_id',Auth::id())->count() > 0)?
                                                                                $comments[$loop->index]->commentRatings->where('user_id',Auth::id())->first()->rate:0}}">
                            <input type="hidden" class="comment_id" value="{{$comment->id}}">
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
                                        <h4 class="font-weight-bold">{{$book->title}}</h4>
                                    </div>
                                    <!-- Card image -->
                                    <div class="view view-cascade overlay">
                                        <img class="imgg card-img-top" src="{{$book->image}}" alt="Card image cap">
                                        <a>
                                            <div class="mask rgba-white-slight"></div>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    @foreach ($related as $relate)
                    @if ($relate->cat_id == $book->cat_id)
                    <div class="carousel-item">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 margg">
                                <div class="card card-cascade narrower">
                                    <!-- Title -->
                                    <div class="card-header d-inline-flex">
                                        <h4 class="font-weight-bold">{{$relate->title}}</h4>
                                    </div>
                                    <!-- Card image -->
                                    <div class="view view-cascade overlay">
                                        <a href="{{ route('bookid', $relate->id) }}">
                                        <img class="imgg card-img-top" src="{{$relate->image}}" alt="Card image cap">
                                        </a>
                                        <a>
                                            <div class="mask rgba-white-slight"></div>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                        @endif
                    @endforeach
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