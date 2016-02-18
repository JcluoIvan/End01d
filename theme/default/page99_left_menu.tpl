<ul id="left-menu" class="list-group">
    {{foreach from=$menus item=title key=name}}
        <a
            class="list-group-item"
            href="{{$name}}.php?sid={{$smarty.get.sid}}"
            target="ifr-right">
            {{$title}}
        </a>
    {{/foreach}}
</ul>