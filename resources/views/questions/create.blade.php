@include('layouts.main')
@include('layouts.side-bar')

<script type="text/javascript">

function my(){
    var input=document.createElement('input');
    var radio=document.createElement('input');
    var fields=document.getElementById('newfields');
    var radioall=document.querySelectorAll('#radio');

    var count=radioall.length+1;

    input.setAttribute('type','text')
    input.setAttribute('placeholder','option')
    input.setAttribute('name','options[]')
    
    radio.setAttribute('type','radio')
    radio.setAttribute('name','answer')
    radio.setAttribute('value',count)
    radio.setAttribute('id','radio')

    fields.appendChild(input)
    fields.appendChild(radio)

}

</script>

<section>
    @include('layouts.dashboard')
<form method="POST" action="{{ route('questions.store',[$course,$unit,$test]) }}">
@csrf

<label>Type Your Question</label>
<input type="text" name="question">

<div>
    <button type="button" class="text-blue font-medium" id="btn" onClick="my()">+ Add More Option</button>
</div>

<div>
<label>Answer</label>
    <div id="newfields">
        <div>
            <input type="text" name="options[]" placeholder="option">
            <div class="text-danger">
                @error('options[]')
                    {{ $message }}
                @enderror
            </div>
            <input type="radio"  name="answer" value="1" id="radio">
            <div class="text-danger">
                @error('answer')
                    {{ $message }}
                @enderror
            </div>
        </div>    
        <div>
            <input type="text" name="options[]" placeholder="option">
            <div class="text-danger">
                @error('options[]')
                    {{ $message }}
                @enderror
            </div>
            <input type="radio" name="answer" value="2" id="radio">
            <div class="text-danger">
                @error('answer')
                    {{ $message }}
                @enderror
            </div>
        </div>
    </div>
</div>


<input type="submit" name="submit" value="Save">

</form>
</section>