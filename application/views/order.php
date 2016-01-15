<body>
    <div class="container">
        <div class="col-sm-8">
            {alert}
            <div class="panel panel-default">
                <div class="panel-heading">ข้อมูลรายการสั่งซื้อ</div>
                <div class="panel-body">
                    <p>เลขประจำตัว: {id_student}</p>
                    <p>ชื่อ - นามสกุล: {prename} {name} {surname}</p>
                    <p>ชื่อเล่น: {nickname}</p>
                    <p>โรงเรียน: {school}</p>
                    <hr>
                    <p>เอกสารการเรียนที่สั่งในวันนี้: {sheet_today}</p>
                    <p>เมนูอาหารที่สั่ง: {food}</p>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">Find attendee's order</div>
                <div class="panel-body">
                    <form method="get">
                        <div class="form-group">
                            <label for="id">Attendee's ID</label>
                            <input type="text" class="form-control" name="id" autofocus>
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>