<?php
if(Auth::user()){
    $user_name = Auth::user()->name;
} else {
    $user_name = '';
}
?>

<navbar-component 
    app_name="{{ config('app.name', 'Laravel') }}"
    :user_name = "'{{$user_name}}'"
    :token = "'{{csrf_token()}}'"
></navbar-component>
