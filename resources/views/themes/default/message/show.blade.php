@extends('theme::layout.public')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-9 main">
            <div class="mt-30 text-muted">
                <span>发私信给 <a  href="{{ route('auth.space.index',['id'=>$toUser->id]) }}">{{ $toUser->name }}</a> ： </span>
                <span class="pull-right"><a href="{{ route('auth.message.index') }}" class="text-muted"><i class="fa fa-reply"></i> 返回</a></span>
            </div>
            <div class="mt-15 clearfix">
                <form id="messageForm" method="POST" role="form" action="{{ route('auth.message.store') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="to_user_id" value="{{ $toUser->id }}" />
                    <div class="form-group">
                        <textarea name="content" id="message_content" placeholder="请输入私信内容" class="form-control" style="height:100px;"></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary pull-right">发&nbsp;&nbsp;送</button>
                    </div>
                </form>
            </div>

            <div class="widget-streams messages mt-15">
                <section class="hover-show streams-item">
                    @foreach($messages as $message)
                        @if($message->from_user_id == Auth()->user()->id)
                        <div class="stream-wrap media">
                            <div class="pull-left">
                                <a href="{{ route('auth.space.index',['id'=>$message->from_user_id]) }}" target="_blank">
                                    <img class="media-object avatar-40" src="{{ route('website.image.avatar',['avatar_name'=>$message->from_user_id.'_middle']) }}" alt="我">
                                </a>
                            </div>
                            <div class="media-body">
                                我 :
                                <div class="full-text fmt">{{ $message->content }}</div>
                                <div class="meta mt-10">
                                    <span class="text-muted">{{ timestamp_format($message->created_at) }} </span>
                                    <span class="pull-right">
                                        <a href="javascript:;" class="text-muted" onclick="#">删除</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                       @else
                        <div class="stream-wrap media">
                            <div class="pull-left">
                                <a href="{{ route('auth.space.index',['id'=>$message->to_from_id]) }}" target="_blank">
                                    <img class="media-object avatar-40" src="{{ route('website.image.avatar',['avatar_name'=>$message->from_user_id.'_middle']) }}" alt="{{ $toUser->name }}">
                                </a>
                            </div>
                            <div class="media-body">
                                <a target="_blank" href="{{ route('auth.space.index',['id'=>$message->to_from_id]) }}"> {{ $toUser->name }}</a> :
                                <div class="full-text fmt">{{ $message->content }}</div>
                                <div class="meta mt-10">
                                    <span class="text-muted">{{ timestamp_format($message->created_at) }} </span>
                                <span class="pull-right">
                                    <a href="javascript:;" class="text-muted" onclick="#">删除</a>
                                </span>
                                </div>
                            </div>
                        </div>
                       @endif
                    @endforeach
                </section>
            </div>
            <div class="text-center">
            </div>
        </div>
    </div>
@endsection