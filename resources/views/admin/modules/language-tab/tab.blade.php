<ul class="tabs mb-2 row" style="margin-left: 0;margin-right: 0">
    @foreach($globalLanguages['data'] as $language)
        <li class="tab">
            <a target="_self"
               class="display-flex align-items-center {{$language['abbreviation']==app()->getLocale()?"active":""}}"
               id="account-tab" href="{{$language['url']}}">
                <span>{{$language['title']}}</span>
            </a>
        </li>
    @endforeach
</ul>
