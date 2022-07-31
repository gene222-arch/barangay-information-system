@extends('layouts.dashboard')

@section('css')

    <style>
        .fc-content {
            color: white;
            text-transform: uppercase;
        }
    </style>

@endsection

@section('content')
    <div class="text-right">
        <a 
            href="{{ route('export.schedules') }}"
            class="btn btn-outline-danger mb-2 px-2"
            data-toggle="tooltip" 
            data-placement="left" 
            title="Print"
            data-html="true"
        >
            <i class="fas fa-file-pdf px-1"></i>
        </a>
    </div>
    <div id='calendar'></div>
@endsection

@section('js')
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" /> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <script>
        const displayMessage = (message) => toastr.success(message, 'Event');

        $(document).ready(function () 
        {
            const APP_URL = "{{ url('/') }}";
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            const calendar = $('#calendar')
                .fullCalendar({
                    editable: true,
                    events: `${ APP_URL }/schedules`,
                    displayEventTime: false,
                    header: {
                        left: 'prev,next,today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    editable: true,
                    eventRender: (event, element, view) => {
                        event.allDay = event.allDay === 'true';
                    },
                    selectable: true,
                    selectHelper: true,
                    select: (start, end, allDay) => // POST request
                    {
                        let title = prompt('Event Title:');

                        if (title) 
                        {
                            var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                            var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                            
                            $.ajax({
                                url: `${ APP_URL }/schedules`,
                                type: "POST",
                                data: {
                                    title: title,
                                    start: start,
                                    end: end
                                },
                                success: (data) => 
                                {
                                    displayMessage("Event Created Successfully");

                                    const renderData = {
                                        id: data.id,
                                        title: title,
                                        start: start,
                                        end: end,
                                        allDay: allDay
                                    };

                                    calendar.fullCalendar('renderEvent', renderData, true);
                                    calendar.fullCalendar('unselect');
                                }
                            });
                        }
                    },
                    eventDrop: (event, delta) => // PUT request
                    {
                        var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                        var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");

                        $.ajax({
                            url: `${ APP_URL }/schedules/${ event.id }`,
                            type: "PUT",
                            data: {
                                title: event.title,
                                start: start,
                                end: end,
                                id: event.id
                            },
                            success: (response) => {
                                displayMessage("Event Updated Successfully");
                            }
                        });
                    },
                    eventClick: (event) => // DELETE request
                    {
                        var deleteMsg = confirm("Do you really want to delete?");

                        if (deleteMsg) 
                        {
                            $.ajax({
                                type: "DELETE",
                                url: `${ APP_URL }/schedules/${ event.id }`,
                                success: (response) => {
                                    calendar.fullCalendar('removeEvents', event.id);
                                    displayMessage("Event Deleted Successfully");
                                }
                            });
                        }
                    }
            });
        });
    </script>
@endsection