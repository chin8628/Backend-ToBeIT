<body>
    <div class="container">
        <div class="page-header">
            <h1>ลงทะเบียน</h1>
        </div>

        <form class="form-horizontal" method="post">
            <section class="row">
                <div class="container col-sm-7">

                    <div class="panel panel-default">
                        <div class="panel-heading">ข้อมูลทั่วไป</div>
                        <div class="panel-body">
                            <input type="hidden" class="form-control" name="id" value="{id_user}" >
                            <div class="form-group">
                                <label for="prename" class="col-sm-3 control-label"><span style="color: red">*</span> คำนำหน้า</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="prename" name="prename" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label"><span style="color: red">*</span> ชื่อ</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" name="name" id="name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="surname" class="col-sm-3 control-label"><span style="color: red">*</span> นามสกุล</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" name="surname" id="surname" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nickname" class="col-sm-3 control-label"><span style="color: red">*</span> ชื่อเล่น</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" name="nickname" id="nickname" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="religion" class="col-sm-3 control-label"><span style="color: red">*</span> ศาสนา</label>
                                <div class="col-sm-8">
                                    <select name="religion" class="form-control" id="religion">
                                        <option value="พุทธ" selected="selected">พุทธ</option>
                                        <option value="คริสต์">คริสต์</option>
                                        <option value="อิสลาม">อิสลาม</option>
                                        <option value="ไม่มีศาสนา">ไม่มีศาสนา</option>
                                        <option value="อื่น ๆ">อื่น ๆ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="school" class="col-sm-3 control-label"><span style="color: red">*</span> สถาบันการศึกษา</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" name="school" id="school" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="level" class="col-sm-3 control-label"><span style="color: red">*</span> ระดับชั้นเรียน</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" name="level" id="level" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="expectation" class="col-sm-3 control-label">ความคาดหวังในกิจกรรมนี้</label>
                                <div class="col-sm-8">
                                  <textarea class="form-control" rows="3" name="expectation" id="expectation"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="shirt" class="col-sm-3 control-label"><span style="color: red">*</span> ไซส์เสื้อยืด ToBeIT59</label>
                                <div class="col-sm-8">
                                    <select name="shirt" class="form-control" id="shirt">
                                        <option value="S">S</option>
                                        <option value="M">M</option>
                                        <option value="L" selected="selected">L</option>
                                        <option value="XL">XL</option>
                                        <option value="อื่น ๆ">อื่น ๆ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="expectation" class="col-sm-3 control-label">จำนวนวันที่จะมาเรียน TobeIT</label>
                                <div class="col-sm-8">
                                    <div class="radio">
                                        <label class="radio-inline" style="font-weight: 200;">
                                            <input type="radio" name="checkin" value="1" checked>
                                            มาเรียนครบทุกวัน
                                        </label>
                                        <label class="radio-inline" style="font-weight: 200;">
                                            <input type="radio" name="checkin" value="2">
                                            มาเรียนเป็นบางวัน
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"></label>
                                <div class="col-sm-9">
                                    <input name="direct_ent" id="direct_ent" type="checkbox" value="1"> สมัครรับตรงไอทีลาดกระบังแล้ว
                                </div>
                            </div>
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
                                    <input type="text" class="form-control" name="health_problem" id="health_problem">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="allergy" class="col-sm-3 control-label">อาการแพ้</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="allergy" id="allergy">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">การติดต่อ</div>
                        <div class="panel-body">
                            <form class="form-horizontal" method="post">
                                <div class="form-group">
                                    <label for="phone" class="col-sm-4 control-label"><span style="color: red">*</span> เบอร์โทร</label>
                                    <div class="col-sm-7">
                                      <input type="text" class="form-control" name="phone" id="phone" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="parent_phone" class="col-sm-4 control-label"><span style="color: red">*</span> เบอร์โทรผู้ปกครอง</label>
                                    <div class="col-sm-7">
                                      <input type="text" class="form-control" name="parent_phone" id="parent_phone" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="trip" class="col-sm-4 control-label"><span style="color: red">*</span> การเดินทางมา</label>
                                    <div class="col-sm-7">
                                        <select name="trip" class="form-control">
                                            <option value="0">ไม่ระบุ</option>
                                            <option value="1">ผู้ปกครองมาส่ง</option>
                                            <option value="2">รถไฟ</option>
                                            <option value="3">Airport Rail Link (ARL)</option>
                                            <option value="4">รถตู้</option>
                                            <option value="5">รถประจำทาง</option>
                                            <option value="6">รถสองแถว</option>
                                            <option value="7">อื่นๆ</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="return_trip" class="col-sm-4 control-label"><span style="color: red">*</span> การเดินทางกลับ</label>
                                    <div class="col-sm-7">
                                        <select name="return_trip" class="form-control">
                                            <option value="0">ไม่ระบุ</option>
                                            <option value="1">ผู้ปกครองมาส่ง</option>
                                            <option value="2">รถไฟ</option>
                                            <option value="3">Airport Rail Link (ARL)</option>
                                            <option value="4">รถตู้</option>
                                            <option value="5">รถประจำทาง</option>
                                            <option value="6">รถสองแถว</option>
                                            <option value="7">อื่นๆ</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="facebook" class="col-sm-4 control-label">Facebook</label>
                                    <div class="col-sm-7">
                                        <div class="input-group">
                                            <div class="input-group-addon">facebook.com/</div>
                                            <input type="text" class="form-control" name="facebook" id="facebook">
                                        </div>
                                    </div>
                                </div>
                            </form>
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