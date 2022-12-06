  @props([
  'error' => false,
  ])
  <input type="file" {{$attributes(['class'=>'custom-file-input'])}}>
  <label class="custom-file-label">{{ $slot->isEmpty() ? 'Choose Image' : $slot }}</label>
  @if ($error)
  <x-form.error>{{$error}}</x-form.error>
  @endif
