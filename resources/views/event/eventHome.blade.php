@extends('layouts.event')
<link href="{{ asset('css/card.css') }}" rel="stylesheet">

@section('content')

<div class="eventbody">

<br><br><br><br><br><br>
    @role('or_pm|supervising_officer')
        <div class="col-md-11"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Create an Event &nbsp;&nbsp;&nbsp;</button></div>
    @endrole

    <br>
        <div class="col-md-11"><button type="button" onclick="location.href='{{ url('poll') }}'" class="btn btn-primary">View Vote Results</button></div>



 


<a href="{{ route('register') }}"></a>

<div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('message'))
                    <div class="flash-message">
                        <div class="alert alert-success">
                        <strong>
                            {{ session('message') }}
                        </strong>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="flash-message">
                        <div class="alert alert-danger">
                        <strong>
                            {{ session('error') }}
                        </strong>
                        </div>
                    </div>
                @endif

 


<a href="{{ route('register') }}"></a>

<div class="col-md-12">
                
    @foreach($event as $eventData)
        <div class="column">
            <div class="card">
                <div class="card-body" >

                        <h5 class="card-title">{{$eventData->id}}. {{$eventData->eventName}}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Reason : {{$eventData->reason}}</h6>
                        <h6 class="card-subtitle mb-2 text-muted">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Region : {{$eventData->region}}</h6>
                        <h6 class="card-subtitle mb-2 text-muted">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Budget : {{$eventData->budget}}</h6>
                        <h6 class="card-subtitle mb-2 text-muted">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Start date : {{$eventData->startDate}}</h6>
                        <h6 class="card-subtitle mb-2 text-muted">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Start time : {{$eventData->startTime}}</h6>
                        <h6 class="card-subtitle mb-2 text-muted">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;End time : {{$eventData->endTime}}</h6><br>&nbsp;&nbsp;&nbsp;&nbsp;
                        @role('or_pm|supervising_officer')
                        <a href="{{route('event.delete',['id' => $eventData->id]) }}" class="btn btn-danger btn-sm">Delete</a>
                        <a href="{{route('event.update',['id' => $eventData->id]) }}" class="btn btn-warning btn-sm">Update</a>
                        @endrole
                        @role('p_member|or_fol|or_pm|supervising_officer')
                       <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(if you need this event plz vote below)</p>
                       @endrole


                    <div class="vote">
                        @role('p_member|or_fol|or_pm|supervising_officer')
                        <button type="button" onclick="location.href='{{ route('voteAdd',['eventid' => $eventData->id] ) }}'" class="btn btn-success btn-sm">Vote</button>
                        @endrole
                    </div>

                </div>
            </div>
        </div>
    @endforeach

    
</div>

@endsection

@section('footer')
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
    
            <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
    
                      <h4 class="modal-title">Create an event</h4>
    
                    </div>
                        <form method="post" action="/eventSave">
                            {{csrf_field()}}
    
                            <div class="modal-body">
                                <div class="col-md-12 ">
    
                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                    <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                    </ul>
                                    </div>
                                    @endif
    
                                    <div class="form-group">
                                        <label for="usr">Event Name:</label>
                                        <input type="text" class="form-control" name="eventName" placeholder="Enter here" id="usr">
                                    </div>
    
                                    <div class="form-group">
                                        <label for="usr">Reason:</label>
                                        <input type="text" class="form-control" name="reason" placeholder="Enter here" id="usr">
                                     </div>
    
                                     <div class="form-group">
                                        <label for="usr">Region:</label>
                                        <input type="text" class="form-control" name="region" placeholder="Enter here" id="usr">
                                    </div>
    
                                    <div class="form-group">
                                        <label for="usr">Budget:</label>
                                        <input type="number" class="form-control" name="budget" placeholder="Enter here" id="usr">
                                    </div>
    
                                    <div class="form-group">
                                        <label for="usr">Start date:</label>
                                        <input type="date" class="form-control" name="startDate" placeholder="Enter here" id="usr">
                                    </div>
    
                                    <div class="form-group">
                                        <label for="usr">Start time:</label>
                                        <input type="time" class="form-control" name="startTime" placeholder="Enter here" id="usr">
                                    </div>
    
                                    <div class="form-group">
                                        <label for="usr">End time: </label>
                                        <input type="time" class="form-control" name="endTime" placeholder="Enter here" id="usr">
                                    </div>
    
                                    <div class="form-group">
                                        <label for="usr"><h4> Event creating by {{Auth::user()->name}}</h4> </label>
                                    </div>
    
                                    <div>
                                        <input type="submit" class="btn btn-primary" value="save">
                                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                                    </div>
    
                                </div>
    
                            </div>
    
                        </form>
                            <div class="modal-footer">
                           If you want you can update event later
    
                            </div>

                </div>
    
            </div>
        </div>
    
    </div>

@endsection