@extends('templates.main')
@section('title', $mission->name)

@section('content')
<body class="past-mission" ng-controller="pastMissionController" ng-strict-di>

    @include('templates.header', array('backgroundImage' => !is_null($mission->featuredImage) ? $mission->featuredImage->media : ''))

    <div class="content-wrapper">
        <h1>{{ $mission->name }}</h1>
        <main>
            <nav class="in-page sticky-bar">
                <ul class="container">
                    <li class="gr-1">
                        <a href="#article">Article</a>
                    </li>
                    <li class="gr-1">
                        <a href="#details">Details</a>
                    </li>
                    <li class="gr-1">
                        <a href="#images">Images</a>
                    </li>
                    <li class="gr-1">
                        <a href="#videos">Videos</a>
                    </li>
                    <li class="gr-1">
                        <a href="#documents">Documents</a>
                    </li>
                    <li class="gr-1">
                        <a href="#articles">Articles</a>
                    </li>
                    <li class="gr-1">
                        <a href="#timeline">Timeline</a>
                    </li>
                    <li class="gr-1">
                        <a href="#analytics">Analytics</a>
                    </li>
                    @if (Auth::isAdmin())
                        <li class="gr-1 actions">
                            <a class="link" href="/missions/{{ $mission->slug }}/edit"><i class="fa fa-pencil"></i></a>
                        </li>
                    @endif
                    <li class="gr-1 mission-status-outcomes">
                        <span class="status complete"><i class="fa fa-flag"></i> {{ $mission->status }}</span>
                    </li>
                    <li class="gr-1 mission-status-outcomes">
                        @if ($mission->outcome == 'Success')
                            <span class="outcome success"><i class="fa fa-check"></i> Success</span>
                        @else
                            <span class="outcome failure"><i class="fa fa-times"></i> Failure</span>
                        @endif
                    </li>
                </ul>
            </nav>

            <section class="highlights">
                @if(isset($pastMission))
                    <a href="/missions/{{ $pastMission->slug }}">
                        <div class="mission-link past-mission-link">
                            <span class="placeholder">Previous Mission</span>
                            <span class="link"><i class="fa fa-arrow-left"></i> {{ $pastMission->name }}</span>
                        </div>
                    </a>
                @endif
                @if(isset($futureMission))
                    <a href="/missions/{{ $futureMission->slug }}">
                        <div class="mission-link future-mission-link">
                            <span class="link">{{ $futureMission->name }} <i class="fa fa-arrow-right"></i></span>
                            <span class="placeholder">Next Mission</span>
                        </div>
                    </a>
                @endif
            </section>

            {!! $mission->present()->article() !!}

            <h2>Details</h2>
            <section id="details" class="scrollto">
                @include('templates.cards.missionCard', ['size' => 'large', 'mission' => $mission])
                <div class="gr-8 gr-12@small">
                    <h3>Flight Details</h3>

                    @if ($mission->spacecraftFlight)
                        <h3>{{ $mission->spacecraftFlight->spacecraft->name }}</h3>
                        @include('templates.cards.spacecraftCard', ['spacecraftFlight' => $mission->spacecraftFlight])
                    @endif

                    @if ($mission->payloads->count() > 0)
                        <h3>Satellites Launched</h3>
                        @include('templates.cards.payloadsCard', ['mission' => $mission])
                    @endif

                    @if ($mission->upperStage)
                        <h3>{{ $mission->upperStage->part->name }} Upper Stage</h3>
                        @include('templates.cards.upperStageCard', ['mission' => $mission])
                    @endif
                </div>
                <div class="gr-4 gr-12@small">
                    <h3>Library</h3>
                    <ul class="library">

                        @if ($mission->launchVideo)
                            <li id="launch-video">
                                <span>Watch the Launch</span>
                            </li>
                        @endif

                        @if ($mission->missionPatch)
                            <li id="mission-patch">
                                <img src="{{ $mission->missionPatch->thumb_small }}"/>
                                <span>{{ $mission->name }} Mission Patch</span>
                            </li>
                        @endif

                        @if ($mission->pressKit)
                            <li id="press-kit">
                                <span>Press Kit</span>
                            </li>
                        @endif

                        @if($mission->cargoManifest)
                            <li id="cargo-manifest">
                                <span>Cargo Manifest</span>
                            </li>
                        @endif

                        @if ($mission->prelaunchPressConference)
                            <li id="prelaunch-press-conference">
                                <span>Prelaunch Press Conference</span>
                            </li>
                        @endif

                        @if ($mission->postlaunchPressConference)
                            <li id="postlaunch-press-conference">
                            <span>Postlaunch Press Conference</span>
                        </li>
                        @endif

                        @if ($mission->redditDiscussiob)
                            <li id="reddit-discussion">
                                <span>/r/SpaceX Reddit Live Thread</span>
                            </li>
                        @endif

                        @if ($mission->flightclub)
                            <li id="flightclub-link">
                                <span>FlightClub Simulation</span>
                            </li>
                        @endif

                        <li id="mission-collection">
                            <a href="/missioncontrol/collections/mission/{{ $mission->slug }}">{{ $mission->name }} Mission Collection</a>
                        </li>

                        @if (Auth::isMember())
                            <li id="raw-data-download">
                                <span><a href="/missions/{{ $mission->slug }}/raw">Raw Data Download</a></span>
                            </li>
                        @endif
                    </ul>
                </div>
            </section>

            <h2>Images</h2>
            <section id="images" class="scrollto">
                @if ($images->count() > 0)
                    @foreach ($images as $image)
                        <div class="square">
                            <img src="" alt="" class="square" />
                        </div>
                    @endforeach
                    @if ($images->count() > 20)
                        <div class="square">
                            {{ $images->count() - 20 }} more...
                        </div>
                    @endif
                @else
                    @if (Auth::isSubscriber())
                        <p class="exclaim">No images</p>
                    @else
                        <p class="exclaim">No public images</p>
                    @endif
                @endif
            </section>

            <h2>Videos</h2>
            <section id="videos" class="scrollto container">
                @if ($mission->launch_video)
                    <div class="gr-8">
                        <h3>Launch Video</h3>
                    </div>
                @endif
                <div class="gr-4 {{ $mission->launch_video != null ? 'launch-video' : 'no-launch-video' }}">

                </div>

            </section>

            <h2>Documents</h2>
            <section id="documents" class="scrollto">
                @foreach($documents as $document)
                @endforeach
            </section>

            <h2>Articles</h2>
            <section id="articles" class="scrollto">
                @foreach ($mission->articles() as $article)
                @endforeach
            </section>

            <h2>Timeline</h2>
            <section id="timeline" class="scrollto">
                <h3>Prelaunch</h3>
                @if ($mission->prelaunchEvents->count() > 0)
                    <table>
                        <tr>
                            <th>Occurred At</th>
                            <th>Event Type</th>
                            <th>Summary</th>
                            <th>Scheduled Lauch at time of event</th>
                        </tr>
                        @foreach ($mission->prelaunchEvents as $prelaunchEvent)
                            <tr>
                                <td>{{ $prelaunchEvent->occurred_at }}</td>
                                <td>{{ $prelaunchEvent->event }}</td>
                                <td>{{ $prelaunchEvent->summary }}</td>
                                <td>{{ $prelaunchEvent->scheduled_launch_date_time }}</td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <p class="exclaim">No Prelaunch Events</p>
                @endif

                <h3>Launch</h3>
                    @if ($mission->telemetry->count() > 0)
                        <p>The following data represents telemetry and readouts from the countdown net & webcast at SpaceX's Hawthorne HQ.</p>
                        <table class="data-table">
                            <tr>
                                <th>Timestamp</th>
                                <th>Readout</th>
                            </tr>
                            @foreach($mission->telemetry as $telemetry)
                                <tr>
                                    <td>{{ $telemetry->formatted_timestamp }}</td>
                                    <td>{{ $telemetry->readout }}</td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p class="exclaim">No telemetry yet!</p>
                    @endif
                <h3>Postlaunch</h3>
                <p class="exclaim">Postlaunch information coming soon!</p>
            </section>

            <h2>Analytics</h2>
            <section id="analytics" class="scrollto">
                @if(Auth::isSubscriber())
                    <h3>Dataplots</h3>
                    @if ($mission->positionalTelemetry->count() > 0)
                        <p>These dataplots are based on kinematic data extracted from the countdown net during launch, and are only approximate. For more detailed simulations, refer to the FlightClub entry for this launch.</p>
                        <ul class="container">
                            <li class="gr-4 gr-12@small">
                                <chart class="dataplot" data="altitudeVsTime.data" settings="altitudeVsTime.settings" width="100%" height="400px"></chart>
                            </li>
                            <li class="gr-4 gr-12@small">
                                <chart class="dataplot" data="velocityVsTime.data" settings="velocityVsTime.settings" width="100%" height="400px"></chart>
                            </li>
                            <li class="gr-4 gr-12@small">
                                <chart class="dataplot" data="downrangeVsTime.data" settings="downrangeVsTime.settings" width="100%" height="400px"></chart>
                            </li>
                            <li class="gr-4 gr-12@small">
                                <chart class="dataplot" data="altitudeVsDownrange.data" settings="altitudeVsDownrange.settings" width="100%" height="400px"></chart>
                            </li>
                        </ul>

                        <h3>Interpolation Queries</h3>
                        <p class="exclaim">Interpolation Queries coming soon!</p>
                    @else
                        <p class="exclaim">This launch does not have positional telemetry.</p>
                    @endif

                    <h3>Upper Stage</h3>
                    @if ($mission->orbitalElements->count() != 0)
                        {{ $orbitalElements->first()->apogee }}km x {{ $orbitalElements->first()->perigee }}km, inclined {{ $orbitalElements->first()->inclination }}deg

                        <h4>Latest TLE</h4>
                        <div class="tle">
                            <p>{{ $orbitalElements->first()->object_name }}</p>
                        </div>

                        <h4>Last 5 Orbital Elements</h4>
                        <table>
                            <tr>
                                <th>Epoch</th>
                                <th>Perigee</th>
                                <th>Apogee</th>
                                <th>Inclination</th>
                                <th>Eccentricity</th>
                                <th>Semimajor Axis</th>
                                <th>Orbital Period</th>
                            </tr>
                        </table>
                    @else
                        <p class="exclaim">No orbital element data at this time.</p>
                    @endif

                    <h3>Maps</h3>
                    <p class="exclaim">Maps coming soon!</p>
                @else
                    <p class="should-subscribe exclaim">Subscribe to Mission Control to see mission analytics.</p>
                @endif
            </section>
        </main>
    </div>
</body>
@stop