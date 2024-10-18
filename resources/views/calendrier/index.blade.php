<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="stylesheet" href={{asset('admin.css')}}>
    <style>
      
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            {{-- <img src="refine-logo.png" alt="Refine Logo"> --}}
            Location Voiture
        </div>
        <div class="menu-item">🎫 <a href="/reservations">Reservations</a></div>
        <div class="menu-item">🚗 <a href="/voitures">Voitures</a></div>
        <div class="menu-item">👥 <a href="/clients">Clients</a></div>
        <div class="menu-item">👨‍✈️ <a href="/admins">Admins</a></div>
        <div class="menu-item">📆 <a href="/saisons">Saisons</a></div>
        <div class="menu-item">🛠️ <a href="/accessoires">Accessoires</a></div>
        <div class="menu-item">🧾 <a href="/charges">Charges</a></div>
        <div class="menu-item">📊 <a href="/bilan">Bilan</a></div>
        <div class="menu-item">📅 <a href="/calendrier">Calendrier</a></div>
    </div>
    <div class="main-content">
        <div class="header">
            <h1>Calendrier des reservation</h1>
            <div class="user-info">
                <span>{{session('admin_name')}}</span>
                <form action={{route('adminLogout')}} method="POST">
                    @csrf
                    <button type="submit" class="log-out">Log out</button>
                </form>
            </div>
        </div>
        
    
        <div class="panel panel-primary">
            <div class="panel-body">
                <div id="alert_message_area"></div>
                <div id='calendar'></div>
            </div>
        </div>
    
        <!-- Event Information Modal -->
        <div class="modal fade" id="event_info_modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content admin-form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Event Information</h4>
                    </div>
                    <div class="modal-body">
                        <div id="event_info_alert"></div>
                        <div class="row">
                            <div class="col-lg-12 col-xs-12">
                                <div class="form-group">
                                    <label>Reservation: </label>
                                    <input type="text" id="title" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-xs-12">
                                <div class="form-group">
                                    <label>Debut: </label>
                                    <input type="text" id="start_date" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xs-12">
                                <div class="form-group">
                                    <label>Fin: </label>
                                    <input type="text" id="end_date" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        
    
    </div>
          
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js'></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>

    <script>
    $(document).ready(function () {
        var calendarData = @json($reservations);

        console.log(calendarData);

        $('#calendar').fullCalendar({
            height: 800,
            header: {
                left: 'today',
                center: 'title',
                right: 'prevYear,prev,next,nextYear'
            },
            customButtons: {
                today: {
                    text: 'Today',
                    click: function() {
                        $('#calendar').fullCalendar('gotoDate', moment()); 
                        $('#calendar').fullCalendar('changeView', 'month'); 
                    }
                },
                prevYear: {
                    text: '<<',
                    click: function() {
                        $('#calendar').fullCalendar('prevYear');
                    }
                },
                prev: {
                    text: '<',
                    click: function() {
                        $('#calendar').fullCalendar('prev');
                    }
                },
                next: {
                    text: '>',
                    click: function() {
                        $('#calendar').fullCalendar('next');
                    }
                },
                nextYear: {
                    text: '>>',
                    click: function() {
                        $('#calendar').fullCalendar('nextYear');
                    }
                }
            },
            views: {
                month: {
                    titleFormat: 'MMMM YYYY'
                }
            },
            defaultView: 'month',
            events: calendarData, 
            editable: false,
            droppable: false,
            eventTextColor: "#FFF",
            eventColor: "#337AB7",
            selectable: true,
            eventClick: function (event) {
                $('#title').val(event.title);
                $('#start_date').val(moment(event.start).format('YYYY-MM-DD')); 
                $('#end_date').val(moment(event.end).format('YYYY-MM-DD')); 
                $('#event_info_modal').modal('show');
            }
        });
    });

    </script>
</body>
</html>

