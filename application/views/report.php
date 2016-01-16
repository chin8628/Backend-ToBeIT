<body>
    <div class="container">
        <section class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">รายชื่อสั่งอาหาร</div>
                <div class="panel-body">
                    <form method="get" action="report/order_food">
                        <div class="form-group">
                            <select class="form-control" name="menu">
                                {menu_food}
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </section>
        <section class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">รายชื่อห้องเรียน</div>
                <div class="panel-body">
                    <form method="get" action="report/list_attendee_in_room">
                        <div class="form-group">
                            <select class="form-control" name="room">
                                {room_class}
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</body>