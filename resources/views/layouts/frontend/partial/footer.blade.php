<div class="footer">
  <div class="container">
    <div class="row">
      <div class="col-lg-3">
          <h3 class="footer-heading"><span>Random Books</span></h3>
          <ul class="list-unstyled">
              @php
                  $posts = \App\Post::all()->random(4);
              @endphp

              @foreach($posts as $post)
                  <li><a href="#">{{$post->title}}</a></li>
              @endforeach
          </ul>
      </div>
      <div class="col-lg-3">
        <h3 class="footer-heading"><span>Tags</span></h3>
        <ul class="list-unstyled">
            @php
                $tags = \App\Tag::all()->random(4);
            @endphp

            @foreach($tags as $tag)
                <li><a href="#">{{$tag->name}}</a></li>
            @endforeach
        </ul>
      </div>

      <div class="col-lg-3">
          <h3 class="footer-heading"><span>Categories</span></h3>
          <ul class="list-unstyled">
              @php
              $categories = \App\Category::all()->random(5);
              @endphp

              @foreach($categories as $catgory)
              <li><a href="#">{{$catgory->name}}</a></li>
             @endforeach
          </ul>
      </div>
      <div class="col-lg-3">
          <h3 class="footer-heading"><span>Contact</span></h3>
          <ul class="list-unstyled">
              <li><a href="{{route('contact.form')}}">Help Center</a></li>
              <li><a href="{{route('blog.index')}}">Support Community</a></li>
              <li><a href="{{route('blog.create')}}">Share Your Story</a></li>
              <li><a href="{{route('contact.form')}}">Our Supporters</a></li>
          </ul>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="copyright">
            <p>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Template Design Goeas To  <a href="https://colorlib.com" target="_blank" >Colorlib</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
        </div>
      </div>
    </div>
  </div>
</div>
