@extends('layouts.app')
@section('content')
<head>
	   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.deep_purple-pink.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div id="app">
  
 <router-view name="browseListings"></router-view>
  <router-view></router-view>
  
</div>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</body>
@endsection