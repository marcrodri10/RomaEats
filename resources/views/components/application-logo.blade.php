@php
    $path = $_SERVER['PHP_SELF'];
    $slashes = substr_count(trim($path, '/'), '/') - 1;
    $directoryPath = "";
    for($i = 0; $i < $slashes; $i++){
        $directoryPath .= '../';
    }
@endphp
<img src="{{$directoryPath}}img/romaeats.png" alt="logo" class="w-10 h-10" id="app-logo">

