@foreach($categories as $category)
    <option value="{{$category->id}}">{{str_repeat("----", $level).$category->name}}</option>
    @if($category->childs)
        @include('admin.content.category_option', ["categories" =>$category->childs, 'level' => $level+1])
    @endif
@endforeach
