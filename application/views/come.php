<body>
    <div class="container">
        <div class="page-header">
            <h1>Check In</h1>
        </div>
        <form method="post">
            <section class="row">
                <div class="col-sm-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">ข้อมูลน้องโดยสังเขป</div>
                        <div class="panel-body">
                            <p>รหัสประจำตัว: {id_student}</p>
                            <p>ชื่อ - นามสกุล: {prename} {name} {surname}</p>
                            <p>ชื่อเล่น: {nickname}</p>
                            <p>โรงเรียน: {school}</p>
                            <p>ศาสนา: {religion}</p>
                            <p>ไซส์เสื้อ: {shirt}</p><br>
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        {chk_thead}
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        {chk_tbody}
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">เลือกเมนูอาหาร</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="room">เมนูอาหาร </label>
                                {menu_dropdown}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">เลือกห้องเรียน</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="room">ห้องเรียน </label>
                                {classroom}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="row">
                <div class="col-sm-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">เลือกเอกสารการเรียน</div>
                        <div class="panel-body">
                            {sheet_menu}
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <button type="submit" class="btn btn-success btn-lg">Checkin</button>
                        </div>
                    </div>
                </div>
            </section>
        </form>
    </div>
</body>