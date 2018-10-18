@include('module.content.2-developer')
<div class="seperate"></div>
<div class="seperate"></div>
@include('module.content.4')
<div class="seperate"></div>
<div class="seperate"></div>
<div class="seperate"></div>
<div class="seperate"></div>
@include('module.content.7')
<div class="seperate"></div>
<div class="seperate"></div>
<div class="seperate"></div>
@include('module.content.8')
<div class="seperate"></div>
@each('module.title.1', ['نمونه کارها'], 'title')
@include('module.card.1')
<div class="container-fluid">
    <div class="seperate"></div>
    @each('module.title.1', ['اخبار'], 'title')
    <div class="seperate"></div>
    @include('module.news.3')
    <div class="seperate"></div>
    @each('module.title.1', ['برندها'], 'title')
    @include('module.brand.2')
</div>
@each('module.title.1', ['مشتریان ما'], 'title')
@include('module.brand.4')
<div class="seperate"></div>
<div class="seperate"></div>