<div class="panel panel-chat shoutbox torrent-general">
    <div class="table-responsive">
        <table class="table table-condensed table-bordered table-striped">
            <tbody>
            <tr class="torrent-download">
                <td class="col-sm-3 torrentinfoleft">
                    <strong>{{ __('torrent.download') }}:</strong>
                </td>
                <td class="col-sm-9 torrentinforight">
                    <a href="{{ route('download', ['id' => $torrent->id]) }}" style="color:#cccccc;">{{ __('torrent.download-torrents') }}</a>
                </td>
            </tr>

            <tr class="torrent-id">
                <td class="col-sm-3 torrentinfoleft">
                    <strong>{{ __('torrent.id') }}:</strong>
                </td>
                <td class="col-sm-9 torrentinforight">
                    # {{ $torrent->id }}
                </td>
            </tr>

            <tr class="torrent-uploaded">
                <td class="col-sm-3 torrentinfoleft">
                    <strong>{{ __('torrent.uploaded') }}:</strong>
                </td>
                <td class="col-sm-9 torrentinforight">
                    {{ date('d.m.Y', $torrent->created_at->getTimestamp()) }} ob {{ date('H:m:s', $torrent->created_at->getTimestamp()) }}
                </td>
            </tr>

            <tr class="torrent-category">
                <td class="ccol-sm-3 torrentinfoleft">
                    <strong>{{ __('torrent.category') }}:</strong>
                </td>
                <td class="col-sm-9 torrentinforight">
                    <i class="{{ $torrent->category->icon }} torrent-icon torrent-icon-small" data-toggle="tooltip" data-original-title="{{ $torrent->category->name }} {{ __('torrent.torrent') }}"></i> {{ $torrent->category->name }}
                </td>
            </tr>

            <tr class="torrent-estimated-type">
                <td class="col-sm-3 torrentinfoleft">
                    <strong>{{ __('torrent.type') }}:</strong>
                </td>
                <td class="col-sm-9 torrentinforight">
                    {{ $torrent->type->name }}
                </td>
            </tr>

@if($torrent->category->movie_meta || $torrent->category->tv_meta || $torrent->category->cartoon_meta)
            <tr class="torrent-resolution">
                <td class="col-sm-3 torrentinfoleft">
                    <strong>{{ __('torrent.resolution') }}:</strong>
                </td>
                <td class="col-sm-9 torrentinforight">
                    {{ $torrent->resolution->name ?? 'Ni Resolucije' }}
                </td>
            </tr>
@endif

            <tr class="torrent-info-hash">
                <td class="col-sm-3 torrentinfoleft">
                    <strong>{{ __('torrent.info-hash') }}:</strong>
                </td>
                <td class="col-sm-9 torrentinforight">
                    {{ $torrent->info_hash }}
                </td>
            </tr>

            <tr class="torrent-thanked">
                <td class="col-sm-3 torrentinfoleft">
                    <strong>{{ __('torrent.bookmarks') }}:</strong>
                </td>
                <td class="col-sm-9 torrentinforight">
                    @livewire('bookmark-button', ['torrent' => $torrent->id])
                </td>
            </tr>

            <tr class="torrent-report">
                <td class="col-sm-3 torrentinfoleft">
                    <strong>{{ __('torrent.report') }}:</strong>
                </td>
                <td class="col-sm-9 torrentinforight">
                    <button type="submit" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modal_torrent_report">
                        <i class="{{ config('other.font-awesome') }} fa-fw fa-eye"></i> {{ __('torrent.report-torrent') }}
                    </button>
                </td>
            </tr>

            @if ($torrent->seeders == 0)
                <tr class="torrent-last-seed-activity">
                    <td class="col-sm-3 torrentinfoleft">
                        <strong>{{ __('torrent.last-seed-activity') }}:</strong>
                    </td>
                    <td class="col-sm-9 torrentinforight">
                        @if ($last_seed_activity)
                            <span class="text-orange">
                                <i class="{{ config('other.font-awesome') }} fa-fw fa-clock"></i> {{ $last_seed_activity->updated_at->diffForHumans() }}
                            </span>
                        @else
                            <span class="text-orange">
                                <i class="{{ config('other.font-awesome') }} fa-fw fa-clock"></i> {{ __('common.unknown') }}
                            </span>
                        @endif
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
</div>