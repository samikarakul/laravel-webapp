@component('mail::message')
# Your post was liked

{{-- {{ $liker->name }} liked one of your posts! --}}

Username : {{ $new_request -> username }}

{{-- @component('mail::button', ['url' => route('posts.show', $post)]) --}}
@component('mail::button', ['url' => route('posts')])
Button Text
<button>bu yeni button</button>
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
