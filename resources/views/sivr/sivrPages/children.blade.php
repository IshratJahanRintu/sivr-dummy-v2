@if ($children->count() > 0)
    <ul>
        @foreach ($children as $child)
            <li class="{{$child->hasChildren()?'folder':'file'}} " >
                <span class="node-name" data-sivrpage-id={{$child->id}}> {{ $child->page_heading_en }}</span>
                @include('sivr.sivrPages.children', ['children' => $child->children])
            </li>
        @endforeach
    </ul>
@endif
