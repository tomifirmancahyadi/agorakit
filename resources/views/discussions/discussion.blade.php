<div up-expand class="discussion @if ($discussion->unReadCount() > 0) unread @endif @if ($discussion->isArchived()) status-archived @endif @if ($discussion->isPinned()) status-pinned @endif">

    <div class="d-flex">
        <div class="avatar">
            <img src="{{route('users.cover', [$discussion->user, 'small'])}}" class="rounded-circle"/>
        </div>


        <div class="w-100">
            <div>
                <div class="d-flex">
                    <div class="name">
                        <a up-follow up-reveal="false" href="{{ route('groups.discussions.show', [$discussion->group, $discussion]) }}">
                            {{ $discussion->name }}
                        </a>
                    </div>



                    <div class="ml-auto">
                        <div class="d-flex align-items-start">
                            @if ($discussion->isPinned())
                                <div class="badge badge-success" style="min-width: 2em; margin: 0 2px;">
                                    <i class="fas fa-thumbtack"></i> {{__('Pinned')}}
                                </div>
                            @endif
                            @if ($discussion->isArchived())
                                <div class="badge badge-secondary" style="min-width: 2em; margin: 0 2px;">
                                    <i class="fa fa-archive"></i>
                                    {{__('Archived')}}
                                </div>
                            @endif
                            @if ($discussion->unReadCount() > 0)
                                <div class="badge badge-danger" style="min-width: 2em; margin: 0 2px;">
                                    {{ $discussion->unReadCount() }} {{__('New')}}
                                </div>
                            @else
                                @if ($discussion->comments_count > 0)
                                    <div class="badge badge-secondary" style="min-width: 2em; margin: 0 2px;">
                                        {{ $discussion->comments_count }}
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>


            <div class="tags">
                @if ($discussion->tags->count() > 0)
                    @foreach ($discussion->tags as $tag)
                        @include('tags.tag')
                    @endforeach
                @endif
            </div>

            <div class="summary">
                {{summary($discussion->body) }}
            </div>

            <div class="d-flex">
                <div class="meta">
                    {{trans('messages.started_by')}}
                    <strong>
                        <a up-follow href="{{ route('users.show', [$discussion->user]) }}">{{ $discussion->user->name}}</a>
                    </strong>
                    {{trans('messages.in')}}
                    <strong>
                        <a up-follow href="{{ route('groups.show', [$discussion->group]) }}">{{ $discussion->group->name}}</a>
                    </strong>
                    {{ $discussion->updated_at->diffForHumans()}}
                </div>

                @can('update', $discussion)
                    <div class="ml-auto dropdown">
                        <a class="text-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">

                            @can('update', $discussion)
                                <a class="dropdown-item" href="{{ route('groups.discussions.edit', [$discussion->group, $discussion]) }}">
                                    <i class="fa fa-pencil"></i>
                                    {{trans('messages.edit')}}
                                </a>
                            @endcan

                            @can('update', $discussion)
                                <a class="dropdown-item" up-modal=".dialog" up-closable="false" href="{{ route('tagger.index', ['discussions', $discussion->id]) }}?r={{rand(0,999999)}}">
                                    <i class="fa fa-tag"></i>
                                    {{__('Edit tags')}}
                                </a>
                            @endcan

                            @can('delete', $discussion)
                                <a up-modal=".dialog" class="dropdown-item" href="{{ route('groups.discussions.deleteconfirm', [$discussion->group, $discussion]) }}">
                                    <i class="fa fa-trash"></i>
                                    {{trans('messages.delete')}}
                                </a>
                            @endcan

                            @can('pin', $discussion)
                                <a class="dropdown-item" up-follow up-cache="false" up-restore-scroll="true" href="{{ route('groups.discussions.pin', [$discussion->group, $discussion]) }}">
                                    <i class="fa fa-thumbtack"></i>
                                    @if($discussion->isPinned())
                                        {{trans('messages.unpin')}}
                                    @else
                                        {{trans('messages.pin')}}
                                    @endif
                                </a>
                            @endcan

                            @can('archive', $discussion)
                                <a class="dropdown-item" up-follow up-cache="false" up-restore-scroll="true" href="{{ route('groups.discussions.archive', [$discussion->group, $discussion]) }}">
                                    <i class="fa fa-archive"></i>
                                    @if($discussion->isArchived())
                                        {{trans('messages.unarchive')}}
                                    @else
                                        {{trans('messages.archive')}}
                                    @endif
                                </a>
                            @endcan

                            @if ($discussion->revisionHistory->count() > 0)
                                <a class="dropdown-item" href="{{route('groups.discussions.history', [$discussion->group, $discussion])}}"><i class="fa fa-history"></i> {{trans('messages.show_history')}}</a>
                            @endif
                        </div>

                    </div>
                @endcan
            </div>





        </div>


    </div>


</div>
