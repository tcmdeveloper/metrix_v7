@props([
    'alert',
    'type',
])

@if(session()->has('alert'))
    <div class="alert-warning">
        <i class="fa-solid fa-lock"></i>
        {{session('alert')}}
    </div>

@elseif(isset($alert))
    <div {{$attributes->merge(['class' => 'alert-'.(isset($type) ? $type : 'success')])}}>
        <i class="fa-solid fa-info-circle"></i>
        {{$alert}}
    </div>

@elseif(isset($formError))

    <div class="alert-danger">
        <i class="fa-solid fa-lock"></i>
        {{$formError}}
    </div>
    
@endif


