<aside>
    <section class="panelV2">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h4 class="text-center">
                    <div class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" style="color:#ffffff;">
                        <i class="{{ config('other.font-awesome') }} fa-chart-line"></i> {{ __('stat.stats') }}
                    </div>
                </h4>
            </div>
            <dl class="key-value">
                <dt>{{ __('stat.users') }}</dt>
                <dd>{{ $all_user }}</dd>
                <dt>{{ __('stat.torrents') }}</dt>
                <dd>{{ $num_torrent }}</dd>
                <dt>{{ __('torrent.seeders') }}</dt>
                <dd>{{ $num_seeders }}</dd>
                <dt>{{ __('torrent.leechers') }}</dt>
                <dd>{{ $num_leechers }}</dd>
                <dt>{{ __('stat.upload') }}</dt>
                <dd>{{ \App\Helpers\StringHelper::formatBytes($credited_upload, 2) }}</dd>
                <dt>{{ __('stat.download') }}</dt>
                <dd>{{ \App\Helpers\StringHelper::formatBytes($credited_download, 2) }}</dd>
            </dl>
        </div>
	</section>