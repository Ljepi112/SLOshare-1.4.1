<li>
    <article class="comment">
        <header class="comment__header">
            <img
                    class="comment__avatar"
                    src="{{ url((!$comment->anon && $comment->user->image !== null) ? 'files/img/'.$comment->user->image : '/img/profile.png') }}"
                    alt=""
            >
            <address class="comment__author">
                <x-user_tag :user="$comment->user :anon="false""/>
            </address>
            <time
                    class="comment__timestamp"
                    datetime="{{ $comment->created_at }}"
                    title="{{ $comment->created_at }}"
            >
                {{ date('d.m.Y', $comment->created_at->getTimestamp()) }}
            </time>
            <menu class="comment__actions">
                @if ($comment->isParent())
                    <button wire:click="$toggle('isReplying')" class="comment__reply">
                        <abbr class="comment__reply-abbr" title="Odgovori na ta komentar">
                            <i class="{{ config('other.font-awesome') }} fa-reply"></i>
                            <span class="sr-only">__('pm.reply')</span>
                        </abbr>
                    </button>
                @endif
                @if (auth()->user()->group->is_modo)
                    <button wire:click="$toggle('isEditing')" class="comment__edit">
                        <abbr class="comment__edit-abbr" title="{{ __('common.edit-your-comment') }}">
                            <i class="{{ config('other.font-awesome') }} fa-pencil"></i>
                            <span class="sr-only">__('common.edit')</span>
                        </abbr>
                    </button>
                    <button
                            class="comment__delete"
                            x-on:click="confirmCommentDeletion"
                            x-data="{
                            confirmCommentDeletion () {
                                if (window.confirm('Si prepričan?')) {
                                @this.call('deleteComment')
                                }
                            }
                        }"
                    >
                        <abbr class="comment__delete-abbr" title="{{ __('common.delete-your-comment') }}">
                            <i class="{{ config('other.font-awesome') }} fa-trash"></i>
                            <span class="sr-only">__('common.delete')</span>
                        </abbr>
                    </button>
                @endif
            </menu>
        </header>
        @if ($isEditing)
        @if (auth()->user()->group->is_modo)
            <form wire:submit.prevent="editComment" class="form edit-comment">
                <p class="form__group">
                    <textarea
                            name="comment"
                            id="edit-comment"
                            class="form__textarea"
                            aria-describedby="edit-comment__textarea-hint"
                            wire:model.defer="editState.content"
                            required
                    ></textarea>
                    <label for="edit-comment" class="form__label form__label--floating">
                        @error('editState.content')
                        <strong>{{ __('common.error') }}: </strong>
                        @enderror
                        Uredi svoj komentar...
                    </label>
                    @error('editState.content')
                    <span class="form__hint" id="edit-comment__textarea-hint">{{ $message }}</p>
                @enderror
                </p>
                <p class="form__group">
                    <button type="submit" class="form__button form__button--filled">
                        {{ __('common.edit') }}
                    </button>
                    <button type="button" wire:click="$toggle('isEditing')" class="form__button form__button--text">
                        {{ __('common.cancel') }}
                    </button>
                </p>
            </form>
        @endif
        @else
            <p class="comment__content">
                @joypixels($comment->getContentHtml())
            </p>
        @endif
    </article>

    @if ($comment->isParent())
        <section class="comment__replies">
            <h5 class="sr-only">Odgovori</h5>
            @if ($isReplying)
                <form wire:submit.prevent="postReply" class="form reply-comment">
                    <p class="form__group">
                        <textarea
                                name="comment"
                                id="reply-comment"
                                class="form__textarea"
                                aria-describedby="reply-comment__textarea-hint"
                                wire:model.defer="replyState.content"
                                required
                        ></textarea>
                        <label for="reply-comment" class="form__label form__label--floating">
                            @error('editState.content')
                            <strong>{{ __('common.error') }}: </strong>
                            @enderror
                            Odgovori na komentar...
                        </label>
                        @error('replyState.content')
                        <span class="form__hint" id="reply-comment__textarea-hint">{{ $message }}</p>
                    @enderror
                    </p>
                    <!--<p class="form__group">
                        <input type="checkbox" id="reply-anon" class="form__checkbox" wire:modal="anon">
                        <label for="reply-anon" class="form__label">{{ __('common.anonymous') }}?</label>
                    </p>-->
                    <input type="hidden" name="anon" value="0">
                    <p class="form__group">
                        <button type="submit" class="form__button form__button--filled">
                            {{ __('common.comment') }}
                        </button>
                        <button type="button" wire:click="$toggle('isReplying')"
                                class="form__button form__button--text">
                            {{ __('common.cancel') }}
                        </button>
                    </p>
                </form>
            @endif
            @if ($comment->children->count() > 0)
                <ul class="comment__reply-list">
                    @foreach ($comment->children as $child)
                        <livewire:comment :comment="$child" :key="$child->id"/>
                    @endforeach
                </ul>
            @endif
        </section>
    @endif
</li>