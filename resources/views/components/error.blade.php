@props(['name'])


<div class="text-danger">
    @error($name)
        {{$message}}
    @enderror
</div>