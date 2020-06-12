@if(isset($entry->{$column['rel']}[0]))
    <img width="50" src="{{ asset('uploads/'.$entry->{$column['rel']}[0]->{$column['name']}) }}" />
@else
    -
@endif
