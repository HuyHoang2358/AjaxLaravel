@foreach($categories as $category)
    <tr class="{{ $is_show ? 'd-table-row' : 'd-none'}} category-{{$category->parent_id}}">
        <th  class="text-center" scope="row">{{($category->parent_id === 0) ? $loop->index + 1 : ""}}</th>
        <td>
            @if($category->icon)
                <img src="{{asset($category->icon)}}" alt="" style="width: 40px"/>
            @else
                <img src="{{asset('/images/samples/no_image.png')}}" alt="" style="width: 40px"/>
            @endif
        </td>
        <td>{{str_repeat("----", $level)}}  {{$category->id."-".$category->name}}</td>
        <td>{{$category->slug}}</td>
        <td>
            <div class="">
                <button type="button" class="btn btn-outline-warning"><i class="fa-solid fa-pen"></i></button>
                <button type="button" class="btn btn-outline-danger"><i class="fa-solid fa-trash-can"></i></button>
                @if(count($category->childs))
                    <button type="button" class="btn btn-outline-primary" onclick="onOffSubCategory({{$category->id}})" id="btn_show_more_category_{{$category->id}}"><i class="fa-solid fa-caret-down"></i></button>
                @endif
            </div>
        </td>
    </tr>
    @if(count($category->childs))
        @include('admin.content.category_row', ["categories"=>$category->childs, "level"=>$level+1, 'is_show' => False])
    @endif
@endforeach

<script>
    function getStatus(element){
        return element.classList.contains("d-table-row");
    }
    function onOffSubCategory(id){
        let elements = document.getElementsByClassName(`category-${id}`);
        if(elements.length > 0){
            const is_on = getStatus(elements[0])
            if (is_on){
                for(let i=0; i<elements.length; i++){
                    elements[i].classList.remove("d-table-row");
                    elements[i].classList.add("d-none");
                    document.getElementById(`btn_show_more_category_${id}`).innerHTML = '<i class="fa-solid fa-caret-down"></i>';
                }
            }else{
                for(let i=0; i<elements.length; i++){
                    elements[i].classList.remove("d-none");
                    elements[i].classList.add("d-table-row");
                    document.getElementById(`btn_show_more_category_${id}`).innerHTML = '<i class="fa-solid fa-sort-up"></i>';
                }
            }
        }
    }
</script>
