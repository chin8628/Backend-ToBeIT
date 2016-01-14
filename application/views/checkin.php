<body>
    <div class="container">
        {err}
        <div class="panel panel-default">
            <div class="panel-body">
                <h1>Check In</h1>
                <form method="get">
                    <div class="form-group">
                        <input type="text" class="form-control" name="search" placeholder="หมายเลขประจำตัว, ชื่อ, นามสกุล, ชื่อเล่น" autofocus>
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ชื่อ - นามสกุล</th>
                            <th>ชื่อเล่น</th>
                            <th>โรงเรียน</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {attendees}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>