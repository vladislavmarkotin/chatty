<div class="media">
    <a href="{{ route('profile.index', ['id' => $user->id] ) }}" class="pull-left">
    <img src="{{ $user->getAvatarUrl() }}" alt="{{ $user->getName() }}" class="media-object">
    </a>
    <h4 class="media-heading"><a href="{{ route('profile.index', ['id' => $user->id] ) }}">
    {{ $user->getName() }}
    </a> </h4>
    <h4>
        @if ($user->location)
        <p>{{ $user->location }}</p>
        @endif
    </h4>

</div>