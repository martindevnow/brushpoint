<li id="virtue_{{$virtue->id}}" class="sortable_list ui-state-default">
    {{ ($virtue->body) }}
    <div class="del-wrapper" style="display: inline">
        <a href="#" class="del_button" id="del-{{$virtue->id}}">
            [ x ]
        </a>
    </div>
</li>