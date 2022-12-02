<div id="editChatStatus-{{ $chatstatus->id }}" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog{{ modal_style() }}">
        <div class="modal-content">

            <div class="modal-header" style="text-align: center;">
                <h3>{{ __('common.edit') }} Status klepeta ({{ $chatstatus->name }})</h3>
            </div>

            <form class="form-horizontal" role="form" method="POST"
                  action="{{ route('staff.statuses.update', ['id' => $chatstatus->id]) }}">
                @csrf
                <div class="modal-body" style="text-align: center;">
                    <h4>Vnesite nove nastavitve, ki jih želite uporabiti {{ $chatstatus->name }}</h4>
                    <label for="chatstatus_name"> {{ __('common.name') }}:</label> <label for="name"></label><input
                            style="margin:0 auto; width:300px;" type="text" class="form-control" name="name" id="name"
                            placeholder="Vnesite {{ __('common.name') }} Tukaj..." value="{{ $chatstatus->name }}" required>
                    <label for="chatstatus_color"> Barva:</label> <label for="color"></label><input
                            style="margin:0 auto; width:300px;" type="text" class="form-control" name="color" id="color"
                            placeholder="Tukaj vnesite šestnajstiško barvno kodo..." value="{{ $chatstatus->color }}" required>
                    <label for="chatstatus_icon"> Icon:</label> <label for="icon"></label><input
                            style="margin:0 auto; width:300px;" type="text" class="form-control" name="icon" id="icon"
                            placeholder="Tukaj vnesite kodo Font Awesome..." value="{{ $chatstatus->icon }}" required>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-md btn-primary" data-dismiss="modal">{{ __('common.cancel') }}</button>
                    <input class="btn btn-md btn-success" type="submit">
                </div>
            </form>
        </div>
    </div>
</div>

<div id="deleteChatStatus-{{ $chatstatus->id }}" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog{{ modal_style() }}">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">{{ __('common.delete') }} Status klepeta({{ $chatstatus->name }}) Za stalno</h4>
            </div>

            <form class="form-horizontal" role="form" method="POST"
                  action="{{ route('staff.statuses.destroy', ['id' => $chatstatus->id]) }}">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>Ste prepričani o tem?</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-md btn-primary"
                            data-dismiss="modal">{{ __('common.cancel') }}</button>
                    <input class="btn btn-md btn-danger" type="submit">
                </div>
            </form>
        </div>
    </div>
</div>
