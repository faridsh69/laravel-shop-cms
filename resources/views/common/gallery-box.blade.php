<div class="row">
    <div class="col-xs-12">
        <div class="image-box-gallery">
            @foreach($product->images()->get() as $key => $image)
            <img class="thumbnail display-none" src="{{ $product->gallery_image($key) }}" alt="عکس {{ $product->title }}">
            @endforeach
            @if( count($product->images()->get()) == 0)
                <img class="thumbnail display-none" src="{{ asset('upload/images/default.png') }}" alt="عکس {{ $product->title }}">
            @endif
        </div>
    </div>
</div>
<div class="row padding-sides">
    @foreach($product->images()->get() as $key => $image)
    <div class="col-xs-3">
        <img class="cursor-pointer" src="{{ $product->gallery_image100($key) }}" onclick="currentDiv({{ $key + 1 }})">
    </div>
    @endforeach
</div>

@push('script')
<script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
    showDivs(slideIndex += n);
}

function currentDiv(n) {
    showDivs(slideIndex = n);
}

function showDivs(n) {
    var i;
    var x = document.getElementsByClassName("display-none");
    var dots = document.getElementsByClassName("cursor-pointer");
    if (n > x.length) {slideIndex = 1}
    if (n < 1) {slideIndex = x.length}
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
       dots[i].className = dots[i].className.replace(" w3-opacity-off", "");
    }
    x[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " w3-opacity-off";
}
</script>
@endpush