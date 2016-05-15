<div class="panel panel-default">
    <div class="panel-heading">
        <strong>Your study history</strong>
    </div>
    <div class="panel-body">

        @if(count($user->studies) == 0)
            <p style="text-align: center;">
                <strong>
                    No studies registered for this user.
                </strong>
            </p>
        @else
            @foreach($user->studies as $study)
                <div class="panel panel-default">
                    <div class="panel-body">

                        <p style="text-align: center">

                            <strong>{{ $study->name }}</strong><br>
                            {{ $study->faculty }}

                            <br>

                            @if($study->pivot->end == null)
                                Since {{ date('d-m-Y',$study->pivot->start) }}
                            @else
                                Between {{ date('d-m-Y',$study->pivot->start) }}
                                and {{ date('d-m-Y',$study->pivot->end) }}
                            @endif

                        </p>

                    </div>

                    <div class="panel-footer">

                        <div class="row">

                            <div class="col-md-6">
                                <div class="btn-group-justified btn-group" role="group">
                                    <a type="button" class="btn btn-default"
                                       href="{{ route("user::study::edit", ["user_id" =>$user->id ,"link_id" => $study->pivot->id]) }}"><i
                                                class="fa fa-pencil"></i></a>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="btn-group btn-group-justified" role="group">
                                    <a type="button" class="btn btn-danger"
                                       href="{{ route('user::study::delete', ['link_id' => $study->pivot->id, 'user_id' => $user->id]) }}"><i
                                                class="fa fa-trash-o"></i></a>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <div class="panel-footer">
        <div class="btn-group btn-group-justified" role="group">
            <div class="btn-group" role="group">
                <a type="button" class="btn btn-success" href="{{ route('user::study::add', ['id' => $user->id]) }}">
                    Add another study
                </a>
            </div>
        </div>
    </div>
</div>