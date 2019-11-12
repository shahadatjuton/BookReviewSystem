@extends('layouts.frontend.master')

@section('title')
Book Review System-{{$keyword}}
@endsection

@push('css')

    <link href="{{ asset('assets/frontend/css/home/home.css')}}" rel="stylesheet">


@endpush

@section('content')

    <div class="site-section ftco-subscribe-1 site-blocks-cover pb-4" style="background-image: url('assets/frontend/images/bg_1.jpg')">

        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-12 text-center">
                    <h2 class="mb-0">{{$posts->count()}} Results found for {{$keyword}}</h2>
                </div>
            </div>
        </div>
    </div>


{{--=================Category wise posts ===================--}}


    <div class="site-section">
        <div class="container">
            <div class="row">



                @foreach( $posts as $post )
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="course-1-item">
                        <figure class="thumnail">
                            <a href="course-single.html"><img src="{{asset('storage/blog/'.$post->image)}}" alt="{{$post->title}}"  class="img-fluid"></a>
                            <div class="price">$99.00</div>
                            <div class="category"><h3>{{$post->title}}</h3></div>
                        </figure>
                        <div class="course-1-content pb-4">
                            <p class="desc mb-4">{{ Str::limit($post->description, 30 ) }}</p>
                            <p><a href="{{ route('blog.singleblog', $post->slug) }}" class="btn btn-primary rounded-0 px-4">View Details</a></p>
                        </div>
                    </div>
                </div>
                @endforeach



{{--                <div class="col-lg-4 col-md-6 mb-4">--}}
{{--                    <div class="course-1-item">--}}
{{--                        <figure class="thumnail">--}}
{{--                            <a href="course-single.html"><img src="images/course_4.jpg" alt="Image" class="img-fluid"></a>--}}
{{--                            <div class="price">$99.00</div>--}}
{{--                            <div class="category"><h3>Mobile Application</h3></div>--}}
{{--                        </figure>--}}
{{--                        <div class="course-1-content pb-4">--}}
{{--                            <h2>How To Create Mobile Apps Using Ionic</h2>--}}
{{--                            <div class="rating text-center mb-3">--}}
{{--                                <span class="icon-star2 text-warning"></span>--}}
{{--                                <span class="icon-star2 text-warning"></span>--}}
{{--                                <span class="icon-star2 text-warning"></span>--}}
{{--                                <span class="icon-star2 text-warning"></span>--}}
{{--                                <span class="icon-star2 text-warning"></span>--}}
{{--                            </div>--}}
{{--                            <p class="desc mb-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Similique accusantium ipsam.</p>--}}
{{--                            <p><a href="course-single.html" class="btn btn-primary rounded-0 px-4">Enroll In This Course</a></p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-lg-4 col-md-6 mb-4">--}}
{{--                    <div class="course-1-item">--}}
{{--                        <figure class="thumnail">--}}
{{--                            <a href="course-single.html"><img src="images/course_5.jpg" alt="Image" class="img-fluid"></a>--}}
{{--                            <div class="price">$99.00</div>--}}
{{--                            <div class="category"><h3>Mobile Application</h3></div>--}}
{{--                        </figure>--}}
{{--                        <div class="course-1-content pb-4">--}}
{{--                            <h2>How To Create Mobile Apps Using Ionic</h2>--}}
{{--                            <div class="rating text-center mb-3">--}}
{{--                                <span class="icon-star2 text-warning"></span>--}}
{{--                                <span class="icon-star2 text-warning"></span>--}}
{{--                                <span class="icon-star2 text-warning"></span>--}}
{{--                                <span class="icon-star2 text-warning"></span>--}}
{{--                                <span class="icon-star2 text-warning"></span>--}}
{{--                            </div>--}}
{{--                            <p class="desc mb-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Similique accusantium ipsam.</p>--}}
{{--                            <p><a href="course-single.html" class="btn btn-primary rounded-0 px-4">Enroll In This Course</a></p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-lg-4 col-md-6 mb-4">--}}
{{--                    <div class="course-1-item">--}}
{{--                        <figure class="thumnail">--}}
{{--                            <a href="course-single.html"><img src="images/course_6.jpg" alt="Image" class="img-fluid"></a>--}}
{{--                            <div class="price">$99.00</div>--}}
{{--                            <div class="category"><h3>Mobile Application</h3></div>--}}
{{--                        </figure>--}}
{{--                        <div class="course-1-content pb-4">--}}
{{--                            <h2>How To Create Mobile Apps Using Ionic</h2>--}}
{{--                            <div class="rating text-center mb-3">--}}
{{--                                <span class="icon-star2 text-warning"></span>--}}
{{--                                <span class="icon-star2 text-warning"></span>--}}
{{--                                <span class="icon-star2 text-warning"></span>--}}
{{--                                <span class="icon-star2 text-warning"></span>--}}
{{--                                <span class="icon-star2 text-warning"></span>--}}
{{--                            </div>--}}
{{--                            <p class="desc mb-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Similique accusantium ipsam.</p>--}}
{{--                            <p><a href="course-single.html" class="btn btn-primary rounded-0 px-4">Enroll In This Course</a></p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                --}}

{{--                <div class="col-lg-4 col-md-6 mb-4">--}}
{{--                    <div class="course-1-item">--}}
{{--                        <figure class="thumnail">--}}
{{--                            <a href="course-single.html"><img src="images/course_4.jpg" alt="Image" class="img-fluid"></a>--}}
{{--                            <div class="price">$99.00</div>--}}
{{--                            <div class="category"><h3>Mobile Application</h3></div>--}}
{{--                        </figure>--}}
{{--                        <div class="course-1-content pb-4">--}}
{{--                            <h2>How To Create Mobile Apps Using Ionic</h2>--}}
{{--                            <div class="rating text-center mb-3">--}}
{{--                                <span class="icon-star2 text-warning"></span>--}}
{{--                                <span class="icon-star2 text-warning"></span>--}}
{{--                                <span class="icon-star2 text-warning"></span>--}}
{{--                                <span class="icon-star2 text-warning"></span>--}}
{{--                                <span class="icon-star2 text-warning"></span>--}}
{{--                            </div>--}}
{{--                            <p class="desc mb-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Similique accusantium ipsam.</p>--}}
{{--                            <p><a href="course-single.html" class="btn btn-primary rounded-0 px-4">Enroll In This Course</a></p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-lg-4 col-md-6 mb-4">--}}
{{--                    <div class="course-1-item">--}}
{{--                        <figure class="thumnail">--}}
{{--                            <a href="course-single.html"><img src="images/course_5.jpg" alt="Image" class="img-fluid"></a>--}}
{{--                            <div class="price">$99.00</div>--}}
{{--                            <div class="category"><h3>Mobile Application</h3></div>--}}
{{--                        </figure>--}}
{{--                        <div class="course-1-content pb-4">--}}
{{--                            <h2>How To Create Mobile Apps Using Ionic</h2>--}}
{{--                            <div class="rating text-center mb-3">--}}
{{--                                <span class="icon-star2 text-warning"></span>--}}
{{--                                <span class="icon-star2 text-warning"></span>--}}
{{--                                <span class="icon-star2 text-warning"></span>--}}
{{--                                <span class="icon-star2 text-warning"></span>--}}
{{--                                <span class="icon-star2 text-warning"></span>--}}
{{--                            </div>--}}
{{--                            <p class="desc mb-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Similique accusantium ipsam.</p>--}}
{{--                            <p><a href="course-single.html" class="btn btn-primary rounded-0 px-4">Enroll In This Course</a></p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-lg-4 col-md-6 mb-4">--}}
{{--                    <div class="course-1-item">--}}
{{--                        <figure class="thumnail">--}}
{{--                            <a href="course-single.html"><img src="images/course_6.jpg" alt="Image" class="img-fluid"></a>--}}
{{--                            <div class="price">$99.00</div>--}}
{{--                            <div class="category"><h3>Mobile Application</h3></div>--}}
{{--                        </figure>--}}
{{--                        <div class="course-1-content pb-4">--}}
{{--                            <h2>How To Create Mobile Apps Using Ionic</h2>--}}
{{--                            <div class="rating text-center mb-3">--}}
{{--                                <span class="icon-star2 text-warning"></span>--}}
{{--                                <span class="icon-star2 text-warning"></span>--}}
{{--                                <span class="icon-star2 text-warning"></span>--}}
{{--                                <span class="icon-star2 text-warning"></span>--}}
{{--                                <span class="icon-star2 text-warning"></span>--}}
{{--                            </div>--}}
{{--                            <p class="desc mb-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Similique accusantium ipsam.</p>--}}
{{--                            <p><a href="course-single.html" class="btn btn-primary rounded-0 px-4">Enroll In This Course</a></p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

            </div>
        </div>
    </div>








@endsection

@push('js')

@endpush