@extends('layouts.app')
@section('content')

<body>

<div id="app">
  
 <router-view name="singleListing"></router-view>
                        <router-view></router-view>

  
</div>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</body>
@endsection