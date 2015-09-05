@extends('templates.main')
@section('title', 'About Mission Control')

@section('content')
<body class="edit-mission" ng-app="missionApp" ng-controller="missionController" ng-strict-di>

    @include('templates.flashMessage')
    @include('templates.header')

    <div class="content-wrapper">
        <h1>Editing Mission [[ mission.name ]]</h1>
        <main>
        </main>
    </div>

    <script type="text/javascript">
        angular.module("missionApp").constant("CSRF_TOKEN", '{{ csrf_token() }}');
    </script>
</body>
@stop

