<section class="panelV2">
    <header class="panel__header">
        <h2 class="panel__heading">Seznam za spremljanje</h2>
        <div class="panel__actions">
            <div class="panel__action">
                <p class="form__group">
                    <select
                        id="quantity"
                        class="form__select"
                        wire:model="perPage"
                        required
                    >
                        <option>25</option>
                        <option>50</option>
                        <option>100</option>
                    </select>
                    <label class="form__label form__label--floating" for="quantity">
                        {{ __('common.quantity') }}
                    </label>
                </p>
            </div>
            <div class="panel__action">
                <p class="form__group">
                    <input
                        id="search"
                        class="form__text"
                        type="text"
                        wire:model="search"
                        placeholder=""
                    />
                    <label class="form__label form__label--floating" for="search">
                        Iskanje po sporočilu
                    </label>
                </p>
            </div>
        </div>
    </header>
    <div class="data-table-wrapper">
        <table class="data-table">
            <tbody>
            <tr>
                <th wire:click="sortBy('user_id')" role="columnheader button">
                    Gledanje
                    @include('livewire.includes._sort-icon', ['field' => 'user_id'])
                </th>
                <th wire:click="sortBy('staff_id')" role="columnheader button">
                    Gledal
                    @include('livewire.includes._sort-icon', ['field' => 'staff_id'])
                </th>
                <th wire:click="sortBy('message')" role="columnheader button">
                    Sporočilo
                    @include('livewire.includes._sort-icon', ['field' => 'message'])
                </th>
                <th wire:click="sortBy('created_at')" role="columnheader button">
                    Ustvarjeno pri
                    @include('livewire.includes._sort-icon', ['field' => 'created_at'])
                </th>
                <th>{{ __('common.action') }}</th>
            </tr>
            @forelse ($watchedUsers as $watching)
                <tr>
                    <td>
                        <x-user_tag :anon="false" :user="$watching->user" />
                    </td>
                    <td>
                        <x-user_tag :anon="false" :user="$watching->author" />
                    </td>
                    <td>{{ $watching->message }}</td>
                    <td>
                        <time datetime="{{ $watching->created_at }}">{{ $watching->created_at }}</time>
                    </td>
                    <td>
                        <menu class="data-table__actions">
                            <li class="data-table__action">
                                <form
                                    action="{{ route('staff.watchlist.destroy', ['id' => $watching->id]) }}"
                                    method="POST"
                                    x-data
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        x-on:click.prevent="Swal.fire({
                                            title: 'Ali si prepričan?',
                                            text: 'Ali ste prepričani, da želite preklicati spremljanje tega uporabnika?: {{ $watching->user->username }}?',
                                            icon: 'warning',
                                            showConfirmButton: true,
                                            showCancelButton: true,
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                $root.submit();
                                            }
                                        })"
                                        class="form__button form__button--text"
                                    >
                                        Prekliči ogled
                                    </button>
                                </form>
                            </li>
                        </menu>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Ni opazovanih uporabnikov</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    {{ $watchedUsers->links('partials.pagination') }}
</section>
