<form
    method="POST"
    action="{{ route("resetRequest", ['id' => $torrentRequest->id]) }}"
    x-data
>
    @csrf
    <div class="form__group form__group--short-horizontal">
        <button
            x-on:click.prevent="Swal.fire({
                title: 'Ali si prepričan?',
                text: 'Ali ste prepričani, da želite ponastaviti to zahtevo za torrent?',
                icon: 'warning',
                showConfirmButton: true,
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    $root.submit();
                }
            })"
            class="form__button form__button--filled form__button--centered"
        >
            {{ __('request.reset') }}
        </button>
    </div>
</form>
