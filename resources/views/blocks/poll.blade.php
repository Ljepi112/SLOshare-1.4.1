    <div class="col-md-1 col-sm-1-slo col-md-br-1 col-slo-poll">
@if ($poll && $poll->voters->where('user_id', '=', auth()->user()->id)->isEmpty())
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h4 class="text-center">
                    <div class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" style="color:#ffffff;">
                        <i class="{{ config('other.font-awesome') }} fa-chart-pie"></i> {{ __('poll.poll') }}
                    </div>
                </h4>
            </div>
            <div class="panel-body">
                <h3 class="poll-title">{{ $poll->title }}</h3>
                <form class="form-horizontal" method="POST" action="/polls/vote">
                    @csrf
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {!! csrf_field() !!}

                    @if ($poll->multiple_choice)
                        @foreach ($poll->options as $option)
                            <div class="poll-slo">
                                <label>
                                    <input type="checkbox" name="option[]" value="{{ $option->id }}">
                                    <span class="badge-user">{{ $option->name }}</span>
                                </label>
                            </div>
                        @endforeach
                    @else
                        @foreach ($poll->options as $option)
                            <div class="poll-slo">
                                <label>
                                    <input type="radio" name="option[]" value="{{ $option->id }}" required>
                                    <span class="badge-user">{{ $option->name }}</span>
                                </label>
                            </div>
                        @endforeach
                    @endif

                    <div class="poll form-group">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">{{ __('poll.vote') }}</button>
                        </div>
                    </div>
                </form>
                @if ($poll->multiple_choice)
                    <span class="badge-user text-bold text-red poll-note">{{ __('poll.multiple-choice') }}</span>
                @endif
            </div>
        </div>
@endif
    </div>