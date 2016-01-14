<body>
    <div class="container">
        <div class="page-header">
            <h1>Attendee's profile <small>(#{id_student})</small></h1>
        </div>

        <form class="form-horizontal" method="post" action="submit_edit">
            <section class="row">
                <div class="container col-sm-7">
                    <div class="panel panel-default">
                        <div class="panel-heading">ข้อมูลทั่วไป</div>
                        <div class="panel-body">
                            <input type="hidden" class="form-control" name="id" value="{id_user}" >
                            <div class="form-group">
                                <label for="prename" class="col-sm-3 control-label">คำนำหน้า</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="prename" name="prename" value="{prename}" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">ชื่อ</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" value="{name}" name="name" id="name" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="surname" class="col-sm-3 control-label">นามสกุล</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" value="{surname}" name="surname" id="surname" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nickname" class="col-sm-3 control-label">ชื่อเล่น</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" value="{nickname}" name="nickname" id="nickname" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="religion" class="col-sm-3 control-label">ศาสนา</label>
                                <div class="col-sm-8">
                                    {religion}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="school" class="col-sm-3 control-label">สถาบันการศึกษา</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" value="{school}" name="school" id="school" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="level" class="col-sm-3 control-label">ระดับชั้นเรียน</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" value="{level}" name="level" id="level" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="expectation" class="col-sm-3 control-label">ความคาดหวังในกิจกรรมนี้</label>
                                <div class="col-sm-8">
                                  <textarea class="form-control" rows="3" name="expectation" id="expectation">{expectation}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="shirt" class="col-sm-3 control-label">ไซส์เสื้อยืด ToBeIT59</label>
                                <div class="col-sm-8">
                                    {shirt}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="expectation" class="col-sm-3 control-label">จำนวนวันที่จะมาเรียน TobeIT</label>
                                <div class="col-sm-8">
                                    <div class="radio">
                                        <label class="radio-inline" style="font-weight: 200;">
                                            <input type="radio" name="checkin" value="1" {checkin_all_day}>
                                            มาเรียนครบทุกวัน
                                        </label>
                                        <label class="radio-inline" style="font-weight: 200;">
                                            <input type="radio" name="checkin" value="2" {checkin_some_day}>
                                            มาเรียนเป็นบางวัน
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"></label>
                                <div class="col-sm-9">
                                    <input name="direct_ent" id="direct_ent" type="checkbox" value="1" {direct_ent}> สมัครรับตรงไอทีลาดกระบังแล้ว
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">การเข้าเรียน</div>
                        <div class="panel-body">
                            <table class="table table-bordered text-center">
                                <tbody>
                                    {select_checkin}
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">เลือกเอกสารการเรียน</div>
                        <div class="panel-body">
                            {sheet_menu}
                        </div>
                    </div>
                </div>

                <div class="container col-sm-5 row">
                    <div class="panel panel-default">
                        <div class="panel-heading">ข้อมูลทางการแพทย์</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="helth_problem" class="col-sm-3 control-label">ปัญหาทางสุขภาพ</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{health_problem}" name="health_problem" id="health_problem">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="allergy" class="col-sm-3 control-label">อาการแพ้</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{allergy}" name="allergy" id="allergy">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">การติดต่อ</div>
                        <div class="panel-body">
                            <form class="form-horizontal" method="post">
                                <div class="form-group">
                                    <label for="phone" class="col-sm-4 control-label">เบอร์โทร</label>
                                    <div class="col-sm-7">
                                      <input type="text" class="form-control" value="{phone}" name="phone" id="phone" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="parent_phone" class="col-sm-4 control-label">เบอร์โทรผู้ปกครอง</label>
                                    <div class="col-sm-7">
                                      <input type="text" class="form-control" value="{parent_phone}" name="parent_phone" id="parent_phone" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="trip" class="col-sm-4 control-label">การเดินทางมา</label>
                                    <div class="col-sm-7">
                                        {trip}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="return_trip" class="col-sm-4 control-label">การเดินทางกลับ</label>
                                    <div class="col-sm-7">
                                        {return_trip}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="facebook" class="col-sm-4 control-label">Facebook</label>
                                    <div class="col-sm-7">
                                        <div class="input-group">
                                            <div class="input-group-addon">facebook.com/</div>
                                            <input type="text" class="form-control" value="{facebook}" name="facebook" id="facebook">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">ห้องเรียน</div>
                        <div class="panel-body">
                            <p>เลือกห้องเรียน</p>
                            {classroom}
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">บันทึกผล</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-1">
                                    หมายเหตุ: กรอกข้อมูลในช่องที่มีเครื่องหมายดอกจันทร์ (*) ให้ครบ
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-1">
                                    <button type="submit" class="btn btn-success">บันทึก</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
        </form>
    </div>
</body>