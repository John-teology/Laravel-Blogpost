<div class="list-group">
    @forEach($posts as $post)
      <x-posts :post="$post" hideAutherName="{{true}}" />
    @endforEach
</div>
